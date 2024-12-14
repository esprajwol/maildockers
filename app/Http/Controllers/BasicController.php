<?php

namespace App\Http\Controllers;

use App\Jobs\WkHtmlToPdf\WkHtmlToPdfJob;
use App\Services\File\JsonToPdfService;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Coupon;
use App\Mail\OrderPdfMail;
use Faker\Factory as Faker;
use Illuminate\Http\Request;
use App\Services\OTP\OTPService;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Services\Google\OrderMessageService;
use Dacastro4\LaravelGmail\Facade\LaravelGmail;
use PDF;
use Illuminate\Support\Facades\View;
class BasicController extends Controller
{
    public function sms(Request $request)
    {
        try {
            $toNumber = $request->mobile ?? "+8801829894659";
            $message = $request->message ?? "Legal PDF Testing Message";

            $otp = (new OTPService())->sendSMSVia($toNumber, $message);

            dd($otp);
        }
        catch (\Throwable $e){
            ddError($e);
        }
    }

    public function makeOrderQuery($start, $end, $userId = true){

        $query = Order::whereBetween('created_at', [$start, $end]);

        $userId ? $query->partnerId() : false;

        return $query->get();
    }

    function getGmailMessages($accessToken, $query) {
        $url = 'https://www.googleapis.com/gmail/v1/users/me/messages';

        $headers = array(
            'Authorization: Bearer ' . $accessToken,
            'Content-Type: application/json'
        );

        $data = array(
            'q' => $query
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        // Disable SSL certificate verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);
        curl_close($ch);

        dd(json_decode($response, true));

        return json_decode($response, true);
    }


    public function test(Request $request)
    {
        try {
            $order = Order::query()->latest()->first();

            dispatch(new WkHtmlToPdfJob($order));

            dd("Execution started");


            $order   = (new OrderMessageService())->getOrderById($orderId);

            $pdfHtmlRender = (new JsonToPdfService())->pdfHtmlRender($order);

            $htmlContent = View::make("wkhtmltopdf.pdf-rendered-messages")->with([
                "htmlData" => $pdfHtmlRender
            ]);

            dd($htmlContent);

//            Artisan::call("generate:order-pdf-wk 2");
//
//            dd(123);
//            $orderId = 2; // Example order ID
//            $artisanPath = base_path('artisan');
//
//            $xy = exec("php $artisanPath generate:order-pdf $orderId", $output, $return_var);
//
//            dd(
//                $xy,
//                $return_var
//            );
//
//            if ($return_var === 1) {
//                echo "PDF generated successfully!";
//            } else {
//                echo "Failed to generate PDF.";
//            }
//            dd("executed");
//
//            $data= [
//                "title" => "Rislam",
//            ];

            try{
                $jsonFile = storage_path('app/public/order_id_64353_2024_08_13_17_46_49.json');

                // Check the file is exists or Not
                if(!File::exists($jsonFile)){
                    info("File not found: " . $jsonFile);
                }

                $js = (new JsonToPdfService())->createPDFWithWkHtml2Pdf(
                  $jsonFile,
                  "rislam252@gmail.com",
                  "en",[],true, Order::query()->first()
                );

                dd($js);
                // Get the file
                $jsonData = File::get($jsonFile);

                // Decode the file with the json_decode function
                $messages  = json_decode($jsonData, true);

                $htmlData = [];


                foreach($messages as $message){
                   $data["eData"] = $message;

                    $htmlData[] = View::make('pdfx')->with($data)->render();
                }

                $pdfFile = storage_path('app/public/order_id_64353_2024_08_13_17_46_49.pdf');

                $headerHtml = View::make('wkhtmltopdf.pdf-header')->render();
                $footerHtml = View::make("wkhtmltopdf.pdf-footer")->render();

                $pdf = PDF::loadView('pview', ["htmlData" => $htmlData])
                ->setPaper('a4') // Set paper size
                ->setOption('margin-top', '20mm') //
                ->setOption('header-html', $headerHtml)
                ->setOption('header-spacing', 5)
                ->setOption('margin-bottom', '15mm') // Ensure enough space for the footer
                ->setOption('footer-html', $footerHtml)
                ->setOption('footer-center', 'Page [page] of [topage]')
                ->setOption('footer-font-size', 8) // Optional: Set footer font size
                ->setOption('footer-line', true);

                $fileName = randomStringNumberGenerator(10,true, true) . ".pdf";

                return $pdf->save($fileName);
            }
            catch(\Throwable $e){
                ddError($e);
            }

//            $pdf = PDF::loadView('pdfx', [], [], [
//                'margin-top'    => 10,
//                'margin-right'  => 10,
//                'margin-bottom' => 10,
//                'margin-left'   => 10,
//                'header-right'  => '[page]',
//                'footer-left'   => '[title]',
//                'footer-right'  => '[date]',
//            ]);
//
//            return $pdf->stream('invoice.pdf');
        }
        catch (\Throwable $e){
            ddError($e);
        }




//
//
//
//        dd(
//            (new JsonToPdfService())->createPdfFromDatabase($order)
//        );
//
//        if($request->has("jsonFile")){
//            $jsonFile = $request->jsonFile;
//
//            try{
//                $jsonFile = storage_path('app/public/'.$jsonFile);
//
//                $pdfFile = (new JsonToPdfService())->createPDF(
//                    $jsonFile,
//                    "rislam252@gmail.com", // Your Email here
//                    "en",
//                    []
//                );
//
////            dd($pdfFile);
//
//                return response()->download($pdfFile);
//            }
//            catch(\Throwable $e){
//                ddError($e);
//            }
//        }



//        $response = Http::withHeaders([
//            'Authorization' => 'Bearer ya29.a0AXooCgsELKjnkKBZ9XevdKekJ2pyO_Q_jfy-uPEq7p8g5v2agbK6FTBC5AJWG2mtGsZoH14PpLO28eq0ntzGjKt0KVBudUvXHSuLY_74xsnnRmzIDQkoxbUkzIGE4Zb60tmXIxHyX2UARiwqJjLURQiU_5ydKzrVliUaCgYKAeASAQ4SFQHGX2MisBnumOOQLH-FfS4yGFHIYQ0170',
//        ])->get('https://www.googleapis.com/gmail/v1/users/me/profile');
//
//        if ($response->successful()) {
//            dd($response->json());
//        }

    }

    private function makeApiRequest($url, $token = null)
    {

        info("Calling from makeApiRequest Method = ".$url);
        $accessToken = $token ?? LaravelGmail::getToken()["access_token"];

        info("Token is : {$accessToken}");

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' .$accessToken
        ]);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

