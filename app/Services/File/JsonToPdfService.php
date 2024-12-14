<?php

namespace App\Services\File;

use Barryvdh\Snappy\Facades\SnappyPdf;
use Dacastro4\LaravelGmail\Facade\LaravelGmail;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use PDF;
use Illuminate\Support\Facades\Storage;

class JsonToPdfService
{
    public function createPDFWithWkHtml2Pdf(
        $jsonFile,
        $emailAddress,
        $language = "en",
        $inc_array = [],
        $responseWithoutStoragePath = false,
        $order = null
    )
    {
        // Check the file is exists or Not
        if(!File::exists($jsonFile)){
            info("File not found: " . $jsonFile);
        }

        // Get the file
        $jsonData = File::get($jsonFile);

        // Decode the file with the json_decode function
        $messages  = json_decode($jsonData, true);

        $htmlData = [];


        foreach($messages as $message){
            $data["eData"] = $message;

            $htmlData[] = View::make('pdfx')->with($data)->render();
        }

        $headerHtml = View::make('wkhtmltopdf.pdf-header')->render();
        $footerHtml = View::make("wkhtmltopdf.pdf-footer")->render();

        $pdf = PDF::loadView('pview', ["htmlData" => $htmlData]);

        $fileName ="rip_order_id_{$order->id}_".randomStringNumberGenerator(10,true, true) . ".pdf";

        info("File Name = " . $fileName);

        return $pdf->save($fileName);
    }

    public function pdfHtmlRender($order)
    {
        $orderId = $order->id;

        $jsonFile = storage_path("app/public/{$order->msg_json_file}");

        // Check the file is exists or Not
        if(!File::exists($jsonFile)){
            info("File not found: " . $jsonFile);
        }

        // Get the file
        $jsonData = File::get($jsonFile);

        // Decode the file with the json_decode function
        $messages  = json_decode($jsonData, true);
        $htmlData  = [];

        foreach($messages as $message){
            $data["eData"] = $message;

            $htmlData[] = View::make('wkhtmltopdf.pdf-single-message')->with($data)->render();
        }

        return $htmlData;
    }

