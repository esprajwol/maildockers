<?php

namespace App\Http\Controllers\Web;

use App;
use App\Jobs\Outlook\GenerateOutlookJsonFileJob;
use App\Jobs\Outlook\GenerateOutlookPdfFromJsonFileJob;
use App\Jobs\WkHtmlToPdf\WkHtmlToPdfJob;
use App\Mail\Partner\OrderFailMail;
use App\Models\User;
use App\Services\Outlook\OutlookService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\Models\User\UserService;
use App\Models\Order;
use App\Services\Google\OrderMessageService;
use Dacastro4\LaravelGmail\Facade\LaravelGmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;
use App\Jobs\GeneratePdfJob;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('checkLang')->only('index');
    }

    public function getOrders(Request $request)
    {
        $from_email = null;
        if (session('yourEmail')) {
            $from_email = session('yourEmail');
        } elseif (session('userEmail')) {
            $from_email = session('userEmail');
        }

        if ($from_email) {
            $orders = Order::with(['refund.latestStatus'])->where('from_email', $from_email) // Filter by the email
                ->where('is_paid', true) // Ensure is_paid is true
                ->whereNotNull('status') // Exclude records where status is null
                ->orderBy('id', 'desc') // Order by id in descending order
                ->paginate(10); // Paginate results to 10 per page

            // Get progress for each order
            foreach ($orders as $order) {
                if ($order->status == "Generating" || $order->is_paid == true) {
                    $progress = Redis::get("job_progress_{$order->id}");
                    $order->progress = $progress ? json_decode($progress, true) : null;
                } else {
                    $order->progress = null;
                }
            }

            return response()->json([
                'orders' => view('web.pages.order_list', compact('orders'))->render(),
                'pagination' => (string)$orders->links()
            ]);
        } else {

            // nothing found so error message not authenticated
            return response()->json(['status' => false, 'message' => "Please login to see data"], 403);
        }
    }

    public function generateAgain($orderId)
    {

        $order = Order::query()->findOrFail($orderId);
        $generateAgain = true;
        $view = 'web.pages.homepage';

        return view($view, compact('order', 'generateAgain'));
    }

    public function index(Request $request)
    {

        $view = 'web.pages.homepage';
        $generateAgain = false;
        $order = null;

        $platform = null;
        if (session('yourEmail')) {
            $platform = "Gmail";
        } elseif (session('userEmail')) {
            $platform = "Outlook";
        }

        Session::forget('pdf_generated_through_job');
        if (session()->has('order_id')) {
            $order = Order::query()->findOrFail(session('order_id'));
            if ($platform) {
                if ($platform == "Gmail") {
                    // Retrieve messages
                    $messages = (new OrderMessageService())->getMessages($order, false);
                    $filteredMessages = array_filter($messages);
                    $count = count($filteredMessages);
                    if ($count >= config('pdfSetting.number_of_mails_to_use_job')) {
                        Session::put('pdf_generated_through_job', 'yes');
                    } else {
                        Session::put('pdf_generated_through_job', 'no');
                    }
                }
            }
        }

        if ($request->has("downloadPDF") && $request->downloadPDF) {
            setMemoryLimitation();
            try {
                if (!$platform) {
                    return response()->json(['status' => false, 'message' => "Unauthorised access. Please login and try again"], 403);
                }

                $request = json_decode($order->request, true);
                $language = $request['language'];

                $inc_array = $request["inc_keywords"];
                $email_address = $request["your_email"] ?? null;
                $start_date = $request["start_date"] ?? null;
                $end_date = $request["end_date"] ?? null;
                $email_from = $request["email_from"] ?? null;
                $search_keyword_list = $request["search_keyword_list"] ?? null;
                

                if ($platform == "Outlook") {

                    // Get All Messages from outlook
                    $messages = OutlookService::GetMessages($email_address, $inc_array, $start_date, $end_date,$search_keyword_list,$email_from);

                    // Store messages in Redis
                    Redis::set("order_messages_{$order->id}", json_encode($messages));
                    Redis::set("job_progress_{$order->id}", json_encode(['status' => 'processing', 'progress' => 25]));

                    $count = count($messages);

                    if ($count == 0) {
                        $this->failOrder($order);
                        return response(['status' => false, 'message' => "Message not found!",], 500);
                    }

                    if ($count >= config('pdfSetting.number_of_mails_to_use_job')) {
                        Session::put('pdf_generated_through_job', 'yes');
                    } else {
                        Session::put('pdf_generated_through_job', 'no');
                    }

                    if (config('app.env') == 'production' && config('pdfSetting.number_of_mails_to_use_job') <= $count) {
                        // Environment is production and count condition is also meet
                        return $this->generateOutLookPdfWithJob($order);
                    } else {
                        // Environment or count condition is not meet so run in sync
                        return $this->generateOutlookPdfWithOutJob($order);
                    }
                }

                //Gmail part

                $tokenData = LaravelGmail::getToken();

                if (!$tokenData || !isset($tokenData["access_token"])) {
                    return response()->json(['error' => 'File generation failed'], 403);
                }

                $token = $tokenData["access_token"];

                // Retrieve messages
                $messages = (new OrderMessageService())->getMessages($order, false);

                if (empty($messages)) {
                    $this->failOrder($order);
                    return response(['status' => false, 'message' => "Message not found!",], 500);
                }

                // Exclude empty elements
                $filteredMessages = array_filter($messages);
                $count = count($filteredMessages);

                $orderKey = $order->id;
                $redisKey = "job_progress_{$orderKey}";
                Redis::set($redisKey, json_encode(['status' => 'processing', 'progress' => 25]));

                $messagesKey = 'order_messages_' . $order->id;
                Redis::set($messagesKey, json_encode($messages));

                if ($count == 0) {
                    $this->failOrder($order);
                    return response(['status' => false, 'message' => "Message not found!",], 500);
                }

                if (config('app.env') == 'production' && config('pdfSetting.number_of_mails_to_use_job') <= $count) {

                    return $this->generateGmailPdfWithJob($order, $token, $messagesKey);
                } else {

                    return $this->generateGmailPdfWithOutJob($order, $token, $messagesKey);
                }
            } catch (\Throwable $e) {
                // Report the exception (logs everything just like Laravel would normally do)
                report($e);

                $this->failOrder($order);

                // Return the error response
                return response([
                    'status' => false,
                    'message' => $e->getMessage(),
                    'errors' => errorArray($e)
                ], 500);
            }
        }

        if ($request->isMethod('post')) {
            return abort('404');
        }

        if ($request->query()) {
            return abort('404');
        }

        //$session = session()->get('lang');
        //App::setlocale($session);
        return view($view, compact('generateAgain'));
    }

    public function outlookPdfGenerate()
    {
        $filteredDates = (new OrderMessageService())->outlookSessionParams();
        $emailAddress = session("outlook_email_from");
        $language = session("outlook_language");
        $pdf = new App\Http\Controllers\Microsoft\EmailController();
        $file = $pdf->createPDF($filteredDates, $emailAddress, $language);
        return $file;
    }

    public function customSessionForgot()
    {
        session()->forget('outlook_your_email');
        session()->forget('outlook_email_from');
        session()->forget('outlook_inc_keywords');
        session()->forget('outlook_exc_keywords');
        session()->forget('outlook_start_date');
        session()->forget('outlook_end_date');
        session()->forget('outlook_language');
        session()->forget('total_message');
        session()->forget('file');
        session()->forget('order_id');
        session()->forget('total_messages');
    }

    public function gmailUserRegister()
    {

        try {
            DB::beginTransaction();
            $g = LaravelGmail::makeToken();
            if (LaravelGmail::check()) {
                //                $oauth = new Google_Service_Oauth2(LaravelGmail::connect());
                $userInfo = $g->userinfo->get();
                $email = $userInfo->email;
                dd($email);
                UserService::gmailUserRegister($email);
            } else {
                return redirect()->route('login.google');
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
        }
    }

    private function generateOutLookPdfWithJob(Order $order)
    {

        GenerateOutlookJsonFileJob::withChain([
            new GenerateOutlookPdfFromJsonFileJob($order)
        ])->dispatch($order);

        $this->customSessionForgot();

        return response()->json(["status" => true, "message" => "PDF will be ready in sometime"], 200);
    }

    private function generateOutlookPdfWithOutJob($order)
    {
        try {
            // Run the first job synchronously
            $jsonJob = new GenerateOutlookJsonFileJob($order);
            $jsonJob->handle(); // Manually handle the job

            $order->refresh();

            // Run the second job synchronously after the first job completes
            $pdfJob = new GenerateOutlookPdfFromJsonFileJob($order);
            $pdfJob->handle(); // Manually handle the job

            $this->customSessionForgot();

            return response()->json(["status" => true, "message" => "PDF is ready to download"], 200);
        } catch (\Exception $exception) {

            $order->pdf_gen_end_at = now();
            $order->status = 'Failed';
            $order->save();

            //Find partner and send mail to partner
            $partner = User::where('id', $order->partner_id)->first();
            if ($partner && $partner->email != '' && $partner->email != null) {
                Mail::to($partner->email)->queue(new OrderFailMail($order));
            }

            throw $exception;
        }
    }

    private function generateGmailPdfWithJob(Order $order, $token, $messagesKey)
    {
        $request = json_decode($order->request, true);
        $language = $request['language'];

        $inc_array = stringSplit($request["inc_keywords"]) ?? [];
        $email_address = $request["email_from"] ?? null;

        GeneratePdfJob::withChain([
            new App\Jobs\WkHtmlToPdf\WkHtmlToPdfJob($order, $inc_array)
        ])
            ->dispatch($order->id, $messagesKey, $email_address, $language, $inc_array, $token);

        return response()->json(["status" => true, "message" => "PDF will be ready in sometime"], 200);
    }

    private function generateGmailPdfWithOutJob(Order $order, $token, $messagesKey)
    {
        try {
            $request = json_decode($order->request, true);
            $language = $request['language'];

            $inc_array = stringSplit($request["inc_keywords"]) ?? [];
            $email_address = $request["email_from"] ?? null;

            // Run the first job synchronously
            $jsonJob = new GeneratePdfJob($order->id, $messagesKey, $email_address, $language, $inc_array, $token);
            $jsonJob->handle(); // Manually handle the job

            $order->refresh();

            // Run the second job synchronously after the first job completes
            $pdfJob = new WkHtmlToPdfJob($order, $inc_array);
            $pdfJob->handle(); // Manually handle the job

            return response()->json(["status" => true, "message" => "PDF is ready to download"], 200);
        } catch (\Exception $exception) {
            $order->pdf_gen_end_at = now();
            $order->status = 'Failed';
            $order->save();

            //Find partner and send mail to partner
            $partner = User::where('id', $order->partner_id)->first();
            if ($partner && $partner->email != '' && $partner->email != null) {
                Mail::to($partner->email)->queue(new OrderFailMail($order));
            }

            throw $exception;
        }
    }

    private function failOrder(Order $order)
    {
        // Update the order status to 'Failed', if $order is available
        if ($order && $order->status == "Generating") {
            $order->update([
                'status' => 'Failed'
            ]);
            //Find partner and send mail to partner
            $partner = User::where('id', $order->partner_id)->first();
            if ($partner && $partner->email != '' && $partner->email != null) {
                Mail::to($partner->email)->queue(new OrderFailMail($order));
            }
        }
    }
}
