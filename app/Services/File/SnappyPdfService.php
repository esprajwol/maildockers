<?php


namespace App\Services\File;


use App\Models\Order;
use App\Services\Google\OrderMessageService;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use DOMDocument;
use DOMXPath;
use App\TokenStore\TokenCache;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use TijsVerkoyen\CssToInlineStyles\CssToInlineStyles;
use File;
use PhpOffice\PhpSpreadsheet\Calculation\Financial\CashFlow\Single;

class SnappyPdfService
{
    public static function generate(Order $order, array $messages, array $keywords, string $language = "en")
    {
        // Set up variables for pdf generation
        $singleMessage = $messages[0];
        $timezone = $order->timezone ?? config('app.timezone');
        $dateAt = now()->setTimezone($timezone)->format('d/m/Y');
        $timeAt = now()->setTimezone($timezone)->format('H:i:s');
        $fromEmail = $order->from_email;
        $toEmail = $order->recipient_email;
        $logo = url('web/assets/img/resize-image/logo-192x192.png');
        $datePrefix = now()->setTimezone($timezone)->format('d_m_Y_h_i_s_v');
        $username = substr($order->from_email, 0, strpos($order->from_email, "@"));
        $pdfFile = $username . '_' . $datePrefix . '_LegalPDF.pdf';
        $pdfPath = storage_path("app/public/{$pdfFile}");
        $platform = ($order->platform_type == 1) ? "Gmail" : "Outlook";

        //$singleMessage = self::processGmailHeader($fromEmail,$toEmail,$singleMessage);

        $fromUserName = "";
        $toUserName = "";

        $isFoundFromUserName = false;
        $isFoundToUserName = false;

        $result = self::getGmailUserName($fromEmail, $singleMessage);
        if ($result['status']) {
            $fromUserName = $result['name'];
            $isFoundFromUserName = true;
        }

        $result = self::getGmailUserName($toEmail, $singleMessage);
        if ($result['status']) {
            $toUserName = $result['name'];
            $isFoundToUserName = true;
        }

        // Define the chunk size
        $chunkSize = 20; // Adjust this based on memory capacity

        // Initialize an array to store the HTML render data
        $htmlData = [];

        // Process the messages in chunks
        $chunks = array_chunk($messages, $chunkSize);

        $count = 1;
        $total = count($messages);

        $total_document_count = 0;
        $documentList = array();


        // Language PDF Direction 
        $direction = "ltr"; // default direction
        $language = \App\Models\Language::where('code', $language)->first(); // Retrieve the language model
        if ($language && ($language->direction)) {
            $direction = $language->direction;
        }



        foreach ($chunks as $index => $chunk) {
            foreach ($chunk as $message) {
                //$message = self::processGmailHeader($fromEmail,$toEmail,$message);

                if (!$isFoundFromUserName) {
                    $result = self::getGmailUserName($fromEmail, $message);
                    if ($result['status']) {
                        $fromUserName = $result['name'];
                        $isFoundFromUserName = true;
                    }
                }

                if (!$isFoundToUserName) {
                    $result = self::getGmailUserName($toEmail, $message);
                    if ($result['status']) {
                        $toUserName = $result['name'];
                        $isFoundToUserName = true;
                    }
                }

                $result = self::getGmailPdfReceiverName($message, $fromEmail, $toEmail);

                $message['senderName'] = $result['senderName'];
                $message['receiverName'] = $result['receiverName'];

                // Render the HTML for each message and store it in the $htmlData array


                if (isset($message['threads']) && count($message['threads']) >= 2) {
                    $message['body_type'] = "html";
                    $data = [];
                    foreach ($message['threads'] as $thread) {
                        if (!$isFoundFromUserName) {
                            $result = self::getGmailUserName($fromEmail, $thread);
                            if ($result['status']) {
                                $fromUserName = $result['name'];
                                $isFoundFromUserName = true;
                            }
                        }

                        if (!$isFoundToUserName) {
                            $result = self::getGmailUserName($toEmail, $thread);
                            if ($result['status']) {
                                $toUserName = $result['name'];
                                $isFoundToUserName = true;
                            }
                        }

                        $body = '';
                        $attachments = [];

                        if (!empty($thread['body']['html'])) {
                            $removeSignature = ($fromEmail == extractEmail($thread['from'][0]));
                            $body = self::processGmailHtmlContent($thread['body']['html'], $removeSignature, $keywords, true);
                            $attachments = self::getDocumentData($thread, $message['senderName'], $timezone);
                        } elseif (!empty($thread['body']['text'])) {
                            // If HTML is empty, fall back to text content
                            $body = self::processGmailTextContent($thread['body']['text'], $keywords);
                            $attachments = self::getDocumentData($thread, $message['senderName'], $timezone);
                        }

                        $carbonDate = Carbon::createFromTimestampMs($thread['date_in_ms'])->setTimezone($timezone);
                        $date = $carbonDate->format('d/m/Y');
                        $time = $carbonDate->format('H:i:s');

                        $content = $body;

                        $result = self::getGmailPdfReceiverName($thread, $fromEmail, $toEmail);

                        $data[] = [
                            'time' => $time,
                            'date' => $date,
                            'content' => $content,
                            'senderName' => $result['senderName'],
                            'receiverName' => $result['receiverName'],
                            'attachments' => $attachments,
                        ];
                    }
                    $message['body'] = $data;
                } elseif (!empty($message['body']['html'])) {
                    $message['body_type'] = "html";
                    $removeSignature = ($fromEmail == extractEmail($message['from'][0]));
                    $message['body'] = self::processGmailHtmlContent($message['body']['html'], $removeSignature, $keywords, false);
                    if (isset($message['threads'][0])) {
                        $message['attachments'] =  self::getDocumentData($message['threads'][0], $message['senderName'], $timezone);
                    }
                } elseif (!empty($message['body']['text'])) {
                    $message['body_type'] = "text";
                    $message['body'] = self::processGmailTextContent($message['body']['text'], $keywords);
                    if (isset($message['threads'][0])) {
                        $message['attachments'] =  self::getDocumentData($message['threads'][0], $message['senderName'], $timezone);
                    }
                } else {
                    // Set body as empty if neither HTML nor text is available
                    $message['body_type'] = "empty";
                    $message['body'] = '';
                }
                //count the document list

                if (isset($message['threads']) && count($message['threads']) >= 2) {
                    foreach ($message['threads'] as $threadKey => $thread) {
                        $data = self::getDocumentData($thread, $message['senderName'], $timezone);
                        if (!empty($data)) {
                            $documentList = array_merge($documentList, $data); // Merge documents from the thread into the main list
                        }
                    }
                } else {
                    if (isset($message['threads'][0])) {
                        $data = self::getDocumentData($message['threads'][0], $message['senderName'], $timezone);
                        if (!empty($data)) {
                            $documentList = array_merge($documentList, $data); // Merge main message documents into the list
                        }
                    }
                }

                // get the total document count
                $total_document_count = count($documentList);
                $message['isAttachmentSelected'] = $order->search_attachments_list;
                // set timezone
                $carbonDate = Carbon::createFromTimestampMs($message['date_in_ms'])->setTimezone($timezone);
                $message['date'] = $carbonDate->format('d/m/Y H:i:s');
                $htmlData[] = self::renderPdfBody($message, $count, $language);

                $progress = 50 + floor(($count / $total) * 45);

                // Update progress in Redis
                $orderKey = $order->id;
                $redisKey = "job_progress_{$orderKey}";
                Redis::set($redisKey, json_encode(['status' => 'processing', 'progress' => $progress]));
                $count++;
            }
        }
        $isAttachmentSelected = $order->search_attachments_list;
        $htmlData[] = View::make('wkhtmltopdf.pdf-document-list', compact('documentList', 'direction', 'language', 'isAttachmentSelected'))->render();

        if (empty($fromUserName)) {
            $fromUserName = $fromEmail;
        }
        if (empty($toUserName)) {
            $toUserName = $toEmail;
        }

        $fromReplacement = $isFoundFromUserName ? $fromUserName : $fromEmail;
        $toReplacement = $isFoundToUserName ? $toUserName : $toEmail;

        //replace the name from html
        foreach ($htmlData as $key => $html) {
            $html = str_ireplace("--$fromEmail--", $fromReplacement, $html);
            $html = str_ireplace("--$toEmail--", $toReplacement, $html);

            // Update the original $htmlData array with the modified $html
            $htmlData[$key] = $html;
        }

        // Remove unwanted string
        foreach ($htmlData as $htmlDataKey => $htmlDataValue) {
            if (gettype($htmlData[$htmlDataKey]) === "string") {
                $removeCharArray = ['�'];
                foreach ($removeCharArray as $removeCharValue) {
                    $htmlData[$htmlDataKey] = str_replace($removeCharValue, " ", $htmlData[$htmlDataKey]);
                }
            }
        }

        // Combine all HTML parts into one
        $htmlContent = View::make('wkhtmltopdf.pdf-final-file', [
            'htmlData' => $htmlData,
            'logo' => $logo,
            'language' => $language,
            'dateAt' => $dateAt,
            'timeAt' => $timeAt,
            'fromEmail' => $fromEmail,
            'fromUserName' => $fromUserName,
            'toEmail' => $toEmail,
            'toUserName' => $toUserName,
            'countData' => $count - 1,
            'platform' => $platform,
            'direction' => $direction,
            'allow_attachments' => $order->search_attachments_list,
            'total_document_count' => $total_document_count,
        ])->render();

        if (!File::isDirectory(storage_path('app/public/temp'))) {
            //make the directory because it doesn't exists
            File::makeDirectory(storage_path('app/public/temp'));
        }

        // Save the HTML content to a temporary file
        $tempHtmlFile = storage_path("app/public/temp/{$username}_{$datePrefix}_body_temp.html");
        file_put_contents($tempHtmlFile, $htmlContent);

        // Get Header content from the view file
        //        $headerContent = View::make('wkhtmltopdf.pdf-header', [
        //            'language' => $language,
        //            'dateAt' => $dateAt,
        //            'timeAt' => $timeAt,
        //        ])->render();

        // Save the header content to a temporary file
        //        $tempHeaderFile = storage_path("app/public/temp/{$username}_{$datePrefix}_header_temp.html");
        //        file_put_contents($tempHeaderFile, $headerContent);

        // Get Footer content from the view file
        $footerContent = View::make('wkhtmltopdf.pdf-footer')->render();

        // Save the header content to a temporary file
        $tempFooterFile = storage_path("app/public/temp/{$username}_{$datePrefix}_footer_temp.html");
        file_put_contents($tempFooterFile, $footerContent);

        // Path to wkhtmltopdf binary
        $wkhtmltopdfPath = config('snappy.pdf.binary');

        // Define options for wkhtmltopdf
        $options = [
            "--zoom 1.0", // Adjust zoom level to control scaling
            "--viewport-size 1024x768", // Set a standard viewport size
            //"--header-spacing 10",
            "--margin-top 10mm",
            "--margin-bottom 20mm",
            "--margin-left 10mm",
            "--margin-right 10mm",
            //"--header-html '" . $tempHeaderFile . "'",
            "--footer-html '" . $tempFooterFile . "'",
            "--footer-spacing 10",
            "--load-error-handling skip",
            "--load-media-error-handling skip",
            "--disable-smart-shrinking",
            "--log-level warn",
            "--disable-external-links",
            //"--disable-internal-links",
            //"--no-pdf-compression"
            //"--enable-internal-links",
        ];

        // Generate the full command with options
        // $command = "$wkhtmltopdfPath " . implode(' ', $options) . " $tempHtmlFile $pdfPath";
        $command = "ulimit -n 60000 && \"$wkhtmltopdfPath\" " . implode(' ', $options) . " $tempHtmlFile $pdfPath";
        exec($command, $output, $return_var);

        // Clean up temporary file
        //        if (file_exists($tempHtmlFile)) {
        //            unlink($tempHtmlFile);
        //        }

        //        if (file_exists($tempHeaderFile)) {
        //            unlink($tempHeaderFile);
        //        }

        if (file_exists($tempFooterFile)) {
            unlink($tempFooterFile);
        }

        if ($return_var === 0) {

            return $pdfFile;
        } else {
            if (file_exists($pdfPath)) {
                return $pdfFile;
            } else {
                return null;
            }
        }
    }