    public function createPDF(
        $jsonFile,
        $emailAddress,
        $language = "en",
        $inc_array = [],
        $responseWithoutStoragePath = false,
        $order = null
    )
    {
        setMemoryLimitation();

        // PDF Gen Start at
        $order->update([
            "pdf_gen_start_at" => now(),
            "processing_status"=> 3 // PDF Making Start
        ]);

        $date            = now()->format('d_m_Y');
        $datePrefix      = now()->format('d_m_Y_h_i_s_v');
        $dateAt          = now()->format('d/m/Y');
        $timeAt          = now()->format('H:i:s');


        // Check the file is exists or Not
        if(!File::exists($jsonFile)){
            info("File not found: " . $jsonFile);
        }

        // Get the file
        $jsonData = File::get($jsonFile);

        // Decode the file with the json_decode function
        $messages  = json_decode($jsonData, true);

        $singleMessage = $this->singleMessage($messages);
        $emailTo       = $singleMessage['from'];

        $authUser        = $emailAddress; // As email is used as username
//        $username        = substr($authUser, 0, strpos($authUser, "@"));
        $username        = slugMaker($emailTo);
        $file_path       = "order_id_{$order->id}_LegalPDF.pdf";
        $emailToUsername = substr($emailTo, 0, strpos($emailTo, "@"));
        $logo            = url('web/assets/img/resize-image/logo-192x192.png');


        $text1 = $language == 'he' ? "מאובטח, מהיר ומעוצב" : "FAST & SECURED";
        $text2 = $language == 'en' ? 'מחלץ התכתבויות דוא"ל ל- PDF' : "Emails and Chats Extractor";


        $pdfHeader = $this->getHeaderHtml(
            $language=="en",
            $dateAt,
            $timeAt,
            $text1,
            $text2,
            $logo
        );

        $pdfFooter = $this->getFooterHtml();

        /**
         * Set Header and Footer Start
         * */

        // Get the Raw HTML Header
        $html = $this->getRawHeaderHtml(
            $logo,
            $username,
            $authUser,
            $emailTo,
            $dateAt,
            $timeAt,
            $language,
            count($messages),
            $singleMessage
        );

        /**
         * ###################################################
         *  Read the Messages End Write HTML into PDF Start
         * ###################################################
         * */
        $num = 0;
        foreach ($messages as $key=> $message) {
            $from    = $message['from'];
            $to      = $message['to'];
            $date    = $message['date'];
            $subject = $message['subject'];
            $body    = $message['body'];

            $messagePayload                   = $message;
            $messagePayload["order_id"]       = $order->id;
            $messagePayload["message_number"] = ($num+1);

            $msgNo = ($num+1);

            $num++;

            $eData = $message;

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

            $html .= view('web.pdf.pdf_view', $viewData)->render();
        }


        /**
         * ###################################################
         *  Read the Messages End Write HTML into PDF END
         * ###################################################
         * */

        // Write the Raw Footer HTML
        $html .= $this->getRawFooterHtml();

        $path = 'app/public/' . $file_path;
        $pdf = SnappyPdf::loadHTML($html)
            ->setTemporaryFolder(storage_path())
            ->setPaper('a4')
            ->setOption('encoding', 'UTF-8');
//                ->setOptions([
//                    'header-html' => view('new_pdf_header_design',compact('logo','text1','text2','dateAt','timeAt','language'))->render(),
//                    'footer-html' => view('new_pdf_footer_design'),
//                ]);

        info("pdf ready");

        info("storing pdf");
        Storage::put($path, $pdf->output());

        // Update PDF Generate End at
        $order->update([
            "pdf_gen_end_at"    => now(),
            "processing_status" => 4 // PDF Making End
        ]);

        return $responseWithoutStoragePath ? $file_path : storage_path('app/public/' . $file_path);
    }

    public function setLimitation()
    {
        ob_start();
        ini_set('memory_limit', -1);
        ini_set('max_execution_time', -1);
        set_time_limit(-1);
        ini_set("pcre.backtrack_limit", 500000000000);
    }


    public function singleMessage($messages){
        return $messages[0];
    }

    public function getHeaderHtml($isEnglish = true, $dateAt, $timeAt, $text1, $text2, $logo)
    {
        if($isEnglish){
            return '<header class="pdf-page-header" style="border-bottom:1.2px solid #7a7a7a">
                <div style="width:8%;float:left;">
                    <img
                        width="40"
                        height="40"
                        src="' . $logo . '"
                        loading="lazy"
                        alt="logo"
                     />
                </div>
                <div style="width:67%;float:left;">
                    <p>
                        <span style="color: #c3b019de;font-weight: bold;font-size: 1.6rem;">LegalPDF.co</span>
                        <br><span style="color:#7a7a7a;font-weight:bold">' . $text2 . '</span>
                    </p>
                </div>
                <div style="width:21%;float:right;text-align:right!important;">
                    <p><span style="text-align:right!important;color:#7a7a7a">' . $dateAt . ' at ' . $timeAt . '</span><br><span style="color: #c3b019de;font-size: 1.2rem;font-weight: bold;">' . $text1 . '</span></p>
                </div>
            </header>';
        }

        return '<header class="pdf-page-header" style="border-bottom:1.2px solid #7a7a7a; direction: rtl;">
            <div style="width:8%;float:right;">
                <img width="40"
                     height="40"
                     src="' . htmlspecialchars($logo, ENT_QUOTES, 'UTF-8') . '"
                     loading="lazy"
                     alt="logo"
               />
            </div>
            <div style="width:67%;float:right;">
                <p>
                    <span style="color: #c3b019de;font-weight: bold;font-size: 1.6rem;">LegalPDF.co</span>
                    <br><span style="color:#7a7a7a;font-weight:bold">' . htmlspecialchars($text2, ENT_QUOTES, 'UTF-8') . '</span>
                </p>
            </div>
            <div style="width:21%;float:left;text-align:left;">
                <p><span style="text-align:left;color:#7a7a7a">' . htmlspecialchars($dateAt, ENT_QUOTES, 'UTF-8') . ' ב-' . htmlspecialchars($timeAt, ENT_QUOTES, 'UTF-8') . '</span><br><span style="color: #c3b019de;font-size: 1.2rem;font-weight: bold;">' . htmlspecialchars($text1, ENT_QUOTES, 'UTF-8') . '</span></p>
            </div>
        </header>';
    }

