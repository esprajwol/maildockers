<?php

namespace App\Http\Controllers\Web;

use App;
use Illuminate\Http\Request;
use App\Services\File\PdfService;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\GenerateRequest;
use App\Jobs\Order\OrderPdfGenerateJob;
use Illuminate\Support\Facades\Storage;
use App\Services\Models\User\UserService;
use App\Models\Order;
use App\Services\Google\OrderMessageService;
use Dacastro4\LaravelGmail\Facade\LaravelGmail;
use function PHPUnit\Framework\stringStartsWith;
use Illuminate\Support\Facades\Redis;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $view = 'web.pages.homepage';
        $orders = Order::where('from_email', session()->get('yourEmail'))
            ->orderBy('id', 'desc')->get(); //To get the orders of loggedin user

        info("All Session Data: ", session()->all());
        if ($request->has("downloadPDF") && $request->downloadPDF) {
            ini_set('max_execution_time', -1);
            set_time_limit(-1);

            try {
                $order      = App\Models\Order::query()->findOrFail(session('order_id'));
                $sessionLab = new App\Utils\SessionLab();
                $token      = LaravelGmail::getToken()["access_token"];

                /**outlook pdf download*/
                if ($request->has('platform') && $request->platform == 'outlook') {
                    $filePath = $this->outlookPdfGenerate();

                    $this->customSessionForgot();

                    $full_path = storage_path('app/public/' . $filePath);
                    if (file_exists($full_path)) {
                        return response()->download($full_path);
                    } else {
                        return response()->json(['error' => 'File not found'], 404);
                    }
                }

                $request       = json_decode($order->request, true);
                $language      = session()->get('lang');
                $inc_array     = stringSplit($request["inc_keywords"]) ?? [];
                $email_address = $request["email_from"] ?? null;

                info('Language in Homecontroller:' . $language);

                $messages = (new OrderMessageService())->getMessages($order, false);

                info("First Message ID : " . $messages[0]["id"]);
                $oneMessage = (new OrderMessageService())->fetchSingleMessage($messages[0]["id"], $token);

                $parseOneMessage = (new PdfService())->parseMessage($oneMessage, 1);

                //Status update
                $orderId = session('order_id');
                $order = Order::findOrFail($orderId);
                $order->status = 'Generating';
                $order->save();

                $filePath = (new App\Services\File\PdfService())->createPDF(
                    $messages,
                    $email_address,
                    $language,
                    $inc_array,
                    null,
                    $order,
                    $parseOneMessage
                );
                if ($filePath) {
                    $order = Order::findOrFail($orderId);
                    $order->status = 'Done';
                    $order->save();
                }
                $full_path = storage_path('app/public/' . $filePath);

                if (file_exists($full_path)) {
                    //Status update
                    $orderId = session('order_id');
                    $order = Order::findOrFail($orderId);
                    $order->status = 'Downloaded';
                    $order->save();
                    return response()->download($full_path, $filePath, [
                        'Content-Type' => 'application/pdf',
                    ]);
                } else {
                    return response()->json(['error' => 'File not found'], 404);
                }
            } catch (\Throwable $e) {
                info("Failed to Generate & Download PDF : " . json_encode(errorArray($e)));

                // $this->index($request);
                return response([
                    "status" => false,
                    "message" => $e->getMessage(),
                    "errors" => errorArray($e)
                ], 500);
            }
        }

        if ($request->isMethod('post')) {
            return abort('404');
        }

        if ($request->query()) {
            return abort('404');
        }

        $session = session()->get('lang');
        App::setlocale($session);
        return view($view, compact('orders'));
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