    public static function getDocumentData($message, $sender_name, $timezone)
    {
        $carbonDate = Carbon::createFromTimestampMs($message['date_in_ms'])->setTimezone($timezone);
        $date = $carbonDate->format('d/m/Y');
        $time = $carbonDate->format('H:i');

        $documentList = array();
        if (!empty($message['body']['document'])) {
            foreach ($message['body']['document'] as $document) {

                $documentList[] = [
                    'date' => $date,
                    'time' => $time,
                    'sender_name' => 'sent by ' . $sender_name,
                    'file_name' => $document['filename'],
                    'attachment_id' => $document['attachmentId']
                ];
            }
        }

        return $documentList;
    }

    public static function getGmailUserName($checkEmail, $message)
    {
        $emails = array_merge($message['from'], $message['to'], $message['cc'], $message['bcc']);
        foreach ($emails as $email) {
            if (extractEmail($email) == $checkEmail) {
                $name = extractName($email);
                if (!empty($name)) {
                    return ['status' => true, 'name' => $name];
                }
            }
        }

        return ['status' => false, 'name' => ''];
    }


    public static function getOutlookUserName($checkEmail, $messageHeaderEmails)
    {
        foreach ($messageHeaderEmails as $email) {
            if (extractEmail($email) == $checkEmail) {
                $name = extractName($email);
                if (!empty($name)) {
                    return ['status' => true, 'name' => $name];
                }
            }
        }

        return ['status' => false, 'name' => ''];
    }

    public static function formatGmailEmailAddress($name, $email, $fromEmail, $toEmail)
    {
        $email = Str::lower($email);
        if (!empty($name)) {
            return $name;
        } else {
            return ($email === $fromEmail || $email === $toEmail) ? "--$email--" : $email;
        }
    }

    public static function getGmailPdfReceiverName($message, $fromEmail, $toEmail)
    {
        $senderNames = [];
        $receiverNames = [];
        $ccNames = [];
        $bccNames = [];


        // Extract sender names
        foreach ($message['from'] as $from) {
            $name = extractName($from);
            $email = extractEmail($from); // Assuming extractEmail is available
            $senderNames[] = self::formatGmailEmailAddress($name, $email, $fromEmail, $toEmail);
        }

        // Extract receiver names
        foreach ($message['to'] as $to) {
            $name = extractName($to);
            $email = extractEmail($to);
            $receiverNames[] = self::formatGmailEmailAddress($name, $email, $fromEmail, $toEmail);
        }

        // Extract cc names
        foreach ($message['cc'] as $cc) {
            $name = extractName($cc);
            $email = extractEmail($cc);
            $ccNames[] = self::formatGmailEmailAddress($name, $email, $fromEmail, $toEmail);
        }

        // Extract bcc names
        foreach ($message['bcc'] as $bcc) {
            $name = extractName($bcc);
            $email = extractEmail($bcc);
            $bccNames[] = self::formatGmailEmailAddress($name, $email, $fromEmail, $toEmail);
        }

        // Combine names into strings if needed (for example, comma-separated)
        $senderName = implode(', ', $senderNames);
        $receiverName = implode(', ', $receiverNames);
        $ccName = implode(', ', $ccNames);
        $bccName = implode(', ', $bccNames);

        $receiverOriginalString = $receiverName;

        if (empty($receiverName) && !empty($ccName)) {
            $receiverOriginalString .= "CC: " . $ccName;
        } elseif (!empty($ccName)) {
            $receiverOriginalString .= ", CC: " . $ccName;
        }

        if (empty($receiverOriginalString) && !empty($bccName)) {
            $receiverOriginalString .= "BCC: " . $bccName;
        } elseif (!empty($bccName)) {
            $receiverOriginalString .= ", BCC: " . $bccName;
        }

        return [
            'senderName' => $senderName,
            'receiverName' => $receiverOriginalString
        ];
    }


    public static function getOutlookPdfReceiverName($message, $fromEmail, $toEmail)
    {
        $senderNames = [];
        $receiverNames = [];
        $ccNames = [];
        $bccNames = [];


        // Extract sender names
        $name = extractName($message['from']);
        $email = extractEmail($message['from']); // Assuming extractEmail is available
        $senderNames[] = self::formatGmailEmailAddress($name, $email, $fromEmail, $toEmail);


        $name = extractName($message['to']);
        $email = extractEmail($message['to']);
        $receiverNames[] = self::formatGmailEmailAddress($name, $email, $fromEmail, $toEmail);


        // Extract cc names
        if (isset($message['cc']) && is_array($message['cc'])) {
            foreach ($message['cc'] as $cc) {
                $name = extractName($cc);
                $email = extractEmail($cc);
                $ccNames[] = self::formatGmailEmailAddress($name, $email, $fromEmail, $toEmail);
            }
        }

        // Extract bcc names
        if (isset($message['bcc']) && is_array($message['bcc'])) {
            foreach ($message['bcc'] as $bcc) {
                $name = extractName($bcc);
                $email = extractEmail($bcc);
                $bccNames[] = self::formatGmailEmailAddress($name, $email, $fromEmail, $toEmail);
            }
        }

        // Combine names into strings if needed (for example, comma-separated)
        $senderName = implode(', ', $senderNames);
        $receiverName = implode(', ', $receiverNames);
        $ccName = implode(', ', $ccNames);
        $bccName = implode(', ', $bccNames);

        $receiverOriginalString = $receiverName;

        if (empty($receiverName) && !empty($ccName)) {
            $receiverOriginalString .= "CC: " . $ccName;
        } elseif (!empty($ccName)) {
            $receiverOriginalString .= ", CC: " . $ccName;
        }

        if (empty($receiverOriginalString) && !empty($bccName)) {
            $receiverOriginalString .= "BCC: " . $bccName;
        } elseif (!empty($bccName)) {
            $receiverOriginalString .= ", BCC: " . $bccName;
        }

        return [
            'senderName' => $senderName,
            'receiverName' => $receiverOriginalString
        ];
    }