    public function getFooterHtml()
    {
        return '<footer class="pdf-page-footer">
            <h3 class="title">- Page {PAGENO} of {nbpg} -</h3>
        </footer>';
    }

    public function getRawHeaderHtml(
        $logo,
        $username,
        $authUser,
        $emailTo,
        $dateAt,
        $timeAt,
        $language,
        $countData,
        $oneMessageParse = null
    )
    {

        $email        = extractEmail($oneMessageParse["from"]);
        $toFullString = $oneMessageParse["to"];

        if ($email == laravelGmailUser()) {
            $fromEmail = laravelGmailUser();
            $toEmail   = extractEmail($oneMessageParse["to"]);
        } else {
            $fromEmail = $email;
            $toEmail   = laravelGmailUser();
        }


        $fromUserName = extractName($oneMessageParse["from"]);
        $toUserName   = extractName($oneMessageParse["to"]);


        $htmlHeb = "<div style='direction: rtl;'>
                        <div style='width:25%;' class='left-align float-right'>
                             <div>
                            <img width='95' height='95' src='" . $logo . "' loading='lazy' alt='logo'>
                            </div>
                             <p class='logo-slogan' style='color: #c3b019de;font-size: 1.3rem;font-weight: bold;'> מאובטח, מהיר ומעוצב</p>
                        </div>
                        <div class='right-align float-right' style='width:75%;text-align: right;'>

                         <span class='title' style='color: #c3b019de; font-size:1.8rem;text-align:right!important'>
                         מחלץ התכתבויות דוא'ל ל- PDF
                         </span>
                                <p class='clear-both'>
                                    <span class='title' style='color: #c3b019de; font-size:1.8rem;text-align:right!important'>
                                    זהו מסמך רשמי מוכן לעיון ושימוש בבית המשפט.
                                    המסמך מכיל את כל המידע שהוזמן על ידי הלקוח הרשום מטה.
                                    </span>
                                </p>
                                <p  style='font-size: 1.6rem;color:#7a7a7a;margin-top:2.7rem;text-align:left'>
                                    www.LegalPDF.co | +44 2 089 850 107
                                </p>

                        </div>
                        <div class='clear-both'></div>
                    </div>";

        $htmlEn = "<div >
                        <div class='' style='width:25%;float:left'>
                            <div>
                                <img width='95' height='95' src='" . $logo . "' alt='logo' loading='lazy'/>
                            </div>
                             <p class='logo-slogan' style='color: #c3b019de;font-size: 1.3rem;font-weight: bold;'>
                                FAST & SECURED
                             </p>
                        </div>
                        <div style='width:75%;float:left'>
                            <p class='clear-both'>
                                <span class='title' style='color: #c3b019de; font-size:1.8rem;text-align:left!important'>
                                    Email's Messages into an Organised Document
                                </span>
                                <br>
                                <span  style='font-size: 1.6rem;color:#7a7a7a;text-align:lef!timportant'>
                                        This is an official document produced by LegalPDF. The Document authentically reflects
                                        email correspondence between the two parties mentioned below.
                                </span>
                            </p>
                            <p  style='font-size: 1.6rem;color:#7a7a7a;margin-top:2.7rem;text-align:left'>
                                   www.LegalPDF.co | +44 2 089 850 107
                            </p>

                        </div>
                        <div class='clear-both'></div>
                    </div>";

        $html2Heb = '
                    <div style="text-align:center;padding-top:10px;">
                        <span style="color: #7a7a7a; font-size: 1.2rem; font-weight: bold;">פרטי ההזמנה</span>
                    </div>
                    <div class="order-details-card">
                        <div class="card-items">
                            <div class="item">
                                <div style="width:30%; float:right; margin-top:20px;">
                                    <span style="color: #7A7A7A; font-size: 1.2rem; font-weight: bold;">הוזמן על ידי</span>
                                </div>
                                <div style="width:70%; float:left; text-align:left;">
                                    <span style="text-align:left; color: #7A7A7A!important; font-size: 1.2rem; font-weight: bold;">' . htmlspecialchars($username, ENT_QUOTES, 'UTF-8') . ' | ' . htmlspecialchars($authUser, ENT_QUOTES, 'UTF-8') . '</span>
                                </div>
                            </div>
                            <div class="item">
                                <div style="width:30%; float:right; margin-top:20px;">
                                    <span style="color: #7A7A7A!important; font-size: 1.2rem; font-weight: bold;" class="label">תאריך</span>
                                </div>
                                <div style="width:70%; float:left; text-align:left;">
                                    <span style="text-align:left; color: #7A7A7A!important; font-size: 1.2rem; font-weight: bold;" class="valueP">' . htmlspecialchars($dateAt, ENT_QUOTES, 'UTF-8') . ' ב-' . htmlspecialchars($timeAt, ENT_QUOTES, 'UTF-8') . '</span>
                                </div>
                            </div>
                            <div class="item">
                                <div style="width:30%; float:right; margin-top:20px;">
                                    <span style="color: #7A7A7A!important; font-size: 1.2rem; font-weight: bold;">פלטפורמה</span>
                                </div>
                                <div style="width:70%; float:left; text-align:left;">
                                    <span style="text-align:left; color: #7A7A7A!important; font-size: 1.2rem; font-weight: bold;" class="valueP">Gmail</span>
                                </div>
                            </div>
                            <div class="item">
                                <div style="width:30%; float:right; margin-top:20px;">
                                    <span style="color: #7A7A7A!important; font-size: 1.2rem; font-weight: bold;">מספר מיילים:</span>
                                </div>
                                <div style="width:70%; float:left; text-align:left;">
                                    <span style="text-align:left; color: #7A7A7A!important; font-size: 1.2rem; font-weight: bold;" class="valueP">' . htmlspecialchars($countData, ENT_QUOTES, 'UTF-8') . '</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="additional-card">
                        <h3 class="card-title">המסמך הבא מכיל התכתבויות שבין הצדדים הבאים:</h3>
                        <div class="card-box">
                            <div class="card-p float-right">
                                <p class="text-center"><span class="label">שם: </span>&nbsp;<span class="content">' . htmlspecialchars($fromUserName, ENT_QUOTES, 'UTF-8') . '</span></p>
                                <p class="text-center"><span class="label">מייל: </span>&nbsp;<span class="content">' . htmlspecialchars($fromEmail, ENT_QUOTES, 'UTF-8') . '</span></p>
                            </div>
                            <div class="card-c float-right">
                                <h1 class="text-center"><span class="content">ו</span></h1>
                            </div>
                            <div class="card-p float-right">
                                <p class="text-center"><span class="label">שם: </span>&nbsp;<span class="content">' . htmlspecialchars($toUserName, ENT_QUOTES, 'UTF-8') . '</span></p>
                                <p class="text-center"><span class="label">מייל: </span>&nbsp;<span class="content">' . htmlspecialchars($toEmail, ENT_QUOTES, 'UTF-8') . '</span></p>
                            </div>
                            <div class="clear-both"></div>
                        </div>
                    </div>
                    <p class="notes">התכתובות הבאות מסודרות מהחדש ביותר בראש המסמך, ועד הישן ביותר בתחתית המסמך</p>';


        $html2Heb_backup = "
                     <div style='text-align:center;padding-top:10px;'>
                        <span  style='color: #7a7a7a; font-size: 1.2rem; font-weight: bold;'>פרטי הזמנה</span>
                     </div>
                     <div class='order-details-card'>

                        <div class='card-items'>
                            <div class='item'>
                                <div style='width:30%; float:right; margin-top:20px;'>
                                <span style='color: #7A7A7A; font-size: 1.2rem; font-weight: bold;'>הוזמן על ידי</span>
                            </div>
                                <p class='valueP'>" . $username . " | " . $authUser . "</p>
                            </div>
                            <div class='item'>
                                <p>תאריך </p>
                                <p class='valueP'>" . $dateAt . " at " . $timeAt . "</p>
                            </div>
                            <div class='item'>
                                <p>פלטפורמה </p>
                                <p class='valueP'>Gmail </p>
                            </div>
                            <div class='item'>
                                <p>כמות תכתובות </p>
                                <p class='valueP'>" . $countData . "</p>
                            </div>
                        </div>
                    </div>
                    <div class='additional-card'>
                        <h3 class='card-title'>המסמך הבא מכיל התכתבויות שבין הצדדים הבאים:</h3>
                        <div class='card-box'>
                              <div class='card-p float-left'>
                                <p class='text-center'><span class='label'>שֵׁם: </span>&nbsp;<span class='content'>" .  $fromUserName . "</span></p>
                                <p class='text-center'><span class='label'>אימייל: </span>&nbsp;<span class='content'>" . $fromEmail . "</span></p>
                            </div>
                            <div class='card-c float-left'>
                                <h1 class='text-center'><span class='content'>עם</span></h1>
                            </div>
                            <div class='card-p float-left'>
                                <p class='text-center'><span class='label'>שֵׁם: </span>&nbsp;<span class='content'>" . $toUserName . "</span></p>
                                <p class='text-center'><span class='label'>אימייל: </span>&nbsp;<span class='content'>" . $toEmail . "</span></p>
                            </div>
                            <div class='clear-both'></div>
                        </div>
                    </div>
                    <p class='notes'>התכתובות הבאות מסודרות מהחדש ביותר בראש המסמך, ועד הישן ביותר בתחתית המסמך</p>";




        $nameParts = explode(" ", $fromUserName);

        $html2En = '
        <div style="text-align:center;padding-top:10px;">
            <span  style="color: #7a7a7a; font-size: 1.2rem; font-weight: bold;">Order details</span>
        </div>
        <div class="order-details-card">

            <div class="card-items">
                <div class="item">
                    <div style="width:30%; float:left; margin-top:20px;">
                        <span style="color: #7A7A7A; font-size: 1.2rem; font-weight: bold;">Ordered by</span>
                    </div>
                    <div style="width:70%; float:right; text-align:right;">
                        <span style="text-align:right; color: #7A7A7A!important; font-size: 1.2rem; font-weight: bold;">' . htmlspecialchars($nameParts[0], ENT_QUOTES, 'UTF-8') . ' | ' . htmlspecialchars($authUser, ENT_QUOTES, 'UTF-8') . '</span>
                    </div>
                </div>
                <div class="item">
                    <div style="width:30%; float:left; margin-top:20px;">
                        <span style="color: #7A7A7A!important; font-size: 1.2rem; font-weight: bold;" class="label">Date</span>
                    </div>
                    <div style="width:70%; float:right; text-align:right;">
                        <span style="text-align:right; color: #7A7A7A!important; font-size: 1.2rem; font-weight: bold;" class="valueP">' . htmlspecialchars($dateAt, ENT_QUOTES, 'UTF-8') . ' at ' . htmlspecialchars($timeAt, ENT_QUOTES, 'UTF-8') . '</span>
                    </div>
                </div>
                <div class="item">
                    <div style="width:30%; float:left; margin-top:20px;">
                        <span style="color: #7A7A7A!important; font-size: 1.2rem; font-weight: bold;">Platform</span>
                    </div>
                    <div style="width:70%; float:right; text-align:right;">
                        <span style="text-align:right; color: #7A7A7A!important; font-size: 1.2rem; font-weight: bold;" class="valueP">Gmail</span>
                    </div>
                </div>
                <div class="item">
                    <div style="width:30%; float:left; margin-top:20px;">
                        <span style="color: #7A7A7A!important; font-size: 1.2rem; font-weight: bold;">Number of emails:</span>
                    </div>
                    <div style="width:70%; float:right; text-align:right;">
                        <span style="text-align:right; color: #7A7A7A!important; font-size: 1.2rem; font-weight: bold;" class="valueP">' . htmlspecialchars($countData, ENT_QUOTES, 'UTF-8') . '</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="additional-card">
            <h3 class="card-title">The following document contains emails between</h3>
            <div class="card-box">
                <div class="card-p float-left">
                    <p class="text-center"><span class="label">Name: </span>&nbsp;<span class="content">' . htmlspecialchars($fromUserName, ENT_QUOTES, 'UTF-8') . '</span></p>
                    <p class="text-center"><span class="label">Email: </span>&nbsp;<span class="content">' . htmlspecialchars($fromEmail, ENT_QUOTES, 'UTF-8') . '</span></p>
                </div>
                <div class="card-c float-left">
                    <h1 class="text-center"><span class="content">And</span></h1>
                </div>
                <div class="card-p float-left">
                    <p class="text-center"><span class="label">Name: </span>&nbsp;<span class="content">' . htmlspecialchars($toUserName, ENT_QUOTES, 'UTF-8') . '</span></p>
                    <p class="text-center"><span class="label">Email: </span>&nbsp;<span class="content">' . htmlspecialchars($toEmail, ENT_QUOTES, 'UTF-8') . '</span></p>
                </div>
                <div class="clear-both"></div>
            </div>
        </div>
        <p class="notes">* The following emails are in order from newest to oldest</p>';


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
                            .h-wrapper {
                              direction: rtl;
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
                                font-size: 1.2rem;

                                color: #7a7a7a;
                                font-weight: bold;
                            }
                            .label {
                                text-align: right;
                                color: #7a7a7a;
                                font-size: 1.2rem;
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
                                padding: 0.1rem 0
                            }

                            section.pdf-invoice .order-details-card .card-items .item {
                                border-bottom: 1.5px dotted #7a7a7a;
                                padding: 0.1rem 0;
                                color: #7a7a7a;
                                font-size: 1.2rem;
                                font-weight: 400;

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
                                font-size: 1.2rem;
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
                                font-size: 1.4rem;
                                font-weight: 400;
                                line-height: 2.3rem
                            }

                            section.pdf-message-collection .message-counter-head {
                                border-top: .1rem solid #7a7a7a;

                            }

                            section.pdf-message-collection .message-counter-head p.text-1 {
                                color: #7a7a7a;
                                font-size: 1.6rem;
                                font-weight: 200;

                            }

                            section.pdf-message-collection .message-counter-head p.text-2 {
                                text-align: center;
                                color: #7a7a7a;
                                font-size: 1.4rem;
                                font-weight: 200;

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
                                font-size: 1.4rem;
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
                                width: 10%;
                                padding-top:5px;
                                padding-bottom:5px;
                                float:left;
                            // background-color:red;
                            }

                            .subjectDiv{
                                display:inline-block;
                                width: 70%;
                                float:left;
                                text-align:center;
                                  padding-top:5px;
                                padding-bottom:5px;
                                // background-color:green;

                            }

                            .dateDiv{
                                width: 20%;
                                text-align:right;
                                  padding-top:5px;
                                padding-bottom:5px;
                                // background-color:brown;
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
        $html .= "<body dir='" . ($language == 'he' ? 'rtl' : '') . "'>
                    <header class='pdf-header'>";


        $html .= $display;

        $html .= "  </header>
                    <section class='pdf-invoice'>" . $display2 . "</section>
                    <section class='pdf-message-collection'>";

        return $html;
    }

    public function getRawFooterHtml()
    {
        $html = "</section>
                </body>
            </html>";

        return $html;
    }



    public function workingCreatePDF($jsonFile)
    {
        // Check the file is exists or Not
        if(!File::exists($jsonFile)){
            info("File not found: " . $jsonFile);
        }

        // Get the file
        $jsonData = File::get($jsonFile);

        // Decode the file with the json_decode function
        $messages  = json_decode($jsonData, true);


        // Loop the array and convert into pdf
        foreach ($messages as $key=> $message) {
            $from    = $message['from'];
            $to      = $message['to'];
            $date    = $message['date'];
            $subject = $message['subject'];
            $body    = $message['body'];


        }
    }


    public function createPdfFromDatabase($order)
    {
        setMemoryLimitation();

        $date            = now()->format('d_m_Y');
        $datePrefix      = now()->format('d_m_Y_h_i_s_v');
        $dateAt          = now()->format('d/m/Y');
        $timeAt          = now()->format('H:i:s');


        $orderMessages    = $order->orderMessages;
        $singleMessage   = json_decode($orderMessages->first()->message, true);
        $emailTo         = $order->recipient_email;
        $recipientEmail  = $order->recipient_email;
        $emailAddress    = $emailTo; // As email is used as username
        $authUser        = $order->from_email; // As email is used as username
        $username        = slugMaker($emailTo);
        $file_path       = $username . '_' . $datePrefix . '_LegalPDF.pdf';
        $emailToUsername = substr($recipientEmail, 0, strpos($recipientEmail, "@"));
        $logo            = url('web/assets/img/resize-image/logo-192x192.png');


        $language = $order->language;

        $text1 = $language == 'he' ? "מאובטח, מהיר ומעוצב" : "FAST & SECURED";
        $text2 = $language == 'en' ? 'מחלץ התכתבויות דוא"ל ל- PDF' : "Emails and Chats Extractor";


        $pdfHeader = $this->getHeaderHtml(
            $language=="en",
            $dateAt,
            $timeAt,
            $text1,
            $text2,
            $logo
        );

        $pdfFooter = $this->getFooterHtml();

        /**
         * Set Header and Footer Start
         * */

        $html = $this->getRawHeaderHtml(
            $logo,
            $username,
            $authUser,
            $emailTo,
            $dateAt,
            $timeAt,
            $language,
            $orderMessages->count(),
            $singleMessage
        );

        /**
         * ###################################################
         *  Read the Messages End Write HTML into PDF Start
         * ###################################################
         * */
        $num = 0;

        foreach ($orderMessages as $key=> $orderMessage) {
            $message = json_decode($orderMessage->message, true);

            $from    = $message['from'];
            $to      = $message['to'];
            $date    = $message['date'];
            $subject = $message['subject'];
            $body    = $message['body'];
            $inc_array = [];

            if(!empty($orderMessage->keyword)){
                $inc_array = explode(",", $orderMessage->keyword);
            }

            $messagePayload                   = $message;
            $messagePayload["order_id"]       = $order->id;
            $messagePayload["message_number"] = ($num+1);

            $msgNo = ($num+1);

            info("Order ID:{$order->id} Message Number: {$msgNo}");

            $num++;

            $eData = $message;

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

            $html .= view('web.pdf.pdf_view', $viewData)->render();
        }

        /**
         * ###################################################
         *  Read the Messages End Write HTML into PDF END
         * ###################################################
         * */

        // Write the Raw Footer HTML
        $html .= $this->getRawFooterHtml();

        $path = 'app/public/' . $file_path;
        $pdf = SnappyPdf::loadHTML($html)
            ->setTemporaryFolder(storage_path())
            ->setPaper('a4')
            ->setOption('encoding', 'UTF-8');
//                ->setOptions([
//                    'header-html' => view('new_pdf_header_design',compact('logo','text1','text2','dateAt','timeAt','language'))->render(),
//                    'footer-html' => view('new_pdf_footer_design'),
//                ]);

        info("pdf ready");

        info("storing pdf");
        Storage::put($path, $pdf->output());

        $responseWithoutStoragePath = true;

        return $responseWithoutStoragePath ? $file_path : storage_path('app/public/' . $file_path);
    }
}
