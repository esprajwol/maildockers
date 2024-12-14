<?php

namespace App\Services\File;

use App\Models\Order;
use App\Services\Google\OrderMessageService;
use App\Utils\SessionLab;
use Carbon\Carbon;
use Dacastro4\LaravelGmail\Facade\LaravelGmail;
use Illuminate\Support\Facades\View;

class PdfService
{

    public function getHeaderTagText($text1, $text2)
    {
        return '<header  class="pdf-page-header">
            <div class="pdf-repeat float-left">
                <h3 class="title-1">' . $text1 . '</h3>
            </div>
            <div class="pdf-repeat float-left">
                <h3 class="title-2">' . $text2 . '</h3>
            </div>
            <div class="pdf-repeat float-left">
                <h3 class="title-3">legalpdf.co</h3>
            </div>
            <div class="clear-both"></div>
        </header>';
    }

    public function createPDF(
        $data,
        $emailTo,
        $language,
        $inc_array,
        $token = null,
        object | null $order = null,
        $parseOneMessage = null
    ) {
        info("From CREATE PDF from: " . $parseOneMessage["from"]);
        info('Language in PDF Service:'.$language);
        ini_set('max_execution_time', -1);
        set_time_limit(-1);
        ini_set("pcre.backtrack_limit", 500000000000);

        $inc_array = is_array($inc_array) && !empty($inc_array) ? $inc_array : [];


        $date            = now()->format('d_m_Y');
        $datePrefix      = now()->format('d_m_Y_h_i_s_v');
        $dateAt          = now()->format('d/m/Y');
        $timeAt          = now()->format('H:i:s');
        $authUser        = $order->from_email ?? LaravelGmail::user();
        $username        =  substr($authUser, 0, strpos($authUser, "@"));
        //  $file_path       = randomStringNumberGenerator(6).'_LegalPDF.pdf';
        $file_path       = $username . '_' . $datePrefix . '_LegalPDF.pdf';
        $emailToUsername = substr($emailTo, 0, strpos($emailTo, "@"));
        $logo            = public_path('web/assets/img/resize-image/logo-192x192.png');

        $access_token = is_null($token) ? LaravelGmail::getToken()["access_token"] : $token;

        // Define the maximum string length to process at a time
        $max_length = 2000;

        try {
            $mpdf = new \Mpdf\Mpdf([
                // 'tempDir'             => storage_path("app/public"), // uses the current directory's parent "tmp" subfolder
                // 'setAutoTopMargin'    => 'stretch',
                // 'setAutoBottomMargin' => 'stretch',
                'mode'    => 'utf-8',
                'format'  => 'A4-P',
                'margin_header'=>3,
                'tempDir' => storage_path("app/public")
            ]);
        } catch (\Mpdf\MpdfException $e) {
            info("Mpdf Exception : " . json_encode(errorArray($e)));
        }
        $text1 ="";
        $text2 ="";
        if ($language == 'en') {
            $text1 = "FAST & SECURED";
            $text2 = "Emails and Chats Extractor";
            info("Inside English Block in create PDF");
        } elseif($language == 'he') {
            info("Inside Hebru Block in create PDF");
            $text1 = "מאובטח, מהיר ומעוצב";
            $text2 = 'מחלץ התכתבויות דוא"ל ל- PDF';
        }

        // Define the header HTML
        $headerHtml = '
         <header class="pdf-page-header" style="border-bottom:1.2px solid #7a7a7a">
             <div style="width:8%;float:left;" >
             <img width="40" height="40" src="' . $logo . '" loading="lazy" alt="logo">
             </div>
             <div style="width:67%;float:left;">
             <p><span style="color: #c3b019de;font-weight: bold;font-size: 1.6rem;">LegalPDF.co</span><br><span style="color:#7a7a7a;font-weight:bold">' . $text2 . '</span></p>

             </div>
             <div style="width:21%;float:right;text-align:right!important;">
                  <p><span style="text-align:right!important;color:#7a7a7a">' . $dateAt . ' at ' . $timeAt . '</span><br><span style="color: #c3b019de;font-size: 1.2rem;font-weight: bold;">' . $text1 . '</span></p>
             </div>
         </header>';

        // Define the footer HTML
        $footerHtml = '
            <footer class="pdf-page-footer">
                <h3 class="title">- Page {PAGENO} of {nbpg} -</h3>
            </footer>';
        $mpdf->AddPage();
        // Set the header HTML
        $mpdf->SetHTMLHeader($headerHtml, '');

        // Set the footer HTML
        $mpdf->SetHTMLFooter($footerHtml);

        $mpdf->autoScriptToLang = true;
        $mpdf->autoLangToFont = true;

        $countData = count($data);

        $html = $this->getHeaderHtml(
            $logo,
            $username,
            $authUser,
            $emailTo,
            $dateAt,
            $timeAt,
            $language,
            $countData,
            $parseOneMessage
        );

        // dd($html);
        $mpdf->WriteHTML($html);

        $num = 0;

        $order = $order ?? Order::query()->findOrFail(session()->get('order_id'));

        // if (isset($data['messages'])) {
        if (isset($data)) {
            //foreach ($data['messages'] as $message) {
            info("Message Loop just started : Order" . json_encode($order));
            foreach ($data as $message) {
                $messageId = $message['id'];

                $singleMessage = (new OrderMessageService())->fetchSingleMessage($messageId, $access_token);
                $messageDetails = $singleMessage;

                $num++;

                $parseMessage = $this->parseMessage($messageDetails, $num);

                $eData = $parseMessage;

                $viewData = compact(
                    'eData',
                    'logo',
                    'username',
                    'emailToUsername',
                    'authUser',
                    'emailTo',
                    'dateAt',
                    'timeAt',
                    'language',
                    'inc_array',
                    'num'
                );

                $mpdf->WriteHTML(view('web.pdf.pdf_view', $viewData)->render());
                //$html .= view('web.pdf.pdf_view', $viewData)->render();
            }

            info("Message Loop just End");
            info("total pages : " . $num);
            $total_page_update_status = $order->update(['total_pages' => $num]);
            info("Total Pages update status:" . $total_page_update_status);
        }

        $mpdf->WriteHtml($this->getFooterHtml());

        $mpdf->Output(storage_path('app/public/' . $file_path), 'F');

        (new SessionLab())->setDownloadFile($file_path);

        info("Saved File Path : " . $file_path);


        $order->update([
            "pdf_file" => $file_path, "total_pages" => $num
        ]);

        return $file_path;
    }