    public static function processGmailHeader($fromEmail, $toEmail, $message)
    {
        $message['from'] = self::findEmailInArray($fromEmail, $toEmail, $message['from'], true);
        $message['to'] = self::findEmailInArray($fromEmail, $toEmail, $message['to'], true);
        $message['cc'] = self::findEmailInArray($fromEmail, $toEmail, $message['cc']);
        $message['bcc'] = self::findEmailInArray($fromEmail, $toEmail, $message['bcc']);

        return $message;
    }

    public static function processGmailHtmlContent($body, $removeSignature, $keywords, $isThread)
    {
        $detectedCharset = iconv_get_encoding($body);
        $charset = !empty($body) && $detectedCharset ? $detectedCharset : 'UTF-8';

        // Process HTML body
        if ($isThread) {
            $body = self::processEmailContent($body, $charset);
        }

        // Remove image tag from html
        $body = self::removeImageTagFromBody($body);

        // Remove extra spaces like br
        $body = self::removeExtraSpacesFromHtml($body);

        // Remove the signature
        $body = self::removeGmailSignature($body);

        // style tag to inline css
        $body = self::convertClassesToInlineStyles($body, $charset);

        // Replace the body tag to div
        $body = self::replaceBodyTagWithDiv($body);

        // Highlight the text with keywords provided
        $body = self::highlightKeywordsInHtml($body, $keywords, $charset);


        //        if ($removeSignature) {
        //            // Remove the signature
        //            $body = self::removeGmailSignature($body);
        //        }

        $body = html_entity_decode($body, ENT_HTML5, 'UTF-8');
        return $body;
    }

    public static function processGmailTextContent($body, $keywords)
    {
        $body = self::getRealMessage($body);
        $body = self::highlightKeywords($body, $keywords);
        return $body;
    }

    public static function findEmailInArray($fromEmail, $toEmail, $emailArray, $isSender = false)
    {

        $matches = [];
        if (count($emailArray) == 1) {
            return ($isSender) ? $emailArray : [];
        }

        foreach ($emailArray as $emailString) {
            $email = extractEmail($emailString);
            if ($email == $fromEmail || $email == $toEmail) {
                // Return email matches
                $matches[] = $emailString;
            }
        }

        // Return empty if no match is found
        return $matches;
    }

    public static function getUserName($email, $singleMessageFrom, $singleMessageTo)
    {
        if (extractEmail($singleMessageFrom) == $email) {
            $name = extractName($singleMessageFrom);
            if (!empty($name)) {
                return ['status' => true, 'name' => $name];
            }
        }

        if (extractEmail($singleMessageTo) == $email) {
            $name = extractName($singleMessageTo);
            if (!empty($name)) {
                return ['status' => true, 'name' => $name];
            }
        }

        return ['status' => false, 'name' => ''];
    }

