<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App;
use App\Http\Requests\GenerateRequest;
use App\Services\File\PdfService;
use App\Services\Google\OrderMessageService;
use Dacastro4\LaravelGmail\Facade\LaravelGmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\Models\User\UserService;
use App\Jobs\Order\OrderPdfGenerateJob;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $view = 'web.pages.homepage';

        //        session()->flash('paid_success','paid');

        if ($request->has("downloadPDF") && $request->downloadPDF) {
            ini_set('max_execution_time', -1);
            set_time_limit(-1);

            // try {
            info("i am from HomeController Download Action");

            $order = App\Models\Order::query()->findOrFail(session('order_id'));
            $sessionLab = new App\Utils\SessionLab();
            $token = LaravelGmail::getToken()["access_token"];
            info('Token From HomeController Download Action : ' . $token);
            /**outlook pdf download*/
            if ($order->total_messages >= 100) {
                info('Message 100 up and call job');
                try {
                    dispatch(new OrderPdfGenerateJob($order, $token));
                    // OrderPdfGenerateJob::dispatch($order);
                } catch (\Exception $e) {
                    // Log the error for further debugging
                    info('Error dispatching OrderPdfGenerateJob: ' . $e->getMessage());

                    return response()->json([
                        "status" => false,
                        "message_count" => $order->total_messages,
                        "message" => 'There was an error processing your request. Please try again later.',
                    ]);
                }
                return response()->json([
                    "status" => true,
                    "message_count" => $order->total_messages,
                    "message" => 'Please wait while we send the download link to your mail',
                ]);
            } else {
                if ($request->has('platform') && $request->platform == 'outlook') {
                    $filePath = $this->outlookPdfGenerate();
                    info('Outlook generated PDF file path: ' . $filePath);
                    $this->customSessionForgot();

                    $full_path = storage_path('app/public/' . $filePath);
                    if (file_exists($full_path)) {
                        return response()->download($full_path);
                    } else {
                        return response()->json(['error' => 'File not found'], 404);
                    }
                }

                $request       = json_decode($order->request);
                $language      = $request["language"];
                $inc_array     = $request["inc_array"] ?? null;
                $email_address = $request["email_from"] ?? null;

                $messages = (new OrderMessageService())->getMessages($order, false);

                (new App\Services\File\PdfService())->createPDF(
                    $messages,
                    $email_address,
                    $language,
                    $inc_array
                );


                $filePath = session($sessionLab::SESSION_DOWNLOAD_PDF_FILE);

                // $this->customSessionForgot();

                $full_path = storage_path('app/public/' . $filePath);
                if (file_exists($full_path)) {
                    return response()->download($full_path);
                } else {
                    return response()->json(['error' => 'File not found'], 404);
                }
            }
            // } catch (\Throwable $e) {
            //     info("Failed to Generate & Download PDF : " . json_encode(errorArray($e)));

            //     // $this->index($request);
            //     return response([
            //         "status" => false,
            //         "message" => $e->getMessage(),
            //         "errors" => errorArray($e)
            //     ], 500);
            // }
        }

        if ($request->isMethod('post')) {
            return abort('404');
        }

        if ($request->query()) {
            return abort('404');
        }

        $session = session()->get('lang');
        App::setlocale($session);
        return view($view);
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
}
