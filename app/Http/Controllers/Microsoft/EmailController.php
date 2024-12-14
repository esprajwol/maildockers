<?php

namespace App\Http\Controllers\Microsoft;

use App\Http\Controllers\Controller;
use App\Http\Requests\GenerateRequest;
use App\Services\Google\OrderMessageService;
use App\Services\Outlook\OutlookService;
use App\TokenStore\TokenCache;
use Microsoft\Graph\Graph;

class EmailController extends Controller
{
    public static function getInbox($emailAddress, $inc_keywords = Null) {
        try {
            $tokenCache = new TokenCache();

            $accessToken = $tokenCache->getAccessToken();
            $graph = new Graph();
            $graph->setAccessToken($accessToken);

            // Only request specific properties
            $select = '$select=from,toRecipients,isRead,receivedDateTime,subject,body';

            // Filter by recipient email address
            $from = "from:".$emailAddress;
            $include_words = "subject:".$inc_keywords;
            // $date = "sent:>=2023-04-01 OR sent:<=2023-04-30";

            if($inc_keywords) {
                $requestUrl = '/me/messages?$search="'.$from.' AND '.$include_words.'"&'.$select;
            } else {
                $requestUrl = '/me/messages?$search="'.$from.'"&'.$select;
            }


            return $graph->createCollectionRequest('GET', $requestUrl);
        } catch (\Exception $e) {
            // dd($e->getMessage());
        }

    }

    public static function getSentItems($emailAddress, $inc_keywords = Null) {
        try {
            $tokenCache = new TokenCache();
            $accessToken = $tokenCache->getAccessToken();
            $graph = new Graph();
            $graph->setAccessToken($accessToken);

            // Only request specific properties
            $select = '$select=from,toRecipients,isRead,receivedDateTime,subject,body';
            // Filter by recipient email address
            $recipients = "recipients:".$emailAddress;
            $include_words = "subject:".$inc_keywords;
            // $date = "sent:>=2023-04-01 OR sent:<=2023-04-30";
            // Sort by received time, newest first
            // $orderBy = '$orderBy=receivedDateTime DESC';

            if($inc_keywords) {
                $requestUrl = '/me/messages?$search="'.$recipients.' AND '.$include_words.'"&'.$select;
            } else {
                $requestUrl = '/me/messages?$search="'.$recipients.'"&'.$select;
            }

            return $graph->createCollectionRequest('GET', $requestUrl);
        } catch (\Exception $e) {
            // dd($e->getMessage());
            return response(['catch' => "Sorry, there was a problem"], 500);
        }

    }

    public function generate(GenerateRequest $request,OrderMessageService $orderMessageService)
    {
        try {
            $data = $request->validated();
            $data["platform_type"] = 2;// outlook platform.

            if(session('userEmail')) {
                if(session('userEmail') && (session('userEmail') != $request->your_email)) {
                    return response()->json(['error_msg' => 'Incorrect information for '.session('userEmail') . ', insted we get ' . $request->your_email . '.'], 401);
                }

                $this->outlookSessionGenerate();

                $messages  =  OutlookService::GetMessages($request->your_email,$request->inc_keywords,$request->start_date,$request->end_date, $request->search_keyword_list,$request->email_from);

                $messageCount = count($messages);
                $file = "";
                if($messageCount > 0) {
                    // CREATE PDF
                    $file = "download-file-text"; // $this->createPDF($filteredDates, $emailAddress, $language);
                    /*new code by mh start*/
                    /*session create for other activities ex: order store , payment, and download*/

                    session()->put('total_message', $messageCount);
                    session()->put('file', $file);

                    /**order store*/
                    // Order Creation
                    $order = $orderMessageService->storeOrder($data);
                    $order->update(['total_messages'=> $messageCount]);
                    session()->put(["order_id" => $order->id]);
                }

                // IF FILE EXIST
                return response()->json([
                    'data_count'      => $messageCount,
                    'download_status' => true,
                    'download_file'   => $file
                ],200);
            }
        } catch(\Exception $e) {
            info("Failed to Generate Outlook Action".json_encode(errorArray($e)));
            return response(['catch' => $e->getMessage()], 500);
        }
    }


    public function outlookSessionGenerate()
    {
        $request = request();
        session()->put('outlook_your_email',$request->your_email);
        session()->put('outlook_email_from',$request->email_from);
        session()->put('outlook_inc_keywords',$request->inc_keywords);
        session()->put('outlook_exc_keywords',$request->exc_keywords);
        session()->put('outlook_start_date',$request->start_date);
        session()->put('outlook_end_date',$request->end_date);
        session()->put('outlook_language',urldecode($request->language));
    }

    // Generate PDF
    public function createPDF($data, $emailTo, $language) {
        $date = now()->format('d_m_Y');
        $dateAt = now()->format('d/m/Y');
        $timeAt = now()->format('H:i:s');
        $authUser = session('userEmail');
        $username = substr($authUser, 0, strpos($authUser, "@"));
        $num_str = sprintf("%06d", mt_rand(1, 999999));
        $fileName = $username.'_'.$date.'_'.$num_str.'_LegalPDF';
        $file_path = $fileName . '.pdf';

        $emailToUsername = substr($emailTo, 0, strpos($emailTo, "@"));

        $logo = public_path('web/assets/img/resize-image/logo-192x192.png');

        $html = view('web.pdf.outlook_pdf_view', compact('data', 'logo', 'username', 'emailToUsername', 'authUser', 'emailTo', 'dateAt', 'timeAt', 'language'))->render();

//        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-P']);

        try {
            $mpdf = new \Mpdf\Mpdf([
                //'tempDir' => __DIR__ . '/../tmp', // uses the current directory's parent "tmp" subfolder
                'tempDir' => storage_path("app/public"), // uses the current directory's parent "tmp" subfolder
                'setAutoTopMargin' => 'stretch',
                'setAutoBottomMargin' => 'stretch'
            ]);
        } catch (\Mpdf\MpdfException $e) {
            // print "Creating an mPDF object failed with" . $e->getMessage();
        }

        if($language == 'en') {
            $text1 = "FAST & SECURED";
            $text2 = "Emails and Chats Extractor";
        } else {
            $text1 = "מאובטח, מהיר ומעוצב";
            $text2 = 'מחלץ התכתבויות דוא"ל ל- PDF';
        }

        // Define the header HTML
        $headerHtml = '
            <header class="pdf-page-header">
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

        // Define the footer HTML
        $footerHtml = '
            <footer class="pdf-page-footer">
                <h3 class="title">- Page {PAGENO} of {nbpg} -</h3>
            </footer>';

        // Set the header HTML
        $mpdf->SetHTMLHeader($headerHtml);

        // Set the footer HTML
        $mpdf->SetHTMLFooter($footerHtml);

        $mpdf->autoScriptToLang = true;
        $mpdf->autoLangToFont = true;

        $mpdf->WriteHtml($html);
        $mpdf->Output(storage_path('app/public/' . $file_path), 'F');

        return $file_path;
    }
}