    public static function convertClassesToInlineStyles($html, $charset = 'UTF-8')
    {
        try {
            // Ensure the input HTML is UTF-8 encoded
            if (strtolower($charset) !== 'utf-8') {
                try {
                    $html = mb_convert_encoding($html, 'UTF-8', $charset);
                } catch (\Exception $e) {
                    error_log("Error in character encoding conversion: " . $e->getMessage());
                }
            }

            try {
                // Use Tidy to clean up and standardize the HTML
                $config = [
                    'clean' => true,
                    'output-html' => true,
                    'show-body-only' => false,
                    'wrap' => 0,
                    'newline' => 'LF',
                    'drop-empty-elements' => true,
                    'drop-empty-paras' => true,
                    'force-output' => true,
                    'char-encoding' => 'utf8',
                ];

                $tidy = new \tidy();
                $html = $tidy->repairString($html, $config, 'UTF8');
            } catch (\Exception $e) {
                error_log("Error in Tidy processing: " . $e->getMessage());
            }

            try {
                $converter = new CssToInlineStyles();
                $html = $converter->convert($html);
            } catch (\Exception $e) {
                error_log("Error in CSS to inline style conversion: " . $e->getMessage());
            }

            // Now use DOMDocument to process the cleaned HTML
            $dom = new \DOMDocument();

            libxml_use_internal_errors(true);

            try {
                $html = '<?xml encoding="UTF-8">' . $html;
                @$dom->loadHTML($html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            } catch (\Exception $e) {
                error_log("Error loading HTML into DOMDocument: " . $e->getMessage());
            }

            $xpath = new \DOMXPath($dom);
            $styles = [];

            try {
                // Extract and apply styles from <style> tags
                $styleNodes = $dom->getElementsByTagName('style');
                foreach ($styleNodes as $styleNode) {
                    $css = $styleNode->textContent;
                    $styleNode->parentNode->removeChild($styleNode);

                    preg_match_all('/([.#]?\w+|[a-z]+\.\w+)\s*{(.*?)}/s', $css, $matches, PREG_SET_ORDER);
                    foreach ($matches as $match) {
                        $selector = trim($match[1]);
                        $cssRules = trim($match[2]);
                        $styles[$selector] = $cssRules;
                    }
                }
            } catch (\Exception $e) {
                error_log("Error processing <style> tags: " . $e->getMessage());
            }

            try {
                // Apply inline styles to elements
                $elements = $dom->getElementsByTagName('*');
                foreach ($elements as $element) {
                    $tagName = $element->tagName;
                    $idAttr = $element->getAttribute('id');
                    $classAttr = $element->getAttribute('class');

                    $inlineStyles = '';

                    // Apply tag-based styles (e.g., div { ... })
                    if (isset($styles[$tagName])) {
                        $inlineStyles .= $styles[$tagName] . ' ';
                    }

                    // Apply ID-based styles (e.g., #id { ... })
                    if ($idAttr && isset($styles["#$idAttr"])) {
                        $inlineStyles .= $styles["#$idAttr"] . ' ';
                    }

                    // Apply class-based styles (e.g., .class { ... })
                    if ($classAttr) {
                        $classes = explode(' ', $classAttr);
                        foreach ($classes as $class) {
                            if (isset($styles[".$class"])) {
                                $inlineStyles .= $styles[".$class"] . ' ';
                            }

                            // Apply combined selectors (e.g., p.c9 { ... })
                            if (isset($styles["$tagName.$class"])) {
                                $inlineStyles .= $styles["$tagName.$class"] . ' ';
                            }
                        }
                    }

                    // Merge with existing inline styles, ensuring specificity
                    $existingStyle = $element->getAttribute('style');
                    if ($existingStyle) {
                        $existingStyle = preg_replace('/;\s*$/', '', $existingStyle); // Remove trailing semicolon
                        $inlineStyles = trim($existingStyle . ' ' . $inlineStyles);
                    }

                    // Prevent applying existing styles again
                    if (!empty($inlineStyles)) {
                        // Convert existing styles to an associative array for easy checking               
                        $existingStylesArray = [];
                        foreach (explode(';', $existingStyle) as $styleRule) {
                            if (trim($styleRule) != '') {
                                list($property) = explode(':', $styleRule);
                                $existingStylesArray[trim($property)] = true; // Store property existence
                            }
                        }
                        // Filter out already existing styles
                        $newInlineStyles = [];
                        foreach (explode(';', $inlineStyles) as $newStyleRule) {
                            if (trim($newStyleRule) != '') {
                                list($property) = explode(':', $newStyleRule);
                                if (!isset($existingStylesArray[trim($property)])) {
                                    $newInlineStyles[] = $newStyleRule; // Add only non-existing styles
                                }
                            }
                        }
                        // Set the computed styles back to the element if there are new styles
                        if (!empty($newInlineStyles)) {
                            $element->setAttribute('style', implode('; ', $newInlineStyles));
                        }

                        if ($element->hasAttribute('class')) {
                            $element->removeAttribute('class');
                        }
                    }
                }
                // Remove style and class attributes from all <blockquote> elements
                $blockquoteElements = $dom->getElementsByTagName('blockquote');
                foreach ($blockquoteElements as $blockquote) {
                    if ($blockquote->hasAttribute('class')) {
                        $blockquote->removeAttribute('class');
                    }
                    if ($blockquote->hasAttribute('style')) {
                        $blockquote->removeAttribute('style');
                    }
                }
            } catch (\Exception $e) {
                error_log("Error applying inline styles: " . $e->getMessage());
            }

            try {
                // Remove display:none elements
                $nodesToRemove = $xpath->query('//*[@style]');
                foreach ($nodesToRemove as $node) {
                    $style = $node->getAttribute('style');
                    if (preg_match('/display\s*:\s*none\s*;?/i', $style)) {
                        $node->parentNode->removeChild($node);
                    }
                }
            } catch (\Exception $e) {
                error_log("Error removing display:none elements: " . $e->getMessage());
            }

            try {
                // Remove empty tags
                $removeEmptyTags = function ($node) use (&$removeEmptyTags) {
                    foreach ($node->childNodes as $child) {
                        if ($child instanceof \DOMElement) {
                            $removeEmptyTags($child);
                        }
                    }

                    $textContent = preg_replace('/(\xc2\xa0|\s|&nbsp;|\n|\r)/u', '', $node->textContent);
                    if ($node instanceof \DOMElement && ($textContent === '' || ($node->childNodes->length == 1 && $node->childNodes->item(0) instanceof \DOMElement && $node->childNodes->item(0)->tagName === 'br'))) {
                        $node->parentNode->removeChild($node);
                    }
                };
                $removeEmptyTags($dom->documentElement);
            } catch (\Exception $e) {
                error_log("Error removing empty tags: " . $e->getMessage());
            }

            try {
                $body = $dom->getElementsByTagName('body')->item(0);
                $content = $body ? $dom->saveHTML($body) : $dom->saveHTML($dom->documentElement);
                $output = html_entity_decode($content, ENT_HTML5, 'UTF-8');
            } catch (\Exception $e) {
                error_log("Error extracting content: " . $e->getMessage());
                $output = $html; // Return the original HTML if processing fails
            }

            libxml_clear_errors();
            return $output;
        } catch (\Exception $e) {
            error_log("Unexpected error in convertClassesToInlineStyles: " . $e->getMessage());
            return $html; // Return the original HTML as a fallback
        }
    }

    public static function replaceBodyTagWithDiv($content)
    {
        try {
            // Check if the content has a <body> tag
            if (strpos($content, '<body') !== false) {
                // Replace opening <body> tag with <div>, accounting for spaces or newlines
                $content = preg_replace('/<body(\s[^>]*)?>/i', '<div$1>', $content);

                // Replace closing </body> tag with </div>
                $content = preg_replace('/<\/body>/i', '</div>', $content);
            }
            return $content;
        } catch (\Exception $e) {
            error_log("Error replacing <body> tag: " . $e->getMessage());
            // Return the original content in case of an error
            return $content;
        }
    }

    public static function removeImageTagFromBody($html)
    {
        try {

            // Use DOMDocument to process the HTML
            $dom = new \DOMDocument();

            // Prevent automatic errors from being shown
            libxml_use_internal_errors(true);

            try {
                // Load the HTML, ensuring the body tag is not omitted
                $html = '<?xml encoding="UTF-8">' . $html;
                $dom->loadHTML($html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            } catch (\Exception $e) {
                error_log("Error loading HTML into DOMDocument: " . $e->getMessage());
                return $html; // Return the original HTML if loading fails
            }

            try {
                // Remove the image tags
                $images = $dom->getElementsByTagName('img');
                $imagesToRemove = [];

                foreach ($images as $img) {
                    $imagesToRemove[] = $img;
                }

                foreach ($imagesToRemove as $img) {
                    if ($img->parentNode) {
                        $img->parentNode->removeChild($img);
                    }
                }
            } catch (\Exception $e) {
                error_log("Error removing image tags: " . $e->getMessage());
            }

            try {
                // Finalize the HTML output
                $html = str_replace('<?xml encoding="UTF-8">', '', $dom->saveHTML());
                return $html;
            } catch (\Exception $e) {
                error_log("Error finalizing HTML: " . $e->getMessage());
                return $html; // Return the original HTML if final processing fails
            }
        } catch (\Exception $e) {
            error_log("Unexpected error in removeImageTagFromBody: " . $e->getMessage());
            return $html; // Gracefully return the original HTML if an unexpected error occurs
        }
    }

    public static function getBodyOnlyAndReplaceBodyTagWithDiv($content)
    {
        // Use Tidy to clean up and standardize the HTML
        $config = [
            'clean' => true,
            'output-html' => true,
            'show-body-only' => true,
            'wrap' => 0,
            'newline' => 'LF',
            'drop-empty-elements' => true,
            'drop-empty-paras' => true,
            'force-output' => true,
            'char-encoding' => 'utf8',
        ];

        $tidy = new \tidy();
        $html = $tidy->repairString($content, $config, 'UTF8');
        // Check if the content has a <body> tag
        if (strpos($html, '<body') !== false) {
            // Replace opening <body> tag with <div> and account for spaces or newlines
            $html = preg_replace('/<body(\s[^>]*)?>/i', '<div$1>', $html);

            // Replace closing </body> tag with </div>
            $html = preg_replace('/<\/body>/i', '</div>', $html);
        }

        return $html;
    }

    public static function removeExtraSpacesFromHtml($html)
    {
        //        //Now use DOMDocument to process the cleaned HTML
        //        $dom = new \DOMDocument();
        //
        //        // Prevent automatic errors from being shown
        //        libxml_use_internal_errors(true);
        //
        //        // Load the HTML, ensuring body tag is not omitted
        //        $html = '<?xml encoding="UTF-8">' . $html;
        //        $dom->loadHTML($html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        //
        //        // Remove empty elements or elements that only contain <br> tags
        //        $elements = $dom->getElementsByTagName('*');
        //
        //        // Remove empty elements or elements that only contain <br> tags
        //        $elementsToRemove = [];
        //        foreach ($elements as $element) {
        //            // Check if the element contains only whitespace or <br> tags
        //            if (trim($element->textContent) === '') {
        //                $hasOnlyBr = true;
        //
        //                foreach ($element->childNodes as $child) {
        //                    // If any child is not a <br> or not a text node with whitespace, keep the element
        //                    if ($child->nodeName !== 'br' && !($child->nodeType === XML_TEXT_NODE && trim($child->textContent) === '')) {
        //                        $hasOnlyBr = false;
        //                        break;
        //                    }
        //                }
        //
        //                // If the element has only <br> tags or is empty, mark it for removal
        //                if ($hasOnlyBr) {
        //                    $elementsToRemove[] = $element;
        //                }
        //            }
        //        }
        //
        //        // Remove identified elements from the DOM
        //        foreach ($elementsToRemove as $element) {
        //            $element->parentNode->removeChild($element);
        //        }
        //
        //
        //        $html = str_replace('<?xml encoding="UTF-8">', '', $dom->saveHTML($dom->documentElement));
        //        // Clean up libxml errors
        //        libxml_clear_errors();
        //
        //        info($html);
        try {
            if (empty($html)) {
                return $html;
            }

            try {
                // Replace <div><br></div> structures with a single <br>
                $html = preg_replace('/<div>\s*<br\b[^>]*>\s*<\/div>/i', '<br>', $html);
            } catch (\Exception $e) {
                error_log("Error replacing <div><br></div>: " . $e->getMessage());
            }

            try {
                // Handle <div> with attributes containing <br>
                $html = preg_replace('/<div\b[^>]*>\s*<br\b[^>]*>\s*<\/div>/i', '<br>', $html);
            } catch (\Exception $e) {
                error_log("Error handling <div> with attributes: " . $e->getMessage());
            }

            try {
                // Regular expression to match 2 or more consecutive <br> tags with optional attributes
                $pattern = '/(<br\b[^>]*>\s*){2,}/i';

                // Replace multiple <br> tags with a single <br>
                $html = preg_replace($pattern, '<br>', $html);
            } catch (\Exception $e) {
                error_log("Error replacing multiple <br> tags: " . $e->getMessage());
            }

            try {
                // Decode HTML entities and finalize the cleaned HTML
                $output = html_entity_decode($html, ENT_HTML5, 'UTF-8');
                return $output;
            } catch (\Exception $e) {
                error_log("Error decoding HTML entities: " . $e->getMessage());
                return $html; // Return the partially cleaned HTML if decoding fails
            }
        } catch (\Exception $e) {
            error_log("Unexpected error in removeExtraSpacesFromHtml: " . $e->getMessage());
            return $html; // Gracefully return the original HTML if an unexpected error occurs
        }
    }

    public static function highlightKeywordsInHtml($html, $keywords, $charset = 'UTF-8')
    {
        try {
            // Return original HTML if it's empty or if there are no keywords to highlight
            if (empty($html) || empty($keywords)) {
                return $html;
            }

            // Ensure encoding is UTF-8
            $html = mb_convert_encoding($html, 'UTF-8', $charset);

            // Load the HTML into a DOMDocument
            $dom = new \DOMDocument();
            libxml_use_internal_errors(true); // Handle parsing errors gracefully
            @$dom->loadHTML('<?xml encoding="UTF-8">' . $html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

            // Create an XPath object
            $xpath = new \DOMXPath($dom);

            // Find all text nodes within the document
            $textNodes = $xpath->query('//text()');

            // Iterate through each text node
            foreach ($textNodes as $textNode) {
                $textContent = $textNode->nodeValue;

                // Highlight keywords within the text node
                $highlightedText = self::highlightKeywords($textContent, $keywords);

                // If the highlighted text is different, replace the text node with HTML
                if ($highlightedText !== $textContent) {
                    // Create a new document fragment to hold the highlighted HTML
                    $fragment = $dom->createDocumentFragment();
                    $fragment->appendXML($highlightedText);

                    // Replace the text node with the fragment
                    $textNode->parentNode->replaceChild($fragment, $textNode);
                }
            }

            // Save the modified HTML and return it
            $html = str_replace('<?xml encoding="UTF-8">', '', $dom->saveHTML());
            return html_entity_decode($html, ENT_HTML5, 'UTF-8');
        } catch (\Exception $e) {
            // Log the error
            error_log("Error in highlightKeywordsInHtml: " . $e->getMessage());
            // Return the original HTML in case of an error
            return $html;
        }
    }

    /**
     * Highlight specified keywords within the given text by wrapping them in a styled <span> element.
     *
     * @param string $text The input text in which the keywords will be highlighted.
     * @param array $keywords An array of keywords to be highlighted.
     * @return string The text with highlighted keywords, or the original text if no keywords are found.
     */
    public static function highlightKeywords($text, $keywords)
    {
        // Return original text if it's empty or if there are no keywords to highlight
        if (empty($text) || empty($keywords)) {
            return $text;
        }

        // Escape special characters in keywords to ensure they are safely used in the regex
        $escapedKeywords = array_map('preg_quote', $keywords);

        // Sort the keywords by length in descending order to handle longer phrases first
        usort($escapedKeywords, function ($a, $b) {
            return mb_strlen($b) - mb_strlen($a);
        });

        // Build a regular expression pattern to match any of the keywords (case-insensitive)
        $pattern = '/(' . implode('|', $escapedKeywords) . ')/i';

        // Replace matched keywords with the highlighted version using a callback function
        $highlightedText = preg_replace_callback($pattern, function ($matches) {
            // Wrap each matched keyword in a styled <span> for highlighting
            return '<span style="background: #a8a821; color: #ffffff; padding: 3px; font-weight: bold; border-radius: 2px;">' .
                htmlspecialchars($matches[0], ENT_QUOTES, 'UTF-8') .
                '</span>';
        }, $text);

        // Return the text with highlighted keywords
        return $highlightedText;
    }

    /**
     * Function to extract and process email content, flattening nested replies.
     * It also removes any text outside the HTML structure.
     *
     * @param string $html The raw HTML content of the email.
     * @return array | string The processed HTML content with flattened replies.
     */
    public static function processEmailContent($html, $charset = 'UTF-8')
    {
        try {
            if (empty($html)) {
                return $html;
            }

            // Ensure encoding is UTF-8
            $html = mb_convert_encoding($html, 'UTF-8', $charset);

            // Load the cleaned HTML content into a DOMDocument
            $dom = new \DOMDocument();
            libxml_use_internal_errors(true); // Handle parsing errors gracefully
            // Use UTF-8 encoding to handle special characters
            @$dom->loadHTML('<?xml encoding="UTF-8">' . $html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

            // XPath to find all blockquote elements
            $xpath = new \DOMXPath($dom);

            // Get the blockquote and remove it
            $blockquoteNodes = $dom->getElementsByTagName('blockquote');
            $toRemoveNode = [];

            for ($i = $blockquoteNodes->length - 1; $i >= 0; $i--) {
                $blockquote = $blockquoteNodes->item($i);
                $toRemoveNode[] = $blockquote->parentNode;
            }

            foreach ($toRemoveNode as $node) {
                $parent = $node->parentNode;
                if ($parent) {
                    $parent->removeChild($node);
                }
            }

            // Remove elements with the class "gmail_extra"
            $gmail_extras = $xpath->query("//div[contains(@class, 'gmail_extra')]");
            $nodesToRemove = [];
            foreach ($gmail_extras as $node) {
                $nodesToRemove[] = $node;
            }
            foreach ($nodesToRemove as $node) {
                if ($node->parentNode) {
                    $node->parentNode->removeChild($node);
                }
            }

            // Get the first blockquote element and remove it
            //        $blockquote = $dom->getElementsByTagName('blockquote')->item(0);
            //
            //        if ($blockquote) {
            //            // Get the parent of the blockquote
            //            $parent = $blockquote->parentNode;
            //
            //            if ($parent && $parent->parentNode) {
            //                // Remove the parent node, effectively removing the blockquote and its parent
            //                $parent->parentNode->removeChild($parent);
            //            } else {
            //                // If parent doesn't have a parentNode (i.e., it's the root), just remove the blockquote
            //                $blockquote->parentNode->removeChild($blockquote);
            //            }
            //        }

            // Remove elements with specific IDs from outlook
            //        $idNodes = $xpath->query("//*[@id='ms-outlook-mobile-signature' or @id='mail-editor-reference-message-container']");
            //        foreach ($idNodes as $node) {
            //            $node->parentNode->removeChild($node);
            //        }


            //        $blockquoteNodes = $xpath->query("//div[contains(@class, 'gmail_quote')]");
            //
            //        // If there are no blockquotes, return the original content
            //        if ($blockquoteNodes->length === 0) {
            //            return $html;  // No reply found, return the original HTML
            //        }
            //
            //        // Traverse the blockquote elements in reverse order
            //        for ($i = $blockquoteNodes->length - 1; $i >= 0; $i--) {
            //            $blockquote = $blockquoteNodes->item($i);
            //            //$blockquoteHTML = self::getInnerHTML($dom, $blockquote);
            //            //$processedReply = self::processGmailReply($blockquoteHTML);
            //            //$flattenedContent[] = $processedReply;
            //
            //            // Remove the blockquote from the DOM to avoid duplicating content
            //            $blockquote->parentNode->removeChild($blockquote);
            //        }
            $html = str_replace('<?xml encoding="UTF-8">', '', $dom->saveHTML());
            return html_entity_decode($html, ENT_HTML5, 'UTF-8');
        } catch (\Exception $e) {
            error_log("Unexpected error in processEmailContent: " . $e->getMessage());
            return $html; // Gracefully return the original HTML if an unexpected error occurs
        }
    }

    public static function removeGmailSignature($html)
    {
        try {
            if (empty($html)) {
                return $html;
            }

            // Load the HTML content into a DOMDocument
            $dom = new \DOMDocument();

            // Use UTF-8 encoding to handle special characters
            try {
                @$dom->loadHTML('<?xml encoding="UTF-8">' . $html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            } catch (\Exception $e) {
                error_log("Failed to load HTML: " . $e->getMessage());
                return $html; // Return original HTML if DOM loading fails
            }

            // XPath to find all signature elements
            $xpath = new \DOMXPath($dom);

            $signatureDividers = $xpath->query("//p[contains(text(), '--')] | //span[contains(text(), '--')] | //text()[contains(., '--')]");
            $elementsToRemove = [];
            $signatures = [];

            foreach ($signatureDividers as $textNode) {
                try {
                    $trimmedValue = trim($textNode->nodeValue);
                    $shouldRemove = false;
                    $holderForElement = [];


                    // Only proceed if we find exactly '--'
                    if ($trimmedValue === '--') {
                        //                info(" --  found");
                        // Get the parent element to potentially remove it
                        $parentElement = $textNode->parentNode;
                        //                info("parent node is: $parentElement->nodeName");

                        // Add the text node to remove
                        $holderForElement[] = $textNode;

                        // Check for previous sibling (to remove any <br> before '--')
                        $previousSibling = $textNode->previousSibling;
                        if ($previousSibling && $previousSibling->nodeName === 'br') {
                            // Add the previous <br> tag to be removed
                            $holderForElement[] = $previousSibling;
                        }

                        // Check for next sibling
                        $nextSibling = $textNode->nextSibling;

                        if ($nextSibling && $nextSibling->nodeName === 'br') {
                            $holderForElement[] = $nextSibling;

                            // Move to the next sibling after <br>
                            $nextSibling = $nextSibling->nextSibling;
                        }

                        // Skip empty text nodes and move to the next non-empty node
                        while ($nextSibling && $nextSibling->nodeName !== 'div') {
                            $nextSibling = $nextSibling->nextSibling;
                        }

                        // Check if the next sibling is a <div> and add it for removal
                        if ($nextSibling && $nextSibling->nodeName === 'div') {
                            //                    info("div found near nextSibling");
                            $shouldRemove = true;
                            $holderForElement[] = $nextSibling;
                            $signatures[] = self::getInnerHTML($dom, $nextSibling);
                            //$signatures[] = $nextSibling;
                        }

                        // Check if the next sibling is a text node or a <div>
                        //                if ($nextSibling) {
                        //                    if ($nextSibling->nodeType === XML_TEXT_NODE) {
                        //                        // If it's a text node, move to the next sibling
                        //                        $nextSibling = $nextSibling->nextSibling;
                        //                    }
                        //
                        //                    // Now check if the next sibling is a <div>
                        //                    if ($nextSibling && $nextSibling->nodeName === 'div') {
                        //                        $shouldRemove = true;
                        //                        $holderForElement[] = $nextSibling;
                        //                    }else{
                        //                        $nextSibling = false;
                        //                    }
                        //                }
                        $signatureFound = false;
                        $originalParent = $parentElement;

                        if (!$nextSibling) {

                            while ($parentElement && $parentElement->nextSibling && $parentElement->nextSibling->nodeName !== 'div') {
                                $parentElement = $parentElement->nextSibling;
                            }

                            if ($parentElement && $parentElement->nextSibling && $parentElement->nextSibling->nodeName === 'div') {
                                //                        info("with parent div found");
                                $signatureFound = true;
                            } else {

                                $parentElement = $originalParent->parentNode;

                                if ($originalParent->nodeName == 'p' && $parentElement->nodeName == 'div' && $textNode->nodeName == 'span') {
                                    $signatureFound = true;
                                }
                            }
                        }

                        if ($signatureFound) {
                            $shouldRemove = true;
                            $holderForElement[] = $parentElement->nextSibling;
                            $signatures[] = self::getInnerHTML($dom, $parentElement->nextSibling);
                            //                    $signatures[] = $parentElement->nextSibling;

                            // Check for previous sibling (to remove any <br> before '--')
                            $previousSibling = $parentElement->previousSibling;
                            if ($previousSibling && $previousSibling->nodeName === 'br') {
                                // Add the previous <br> tag to be removed
                                $holderForElement[] = $previousSibling;
                            }
                        }

                        // If no next sibling, check if the parent element's next sibling is a <div>
                        //                if (!$nextSibling && $parentElement && $parentElement->nextSibling && $parentElement->nextSibling->nodeName === 'div') {
                        //                    $shouldRemove = true;
                        //                    $holderForElement[] = $parentElement->nextSibling;
                        //
                        //                    // Check for previous sibling (to remove any <br> before '--')
                        //                    $previousSibling = $parentElement->previousSibling;
                        //                    if ($previousSibling && $previousSibling->nodeName === 'br') {
                        //                        // Add the previous <br> tag to be removed
                        //                        $holderForElement[] = $previousSibling;
                        //                    }
                        //                }
                        if ($shouldRemove) {
                            $elementsToRemove = array_merge($elementsToRemove, $holderForElement);
                        } else {
                            //info("no signature found");
                        }
                    }
                } catch (\Exception $e) {
                    error_log("Error processing signature divider: " . $e->getMessage());
                    continue; // Skip problematic nodes and proceed
                }
            }

            foreach ($elementsToRemove as $removeElement) {
                try {
                    if ($removeElement->parentNode) {
                        $removeElement->parentNode->removeChild($removeElement);
                    }
                } catch (\Exception $e) {
                    error_log("Error removing element: " . $e->getMessage());
                    continue;
                }
            }

            try {
                // Find all elements with the class "gmail_signature_prefix" or data-smartmail="gmail_signature"
                $signaturePrefix = $xpath->query('//*[@class="gmail_signature_prefix" or @data-smartmail="gmail_signature"]');

                // Loop through the matched elements and remove them
                foreach ($signaturePrefix as $element) {
                    $signatures[] = self::getInnerHTML($dom, $element);
                    //            $signatures[] = $element;
                    $element->parentNode->removeChild($element);
                }

                // Find all elements with the class "gmail_signature"
                $gmailSignature = $xpath->query('//*[@class="gmail_signature"]');

                // Loop through the matched elements and remove them
                foreach ($gmailSignature as $element) {
                    $signatures[] = self::getInnerHTML($dom, $element);
                    //            $signatures[] = $element;
                    $element->parentNode->removeChild($element);
                }

                // Remove elements with specific IDs from outlook
                $idNodes = $xpath->query("//*[@id='ms-outlook-mobile-signature' or @id='mail-editor-reference-message-container']");
                foreach ($idNodes as $node) {
                    $signatures[] = self::getInnerHTML($dom, $node);
                    $node->parentNode->removeChild($node);
                }

                //        $divs = $xpath->query("//div");
                //
                //        foreach ($divs as $div){
                //            foreach ($signatures as $sign){
                //                if ( $div->item(0)->isEqualNode($sign->item(0))) {
                //                    $div->parentNode->removeChild($div);
                //                }
                //                $sign->parentNode->removeChild($sign);
                //            }
                //        }
            } catch (\Exception $e) {
                error_log("Error handling specific signatures: " . $e->getMessage());
            }

            $html = str_replace('<?xml encoding="UTF-8">', '', $dom->saveHTML());

            // Remove only the excess whitespace between HTML tags, not inside the text nodes
            //$normalizedHtml = preg_replace('/>\s+</', '><', $html);

            //        foreach ($signatures as $sign){
            //
            //            $normalizedHtml = str_ireplace($sign,'',$normalizedHtml);
            //
            //        }
            //
            //        foreach ($signatures as $sign){
            //            $signatureText = trim(strip_tags($sign)); // Strip tags to compare the raw text
            //            if (!empty($signatureText)) {
            //                $normalizedHtml = str_ireplace($signatureText, '', $normalizedHtml);
            //            }
            //        }

            // Re-load the modified HTML back into DOMDocument for further processing
            //$dom->loadHTML($normalizedHtml, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

            // Return the final processed HTML
            //$finalHtml = str_replace('<?xml encoding="UTF-8">', '', $dom->saveHTML());
            //info("After signature remove");
            //info($html);
            return html_entity_decode($html, ENT_HTML5, 'UTF-8');
        } catch (\Exception $e) {
            error_log("Unexpected error in removeGmailSignature: " . $e->getMessage());
            return $html; // Return the original HTML if an unexpected error occurs
        }
    }

    public static function renderPdfBody(array $message, int $count, string $language)
    {
        // Implement your logic to render HTML for each message
        $data["eData"] = $message;
        $data["count"] = $count;
        $data["language"] = $language;
        $date = Carbon::createFromFormat('d/m/Y H:i:s', $message['date']);
        $data["date"] = $date->format('d/m/Y');
        $data["time"] = $date->format('H:i:s');
        $data['isAttachmentSelected'] = $message['isAttachmentSelected'];
        $message_type = "";

        if (isset($message['body_type'])) {
            $message_type = $message['body_type'];
        }

        // Render the HTML for each message and store it in the $htmlData array
        if ($message_type == 'html' && is_array($message['body'])) {
            return View::make('wkhtmltopdf.pdf-single-message-array')->with($data)->render();
        } elseif ($message_type == 'text') {
            return View::make('wkhtmltopdf.pdf-single-message-text')->with($data)->render();
        } else {
            return View::make('wkhtmltopdf.pdf-single-message')->with($data)->render();
        }
    }

    public static function gmailMessagesToArray($messages, $accessToken, $orderId = null)
    {
        $messageConversationBody = [];
        $countData = count($messages);
        $num = 0;
        foreach ($messages as $key => $message) {
            $messages[$key] = $message['id'];

            $singleMessage = (new OrderMessageService())->fetchSingleMessage($message["id"], $accessToken);
            if (!empty($singleMessage)) {

                $parseMessage = self::parseGmailMessage($singleMessage);

                $messageConversationBody[] = $parseMessage;
                $num++;

                if ($orderId) {
                    $progress = 25 + floor(($num / $countData) * 25);
                    // Update progress in Redis
                    $redisKey = "job_progress_{$orderId}";
                    Redis::set($redisKey, json_encode(['status' => 'processing', 'progress' => $progress]));
                }
            }
        }
        return $messageConversationBody;
    }

    public static function parseGmailMessage($messageDetails)
    {
        $parsedMessage = [];

        $headers = isset($messageDetails['payload'], $messageDetails['payload']['headers']) ? $messageDetails['payload']['headers'] : [];

        if (empty($headers)) {
            return $parsedMessage;
        }

        $parsedMessage = [
            'subject' => '',
            'from' => [],
            'to' => [],
            'cc' => [],
            'bcc' => [],
            'date' => '',
            'body' => '',
        ];

        foreach ($headers as $header) {
            if ($header['name'] == 'Subject') {
                $parsedMessage['subject'] = self::cleanGmailSubject($header['value']);
            } elseif ($header['name'] == 'From') {
                // Handle multiple addresses in the 'From' field
                $parsedMessage['from'] = array_map('trim', explode(',', $header['value']));
            } elseif ($header['name'] == 'To') {
                // Handle multiple addresses in the 'To' field
                $parsedMessage['to'] = array_map('trim', explode(',', $header['value']));
            } elseif ($header['name'] == 'Cc') {
                // Handle multiple addresses in the 'Cc' field
                $parsedMessage['cc'] = array_map('trim', explode(',', $header['value']));
            } elseif ($header['name'] == 'Bcc') {
                // Handle multiple addresses in the 'Bcc' field
                $parsedMessage['bcc'] = array_map('trim', explode(',', $header['value']));
            }
            //            elseif ($header['name'] == 'Date') {
            //                // Step 1: Remove the timezone in parentheses (e.g., "(UTC)")
            //                $timeString = preg_replace('/\([^)]+\)/', '', $header['value']);
            //
            //                // Step 2: Create Carbon date from format like 'Fri, 13 Sep 2024 16:54:00 +0000'
            //                $date = Carbon::createFromFormat('D, d M Y H:i:s O', trim($timeString));
            //
            //                // Step 3: Format it to your desired 'd/m/Y H:i'
            //                $formattedDate = $date->format('d/m/Y H:i');
            //
            //                // Store the formatted date in the parsed message
            //                $parsedMessage['date'] = $formattedDate;
            //            }
        }

        // Get body
        $body = getGmailMessageBody($messageDetails['payload']);

        if (isset($body['html'])) {
            $body['html'] = mb_convert_encoding($body['html'], 'UTF-8', 'auto');
        }
        if (isset($body['text'])) {
            $body['text'] = mb_convert_encoding($body['text'], 'UTF-8', 'auto');
        }

        $parsedMessage['date_in_ms'] = $messageDetails['internalDate'];
        $parsedMessage['body'] = $body;

        // if subject is empty don't include
        // if (empty($parsedMessage['subject'])) {
        //     return [];
        // }

        // $text = trim($parsedMessage['body']['text']);
        // if (empty($text)) {
        //     return [];
        // }
        //         //if only documents present not body then return empty
        //        if (empty($text) && !empty($parsedMessage['body']['document'])){
        //            return [];
        //        }
        //
        //        // if body is empty then also return empty
        //        if (empty(trim($text)) && empty($parsedMessage['body']['document'])){
        //            return [];
        //        }

        if (empty($parsedMessage['subject']) && empty(trim($parsedMessage['body']['text'])) && empty($parsedMessage['body']['document'])) {
            return [];
        }

        return $parsedMessage;
    }

    public static function cleanGmailSubject($subject)
    {
        // Remove all occurrences of "Re:", "Fw:", or "Fwd:" prefixes (case-insensitive)
        $subject = preg_replace('/\s*(Re:|Fw:|Fwd:)\s*/i', '', $subject);

        // Trim leading and trailing whitespace
        $subject = trim($subject);

        // Replace multiple spaces with a single space
        $subject = preg_replace('/\s+/', ' ', $subject);

        return $subject;
    }

    /**
     * Function to extract and process email content.
     * It removes any text besides the original message.
     *
     * @param string $html The raw HTML content of the email.
     * @return string The original message.
     */
    public static function getRealMessage($emailBody)
    {

        // Step 1: Normalize line endings to simplify processing
        $emailBody = str_replace(["\r\n", "\r"], "\n", $emailBody);

        // Step 2: Remove quoted sections that are part of a reply
        // This targets blocks of lines starting with '>' or other common quote indicators
        $emailBody = preg_replace('/\n(?:>|\s*\bOn\b.*\d{4}.*\b wrote:)\s?.*/s', '', $emailBody);

        // Step 3: Remove lines after "-----Original Message-----" or similar lines
        $emailBody = preg_replace('/\n-{5,}.*?(\nFrom:|\nSent:|\nTo:|\nCc:|\nSubject:).*/s', '', $emailBody);

        // Step 4: Remove lines that start with common signature indicators like "--"
        $emailBody = preg_replace('/\n--\s?.*/s', '', $emailBody);

        // Step 5: Remove any remaining quoted text after "On [Date], [Person] wrote:" or similar
        $emailBody = preg_replace('/\nOn\s.*\d{4}.*\n?.*\n?.*wrote:.*/s', '', $emailBody);

        // Step 6: Trim any remaining whitespace from the message
        $emailBody = trim($emailBody);

        return $emailBody;
    }

    /**
     * Function to get the inner HTML of a DOMNode.
     *
     * @param DOMDocument $dom The DOMDocument object.
     * @param DOMNode $element The DOMNode to get the inner HTML from.
     * @return string The inner HTML of the node.
     */
    public static function getInnerHTML($dom, $element)
    {
        if ($element == null) {
            return $element;
        }

        $innerHTML = '';
        $children = $element->childNodes;

        foreach ($children as $child) {
            $innerHTML .= $dom->saveHTML($child);
        }

        return $innerHTML;
    }


    /**
     * Function to remove any text outside of HTML tags.
     *
     * @param string $html The raw HTML content.
     * @return string The cleaned HTML content.
     */
    public static function stripTextOutsideHtml($html)
    {
        // Step 1: Remove all HTML tags except for a few allowed ones
        $allowedTags = '<p><a><div><span><b><i><u><br><img><table><tr><td><th><thead><tbody><tfoot><h1><h2><h3><h4><h5><h6><ul><ol><li><blockquote><pre><strong><em><sub><sup><font><hr><code>';
        $cleanedHtml = strip_tags($html, $allowedTags);

        // Step 2: Normalize line endings to simplify processing
        $cleanedHtml = str_replace(["\r\n", "\r"], "\n", $cleanedHtml);

        // Step 3: Remove quoted sections that are part of a reply
        // Adjusted regex to be less aggressive and handle multiple lines
        $cleanedHtml = preg_replace('/\n(?:>+|\s*\bOn\b.*\d{4}.*\b wrote:)\s?.*/i', '', $cleanedHtml);

        // Use regular expressions to remove text outside of HTML tags
        // Match everything that is not within <...> and remove it
        $cleanedHtml = preg_replace('/^[^<]*|[^>]*$/', '', $cleanedHtml);

        return $cleanedHtml;
    }

    /**
     * ---------------------------------------------------
     * Outlook Section: Function has outlook related code
     * ---------------------------------------------------
     **/

    /**
     * Parse an Outlook message into a specific format.
     *
     * @param array $messageDetails - The detailed message data from the Outlook API response.
     * @return array - The parsed message array containing subject, from, to, cc, bcc, date, and body.
     */
    public static function parseOutlookMessage($messageDetails)
    {
        $tokenCache = new TokenCache();
        $accessToken = $tokenCache->getAccessToken();

        $parsedMessage = [
            'subject' => '',
            'from' => [],
            'to' => [],
            'cc' => [],
            'bcc' => [],
            'date' => '',
            'body' => '',
        ];

        // Extract the subject
        $parsedMessage['subject'] = isset($messageDetails['subject']) ? self::cleanGmailSubject($messageDetails['subject']) : '';

        // Extract the sender's email address
        if (isset($messageDetails['from']['emailAddress'])) {
            $parsedMessage['from'] = $messageDetails['from']['emailAddress']['name'] . ' <' . $messageDetails['from']['emailAddress']['address'] . '>';
        }

        // Extract the recipient(s) email address
        if (isset($messageDetails['toRecipients']) && is_array($messageDetails['toRecipients'])) {
            $toRecipients = [];
            foreach ($messageDetails['toRecipients'] as $recipient) {
                $toRecipients[] = $recipient['emailAddress']['name'] . ' <' . $recipient['emailAddress']['address'] . '>';
            }
            $parsedMessage['to'] = implode(', ', $toRecipients);
        }

        // Extract the Cc recipients
        if (isset($messageDetails['ccRecipients']) && is_array($messageDetails['ccRecipients'])) {
            $ccRecipients = [];
            foreach ($messageDetails['ccRecipients'] as $cc) {
                $ccRecipients[] = $cc['emailAddress']['name'] . ' <' . $cc['emailAddress']['address'] . '>';
            }
            $parsedMessage['cc'] = implode(', ', $ccRecipients);
        }

        // Extract the Bcc recipients
        if (isset($messageDetails['bccRecipients']) && is_array($messageDetails['bccRecipients'])) {
            $bccRecipients = [];
            foreach ($messageDetails['bccRecipients'] as $bcc) {
                $bccRecipients[] = $bcc['emailAddress']['name'] . ' <' . $bcc['emailAddress']['address'] . '>';
            }
            $parsedMessage['bcc'] = implode(', ', $bccRecipients);
        }

        // Extract and format the received date
        if (isset($messageDetails['receivedDateTime'])) {
            $date = Carbon::parse($messageDetails['receivedDateTime']);
            $parsedMessage['date_in_ms'] = (string) $date->getPreciseTimestamp(3); // get datetime in milliseconds
        }

        // Extract the body content with its attachments
        if (isset($messageDetails['body']['content'])) {

            $body = $messageDetails['body']['content'];
            // Remove image tag from html
            $body = self::removeImageTagFromBody($body);

            // Remove extra spaces like br
            $body = self::removeExtraSpacesFromHtml($body);

            // Remove the signature
            $body = self::removeGmailSignature($body);

            // style tag to inline css
            $body = self::convertClassesToInlineStyles($body);

            // Replace the body tag to div
            $body = self::replaceBodyTagWithDiv($body);

            $body = html_entity_decode($body, ENT_HTML5, 'UTF-8');

            $revampedBody = [
                'html' => $body,
                'text' => strip_tags($body),
                'document' => self::fetchOutlookAttachments($accessToken, $messageDetails['id'],  $messageDetails['from']['emailAddress']['name'])
            ];
            $parsedMessage['body'] = $revampedBody;
        }
        return $parsedMessage;
    }

    private static function fetchOutlookAttachments(string $accessToken, string $messageId, string $senderName): array
    {
        $graphUrl = "https://graph.microsoft.com/v1.0/me/messages/{$messageId}/attachments";
        $userResponse = Http::withHeaders([
            'Authorization' => 'Bearer ' . $accessToken,
        ])->get($graphUrl);

        $returnAttachmentList = [];
        if ($userResponse->successful()) {
            foreach ($userResponse->json()['value'] as $attachment) {
                if (isset($attachment['@odata.type']) && $attachment['@odata.type'] === '#microsoft.graph.fileAttachment') {
                    $returnAttachmentList[] = [
                        'mime_type' => $attachment['contentType'],
                        'file_name' => $attachment['name'],
                        'date' =>  Carbon::createFromFormat('Y-m-d\TH:i:s\Z', $attachment['lastModifiedDateTime'])->format('d/m/Y'),
                        'time' => Carbon::createFromFormat('Y-m-d\TH:i:s\Z', $attachment['lastModifiedDateTime'])->format('H:i'),
                        'attachment_id' => $attachment['contentId'],
                        'sender_name' => 'sent by ' . $senderName,
                    ];
                }
            }
        }
        return $returnAttachmentList;
    }

    public static function GenerateOutlookPDF(Order $order, array $messages)
    {
        // Set up variables for pdf generation
        $singleMessage = $messages[0];
        $timezone = $order->timezone ?? config('app.timezone');
        $dateAt = now()->format('d/m/Y');
        $timeAt = now()->format('H:i:s');
        $fromEmail = $order->from_email;
        $toEmail = $order->recipient_email;
        $logo = url('web/assets/img/resize-image/logo-192x192.png');
        $datePrefix = now()->format('d_m_Y_h_i_s_v');
        $username = substr($order->from_email, 0, strpos($order->from_email, "@"));
        $pdfFile = $username . '_' . $datePrefix . '_LegalPDF.pdf';
        $pdfPath = storage_path("app/public/{$pdfFile}");
        $request = json_decode($order->request, true);
        $language = $request['language'];
        $keywords = stringSplit($request["inc_keywords"]) ?? [];
        $platform = ($order->platform_type == 1) ? "Gmail" : "Outlook";
        $toUserName = "";
        $isFoundFromUserName = false;
        $isFoundToUserName = false;
        $fromUserName = "";

        $total_document_count = 0;
        $documentList = array();

        // Language PDF Direction 
        $direction =  "ltr"; // default direction 

        if (getSession('lang-direction')) {
            $direction = getSession('lang-direction');
        };

        /* 
        //"ltr"; // default direction
        $language = \App\Models\Language::where('code', $language)->first(); // Retrieve the language model
        if ($language && ($language->direction)) {
            $direction = $language->direction;
        }
        */

        $result = self::getOutlookUserName($fromEmail, [$singleMessage['from'],  $singleMessage['to']]);
        if ($result['status']) {
            $fromUserName = $result['name'];
            $isFoundFromUserName = true;
        }


        $result = self::getUserName($toEmail, $singleMessage['from'], $singleMessage["to"]);
        if ($result['status']) {
            $toUserName = $result['name'];
            $isFoundToUserName = true;
        }


        // Define the chunk size
        $chunkSize = 20; // Adjust this based on memory capacity

        // Initialize an array to store the HTML render data
        $htmlData = [];

        // Process the messages in chunks
        $chunks = array_chunk($messages, $chunkSize);

        $count = 1;
        $total = count($messages);
        foreach ($chunks as $index => $chunk) {
            foreach ($chunk as $message) {

                $result = self::getOutlookPdfReceiverName($message, $message['from'], $message['to']);
                $message['senderName'] = $result['senderName'];
                $message['receiverName'] = $result['receiverName'];
            
                try {
        
                    // Render the HTML for each message and store it in the $htmlData array 
                    if (isset($message['threads']) && count($message['threads']) > 0) {
                        $message['body_type'] = "html";
                        $data = [];

                        foreach ($message['threads'] as $thread) {

                            $resultThread = self::getOutlookUserName($fromEmail, [$thread['from'],  $thread['to']]);
                            if ($resultThread['status']) {
                                $fromUserName = $resultThread['name'];
                                $isFoundFromUserName = true;
                            }
                    
                            $resultThread = self::getUserName($toEmail, $thread['from'], $thread["to"]);
                            if ($resultThread['status']) {
                                $toUserName = $resultThread['name'];
                                $isFoundToUserName = true;
                            }

                            $body = '';
                            $attachments = [];

                            $attachments = $thread['body']['document'];
                            $htmlContent = $thread['body']['html'];
                            $message['attachments'] = $attachments;
                            $removeSignature = ($fromEmail == extractEmail($message['from']));
                            $body = self::processGmailHtmlContent($htmlContent, $removeSignature, $keywords, true);

                            $carbonDate = Carbon::createFromTimestampMs($message['date_in_ms'])->setTimezone($timezone);
                            $message['date'] = $carbonDate->format('d/m/Y H:i:s');
                            $date = $carbonDate->format('d/m/Y');
                            $time = $carbonDate->format('H:i:s');
                            $receiverNames = self::getOutlookPdfReceiverName($thread,$thread['from'],$thread['to']);
                            $data[] = [
                                'time' => $time,
                                'date' => $date,
                                'content' => $body,
                                'senderName' => $receiverNames['senderName'],
                                'receiverName' => $receiverNames['receiverName'],
                                'attachments' => $attachments,
                            ];
                        }
                        $message['body'] = $data;

                    } elseif (isset($message['body']['html'])) {
                        $attachments = $message['body']['document'];
                        $htmlContent = $message['body']['html'];
                        $message['attachments'] = $attachments;
                        $removeSignature = ($fromEmail == extractEmail($message['from']));
                        $body = self::processGmailHtmlContent($htmlContent, $removeSignature, $keywords, true);
                        $message['body'] = $body;
                    }
                } catch (\Exception $e) {
                    error_log("Error Rendering Message for Outlook: " . $e->getMessage());
                }
                
                $documentList = array_merge($documentList, $attachments);

                // get the total document count
                $total_document_count = count($documentList);
                $message['isAttachmentSelected'] = $order->search_attachments_list;

                // set timezone
                $carbonDate = Carbon::createFromTimestampMs($message['date_in_ms'] ?? microtime(true))->setTimezone($timezone);
                $message['date'] = $carbonDate->format('d/m/Y H:i:s');

            
                $htmlData[] = self::renderPdfBody($message, $count, $language);
                $progress = 50 + floor(($count / $total) * 45);

                // Update progress in Redis
                Redis::set("job_progress_{$order->id}", json_encode(['status' => 'processing', 'progress' => $progress]));
                $count++;
            }
        }

        $isAttachmentSelected = $order->search_attachments_list;
        $htmlData[] = View::make('wkhtmltopdf.pdf-document-list', compact('documentList', 'direction', 'language', 'isAttachmentSelected'))->render();


        // Remove unwanted string
        foreach ($htmlData as $htmlDataKey => $htmlDataValue) {
            if (gettype($htmlData[$htmlDataKey]) === "string") {
                $removeCharArray = ['�'];
                foreach ($removeCharArray as $removeCharValue) {
                    $htmlData[$htmlDataKey] = str_replace($removeCharValue, " ", $htmlData[$htmlDataKey]);
                }
            }
        }

        // direction working 
        $direction = "ltr";
        $language = \App\Models\Language::where('code', $language)->first(); // Retrieve the language model
        if ($language) {
            $direction = $language->direction;
        }


        // Combine all HTML parts into one
        $htmlContent = View::make('wkhtmltopdf.pdf-final-file', [
            'htmlData' => $htmlData,
            'logo' => $logo,
            'language' => $language,
            'dateAt' => $dateAt,
            'timeAt' => $timeAt,
            'fromEmail' => $fromEmail,
            'fromUserName' => $fromUserName,
            'toEmail' => $toEmail,
            'toUserName' => $toUserName,
            'countData' => $count - 1,
            'platform' => $platform,
            'allow_attachments' => $order->search_attachments_list,
            'direction' => $direction,
            'total_document_count' => $total_document_count,
        ])->render();

        // Save the HTML content to a temporary file
        $tempHtmlFile = storage_path("app/public/temp/{$username}_{$datePrefix}_body_temp.html");
        file_put_contents($tempHtmlFile, $htmlContent);

        // Get Header content from the view file
        $headerContent = View::make('wkhtmltopdf.pdf-header', [
            'language' => $language,
            'dateAt' => $dateAt,
            'timeAt' => $timeAt,
        ])->render();

        // Save the header content to a temporary file
        $tempHeaderFile = storage_path("app/public/temp/{$username}_{$datePrefix}_header_temp.html");
        file_put_contents($tempHeaderFile, $headerContent);

        // Get Footer content from the view file
        $footerContent = View::make('wkhtmltopdf.pdf-footer')->render();

        // Save the header content to a temporary file
        $tempFooterFile = storage_path("app/public/temp/{$username}_{$datePrefix}_footer_temp.html");
        file_put_contents($tempFooterFile, $footerContent);

        // Path to wkhtmltopdf binary
        $wkhtmltopdfPath = config('snappy.pdf.binary');

        // Define options for wkhtmltopdf
        $options = [
            "--zoom 1.0", // Adjust zoom level to control scaling
            "--viewport-size 1024x768", // Set a standard viewport size
            //"--header-spacing 10",
            "--margin-top 10mm",
            "--margin-bottom 20mm",
            "--margin-left 10mm",
            "--margin-right 10mm",
            //"--header-html '" . $tempHeaderFile . "'",
            "--footer-html '" . $tempFooterFile . "'",
            "--footer-spacing 10",
            "--load-error-handling skip",
            "--load-media-error-handling skip",
            "--disable-smart-shrinking",
            "--log-level warn",
            "--disable-external-links",
            //"--enable-internal-links",
        ];

        // Generate the full command with options
        $command = "ulimit -n 60000 && \"$wkhtmltopdfPath\" " . implode(' ', $options) . " $tempHtmlFile $pdfPath";
        exec($command, $output, $return_var);


        // Clean up temporary file
        //        if (file_exists($tempHtmlFile)) {
        //            unlink($tempHtmlFile);
        //        }
        //
        //        if (file_exists($tempHeaderFile)) {
        //            unlink($tempHeaderFile);
        //        }
        //
        //        if (file_exists($tempFooterFile)) {
        //            unlink($tempFooterFile);
        //        }

        if (file_exists($tempFooterFile)) {
            unlink($tempFooterFile);
        }

        if ($return_var === 0) {
            return $pdfFile;
        } else {
            if (file_exists($pdfPath)) {
                return $pdfFile;
            } else {
                return null;
            }
        }
    }
}