    function parseMessage($messageDetails, $key)
    {
        $parsedMessage = [];

        // if($key == 0){
        //     info("Details : ".json_encode($messageDetails));
        // }

        // Get headers
        $headers = $messageDetails['payload']['headers'];

        // $myInfo= [
        //     'id'       => $messageDetails['id'],
        //     'threadId' => $messageDetails['threadId'],
        //     'snippet'  => $messageDetails['snippet'],
        //     'subject'  => $this->getHeader($headers, 'Subject'),
        //     'from'     => $this->getHeader($headers, 'From'),
        //     'to'       => $this->getHeader($headers, 'To'),
        //     'date'     => $this->getHeader($headers, 'Date'),
        //     'body'     => $this->getBody($messageDetails['payload']),
        // ];

        //info("Message NO : {$key} = ".json_encode($myInfo));

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
            } elseif ($header['name'] == 'Date') {
                $date          = Carbon::parse($header['value']);
                $formattedDate = $date->format('d/m/Y H:i');

                $parsedMessage['date'] = $formattedDate; // $header['value'];
            }
        }

        // Get body
        $body = getBody($messageDetails['payload']);
        $parsedMessage['body'] = $body;

        info("Message Inside : " . json_encode($parsedMessage));

        return $parsedMessage;
    }

    private function getHeader($headers, $name)
    {
        foreach ($headers as $header) {
            if ($header['name'] === $name) {
                return $header['value'];
            }
        }
        return null;
    }

    private function getBody($payload)
    {
        if (isset($payload['parts'])) {
            foreach ($payload['parts'] as $part) {
                if ($part['mimeType'] === 'text/plain' && isset($part['body']['data'])) {
                    return base64_decode(str_replace(['-', '_'], ['+', '/'], $part['body']['data']));
                }
            }
        } elseif (isset($payload['body']['data'])) {
            return base64_decode(str_replace(['-', '_'], ['+', '/'], $payload['body']['data']));
        }
        return null;
    }

    protected function getHeaderHtml($logo, $username, $authUser, $emailTo, $dateAt, $timeAt, $language, $countData, $oneMessageParse = null)
    {
        info("language in getHeaderHtml:".$language);

        $htmlHeb = "<div class='h-wrapper'>
                        <div class='left-align float-right'>
                            <div class='pdf-logo-holder'>
                            <img src='" . $logo . "' loading='lazy' alt='logo'>
                            </div>
                             <h3 class='logo-slogan text-center'
                            style='color: #c3b019de;font-weight: bold; margin-top: 6px;font-size: 1.4rem;font-weight: bold;'> מאובטח, מהיר ומעוצב</h3>
                        </div>
                        <div class='right-align float-right'>
                            <p class='title' style='color: #c3b019de; font-size:1.8rem'>מחלץ התכתבויות דוא'ל ל- PDF</h3>

                                <p style='font-size: 1.6rem;color:#7a7a7a;text-align:justify'>
                                    זהו מסמך רשמי מוכן לעיון ושימוש בבית המשפט.
                                    המסמך מכיל את כל המידע שהוזמן על ידי הלקוח הרשום מטה.
                                </p>
                                <p class='paragraph' style='font-size: 1.6rem;color:#7a7a7a;margin-top:2.95rem'>
                                    +44 2 089 850 107 | com.legalpdf.www
                                </p>

                        </div>
                        <div class='clear-both'></div>
                    </div>";
        $htmlEn = "<div class='h-wrapper'>
                        <div class='left-align float-left'>
                            <div class='pdf-logo-holder'>
                                <img
                                    src='" . $logo . "'
                                    alt='logo'
                                    loading='lazy'
                                />
                            </div>
                             <h3 class='logo-slogan text-center'
                style='color: #c3b019de;font-weight: bold; margin-top: 6px;font-size: 1.4rem;font-weight: bold;'>
                FAST & SECURED
            </h3>
                        </div>
                        <div class='right-align float-left' style=''>
                            <p class='title' style='color: #c3b019de; font-size:1.8rem'>Email's Messages into an Organised Document
            </p>

                                <p  style='font-size: 1.6rem;color:#7a7a7a;text-align:justify'>
                                    This is an official document produced by LegalPDF. The Document authentically reflects
                        email correspondence between the two parties mentioned below.
                                </p>
                                <p class='paragraph' style='font-size: 1.6rem;color:#7a7a7a;margin-top:2.95rem'>
                                   www.LegalPDF.co | +44 2 089 850 107
                                </p>

                        </div>
                        <div class='clear-both'></div>
                    </div>";



        $html2Heb = "
                     <div class='order-details-card'>
                        <h3 class='card-title text-center'>פרטי הזמנה</h3>
                        <div class='card-items'>
                            <div class='item'>
                                <p> ידי על ה</p>
                                <p style='float: right; display: inline-block'>" . $username . " | " . $authUser . "</p>
                            </div>
                            <div class='item'>
                                <span>תאריך </span>
                                <span>" . $dateAt . " at " . $timeAt . "</span>
                            </div>
                            <div class='item'>
                                <span>פלטפורמה </span>
                                <span>Gmail </span>
                            </div>
                            <div class='item'>
                                <span>כמות תכתובות </span>
                                <span>" . $countData . "</span>
                            </div>
                        </div>
                    </div>
                    <div class='additional-card'>
                        <h3 class='card-title'>המסמך הבא מכיל התכתבויות שבין הצדדים הבאים:</h3>
                        <div class='card-box'>
                            <div class='card-p float-left'>
                                <h3 class='title-1'>" . $authUser . " </h3>
                            </div>
                            <div class='card-c float-left'>
                                <h3 class='title-1 text-center'>עם</h3>
                            </div>
                            <div class='card-p float-left'>
                                <h3 class='title-1 text-right'>" . $emailTo . " </h3>
                            </div>
                            <div class='clear-both'></div>
                        </div>
                    </div>
                    <p class='notes'>התכתובות הבאות מסודרות מהחדש ביותר בראש המסמך, ועד הישן ביותר בתחתית המסמך</p>";



        $fromUserName = null;
        $toUserName = null;

        $fromEmail = null;
        $toEmail   = null;

        $fromFullString = null;
        $toFullString   = null;

        $email  = extractEmail($oneMessageParse["from"]);

        if ($email == laravelGmailUser()) {
            $fromEmail = laravelGmailUser();
            $toEmail   = extractEmail($oneMessageParse["to"]);
        } else {
            $fromEmail = $email;
            $toEmail   = laravelGmailUser();
            $toFullString = $oneMessageParse["to"];
        }

        $fromUserName = extractName($oneMessageParse["from"]);
        $toUserName   = extractName($oneMessageParse["to"]);


        $html2En = "
                    <div class='order-details-card'>
                        <h3 class='card-title text-center'>Order details</h3>
                        <div class='card-items'>
                            <div class='item'>
                                <p>Ordered by</p>
                                <p  class='valueP'>" . $username . " | " . $authUser . " </p>
                            </div>
                            <div class='item'>
                                <p>Date:</p>
                                 <p class='valueP'>" . $dateAt . " at " . $timeAt . " </p>

                            </div>
                            <div class='item'>
                                <p>Platform:</p>
                                 <p class='valueP'>Gmail </p>

                            </div>
                            <div class='item'>
                                <p>Number of emails:</p>
                                 <p class='valueP'>" . $countData . "</p>
                            </div>
                        </div>
                    </div>
                    <div class='additional-card'>
                        <h3 class='card-title'>The following document contains emails between</h3>
                        <div class='card-box'>
                            <div class='card-p float-left'>
                                <p class='text-center'><span class='label'>Name: </span>&nbsp;<span class='content'>" .  $fromUserName . "</span></p>
                                <p class='text-center'><span class='label'>Email: </span>&nbsp;<span class='content'>" . $fromEmail . "</span></p>
                            </div>
                            <div class='card-c float-left'>
                                <h1 class='text-center'><span class='content'>And</span></h1>
                            </div>
                            <div class='card-p float-left'>
                                <p class='text-center'><span class='label'>Name: </span>&nbsp;<span class='content'>" . $toUserName . "</span></p>
                                <p class='text-center'><span class='label'>Email: </span>&nbsp;<span class='content'>" . $toEmail . "</span></p>
                            </div>
                            <div class='clear-both'></div>
                        </div>
                    </div>
                    <p class='notes'>* The following emails are in order from newest to oldest</p>";

        if ($language == 'he') {
            $display = $htmlHeb;
            $display2 = $html2Heb;
        } else {
            $display = $htmlEn;
            $display2 = $html2En;
        }

        $html = "<html lang='en'>
                    <head>
                        <meta charset='UTF-8'>
                        <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
                        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                        <meta http-equiv='X-UA-Compatible' content='ie=edge'>

                        <style>
                            * {
                                margin: 0;
                                padding: 0;
                                -webkit-box-sizing: border-box;
                                box-sizing: border-box
                            }

                            body {
                                font-size: 62.5%;
                                padding: 4rem 3rem;
                                max-width: 100%;
                                font-family: DejaVu Sans, sans-serif;
                                unicode-bidi: bidi-override !important;
                                direction: unset !important
                            }
 .content {
            font-size: 1.6rem;
            font-weight: 400;
            color: #7a7a7a;
            font-weight: bold;
        }
            .label {
            text-align: right;
            color: #7a7a7a;
            font-size: 1.6rem;
            font-weight: 400;
            line-height: 2.3rem
        }
                            .text-right {
                                text-align: right
                            }

                            .left-align {
                                width: 25%
                            }

                            .right-align {
                                width: 75%
                            }

                            .float-left {
                                float: left
                            }

                            .float-right {
                                float: right
                            }

                            .clear-both {
                                clear: both
                            }

                            .pdf-logo-holder {
                                width: 13.65rem;
                                height: auto;
                                overflow: hidden;
                                margin: 0 auto
                            }

                            .pdf-logo-holder>img {
                                width: 90%;
                                height: auto;
                                -o-object-fit: contain;
                                object-fit: contain
                            }

                            header.pdf-header {
                                border-bottom: .15rem solid #7a7a7a
                            }

                            header.pdf-header h3.logo-slogan {
                                font-size: 1.5rem;
                                line-height: 2.4rem;
                                color: #999903;
                                text-align: center;
                                font-weight: bold;
                                margin: 1rem 0
                            }

                            header.pdf-header h3.title {
                                font-size: 2.2rem;
                                line-height: 2.8rem;
                                color: #999903;
                                font-weight: bold;
                                margin-left: 1rem;
                                margin-bottom: 0
                            }

                            header.pdf-header p.paragraph {
                                color: #7a7a7a;
                                font-size: 1.7rem;
                                font-weight: 400;
                                line-height: 3rem;
                                margin-left: 1rem
                            }

                            section.pdf-invoice .order-details-card {
                                margin-bottom: 1.5rem
                            }

                            section.pdf-invoice .order-details-card h3.card-title {
                                font-size: 2rem;
                                line-height: 2.6rem;
                                color: #7a7a7a;
                                font-weight: bold
                            }

                            section.pdf-invoice .order-details-card .card-items {
                                padding: 1rem 0
                            }

                            section.pdf-invoice .order-details-card .card-items .item {
                                border-bottom: 1px dashed #7a7a7a;
                                padding: 1rem 0;
                                color: #7a7a7a;
                                font-size: 1.6rem;
                                font-weight: 400;
                                line-height: 1.3rem;
                            }

                            .item p{
                                display:inline-block;
                                width: 100%;
                                float:left;
                                margin:0;
                            }

                            .valueP{
                                text-align :right;
                                font-weight:bold;
                            }

                            section.pdf-invoice .additional-card {
                                margin: 1.5rem 0
                            }

                            section.pdf-invoice .additional-card h3.card-title {
                                font-size: 1.8rem;
                                line-height: 2.6rem;
                                color: #7a7a7a;
                                text-align: center;
                                font-weight: bold;
                                margin-bottom: 1.5rem
                            }

                            section.pdf-invoice .additional-card .card-box {
                                max-width: 50%;
                                border: .15rem solid #7a7a7a;
                                padding: 1rem;
                                margin: 0 auto
                            }

                            section.pdf-invoice .additional-card .card-box .card-p {
                                width: 45%
                            }

                            section.pdf-invoice .additional-card .card-box .card-c {
                                width: 10%
                            }

                            section.pdf-invoice .additional-card .card-box h3.title-1 {
                                font-size: 1.7rem;
                                line-height: 2.4rem;
                                color: #7a7a7a;
                                font-weight: bold
                            }

                            .text-center {
                                text-align: center
                            }

                            .text-right {
                                text-align: right
                            }

                            section.pdf-invoice p.notes {
                                text-align: center;
                                color: #7a7a7a;
                                font-size: 1.7rem;
                                font-weight: 400;
                                line-height: 2.3rem
                            }

                            section.pdf-message-collection .message-counter-head {
                                border-top: .15rem solid #7a7a7a;
                                padding-top: 1rem;
                                margin-top: 2.5rem
                            }

                            section.pdf-message-collection .message-counter-head p.text-1 {
                                color: #7a7a7a;
                                font-size: 1.7rem;
                                font-weight: 400;
                                line-height: 2.3rem
                            }

                            section.pdf-message-collection .message-counter-head p.text-2 {
                                text-align: right;
                                color: #7a7a7a;
                                font-size: 1.7rem;
                                font-weight: 400;
                                line-height: 2.3rem
                            }

                            section.pdf-message-collection .message-body h3.subjects {
                                font-size: 1.8rem;
                                line-height: 2.4rem;
                                color: #7a7a7a
                            }

                            section.pdf-message-collection .message-body h3.sub-subjects {
                                font-size: 1.5rem;
                                line-height: 2rem;
                                color: #7a7a7a
                            }

                            section.pdf-message-collection .message-body .content {
                                color: #7a7a7a;
                                font-size: 1.7rem;
                                font-weight: 400;
                                line-height: 2.3rem
                            }

                            .pdf-page-footer {
                                width: 100%
                            }

                            .pdf-page-footer .title {
                                text-align: center
                            }

                            footer.pdf-page-footer h3.title {
                                font-size: 1.6rem;
                                line-height: 2.3rem;
                                color: #7a7a7a;
                                text-align: center;
                                font-weight: bold
                            }

                            .pdf-page-header {
                                width: 100%;
                                padding: 0;
                                margin: 1rem auto
                            }

                            .pdf-page-header .pdf-repeat {
                                width: 33.33%
                            }

                            header.pdf-page-header h3.title-1 {
                                font-size: 1.5rem;
                                line-height: 2.4rem;
                                color: #999903;
                                font-weight: bold
                            }

                            header.pdf-page-header h3.title-2 {
                                font-size: 1.5rem;
                                line-height: 2.4rem;
                                color: #7a7a7a;
                                text-align: center;
                                font-weight: bold
                            }

                            header.pdf-page-header h3.title-3 {
                                font-size: 1.5rem;
                                line-height: 2.4rem;
                                color: #999903;
                                text-align: right;
                                font-weight: bold
                            }

                            .message-counter-head {
                                width: 100%
                            }

                            .numberDiv{
                                display:inline-block;
                                width: 10%;
                                float:left;
                            }

                            .subjectDiv{
                                display:inline-block;
                                width: 60%;
                                float:left;
                                text-align:center;
                            }

                            .dateDiv{
                                display:inline-block;
                                width: 30%;
                                float:left;
                                text-align:right;
                            }

                            .message-counter-head .ram {
                                width: 50%
                            }
                        </style>
                        <style>
                            body {
                                unicode-bidi: bidi-override !important;
                                direction: unset !important;
                            }
                            .highlight {
                                background-color: yellow;
                            }
                        </style>
                    </head>";
        $html .= "<body dir='" . ($language == 'heb' ? 'rtl' : '') . "'>
                    <header class='pdf-header'>";


        $html .= $display;

        $html .= "  </header>
                    <section class='pdf-invoice'>" . $display2 . "</section>
                    <section class='pdf-message-collection'>";

        return $html;
    }

    protected function getFooterHtml()
    {
        $html = "</section>
                </body>
            </html>";

        return $html;
    }
}