    private function getAccessToken($clientId, $clientSecret, $redirectUri)
    {
        return "ya29.a0AXooCgsxIR2FdC8c5xrNa5sMevhynGJ13vZmEPBgcm4uhmcwJq8s9gKc5f8UK3LVHVpwqLbsIPMkTAEjNbBMd5T9m7HTaWE5awj-JSsVaZVMhdOYhtKKRgGCZKAkvQgpAp4Vv1pCYGbne6YfbHzLUwxfHcSsEkvJX0YaCgYKAaQSARMSFQHGX2MipLjD1lI_ZAXayUGlOXbe_Q0170";
        // Basic OAuth flow example (replace with your implementation)
        $authUrl = 'https://accounts.google.com/o/oauth2/v2/auth';
        $tokenUrl = 'https://oauth2.googleapis.com/token';

        // Redirect user to Google authorization endpoint
        // ...

        // Handle callback and exchange authorization code for access token
        // ...

        return $accessToken; // Replace with obtained access token
    }

    public function customQuery($startDate, $endDate)
    {

        return Order::whereBetween('created_at', [$startDate, $endDate])
            ->select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('COUNT(*) as order_count'),
                DB::raw('SUM(paid_amount) as total_earnings')
            )
            ->groupBy('date')
            ->get()
            ->keyBy('date');
    }

    public function downloadPdfFile($id)
    {
        if(laravelGmailUser()){

            $order = Order::query()->findOrFail($id);
            $file = $order->pdf_file;

            $pdfFile = storage_path("app/public/".$file);

//            // Check if the file exists
            if (file_exists($pdfFile)) {
                // Download the file
                return response()->download($pdfFile); //->deleteFileAfterSend(true);
            }
            else {
                // Handle the case where the file doesn't exist
                return response()->json(['error' => 'File not found.'], 404);
            }
        }
    }

    private function calculatePercentageChange($previous, $current)
    {
        if ($previous == 0) {
            return $current == 0 ? 0 : 100;
        }
        return (($current - $previous) / $previous) * 100;
    }

    public function getHeaderTagText($text1, $text2){
        return '<header class="pdf-page-header">
            <div class="pdf-repeat float-left">
                <h3 class="title-1">'. $text1 .'</h3>
            </div>
            <div class="pdf-repeat float-left">
                <h3 class="title-2">'. $text2 .'</h3>
            </div>
            <div class="pdf-repeat float-left">
                <h3 class="title-3">legalpdf.co</h3>
            </div>
            <div class="clear-both"></div>
        </header>';
    }

    public function validate_coupon(Request $request)
    {
        $coupon = Coupon::where([
                        ['coupon_no', '=', $request->coupon_no],
                        ['used_at', '=', null],
                    ])->first();

        if ($coupon) {
            return "valid";
        } else {
            return "invalid";
        }
    }

    public function notify_order_email(Request $request)
    {
        try {
            $order = Order::findOrFail($request->order_id);
            $order->notify = $request->notify;
            $order->save();

            return response()->json([
                'success' => true,
                'message' => 'Order notification updated successfully.',
                'data'    => $order,
            ], 200);
        } catch (\Exception $e) {
            \Log::error('Error updating order notification', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Failed to update order notification.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    function parseMessage($messageDetails) {
        $parsedMessage = [];

        // Get headers
        $headers = $messageDetails['payload']['headers'];
        foreach ($headers as $header) {
            if ($header['name'] == 'Subject') {
                $parsedMessage['subject'] = $header['value'];
            } elseif ($header['name'] == 'From') {
                $parsedMessage['from'] = $header['value'];
            } elseif ($header['name'] == 'To') {
                $parsedMessage['to'] = $header['value'];
            } elseif ($header['name'] == 'Cc') {
                $parsedMessage['cc'] = $header['value'];
            } elseif ($header['name'] == 'Bcc') {
                $parsedMessage['bcc'] = $header['value'];
            }
        }

        // Get body
        $body = getBody($messageDetails['payload']);
        $parsedMessage['body'] = $body;

        return $parsedMessage;
    }
}
