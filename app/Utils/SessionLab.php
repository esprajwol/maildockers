<?php

namespace App\Utils;

class SessionLab
{
    public const GOOGLE_SESSION_QUERY         = "query";
    public const GOOGLE_SESSION_INC_ARRAY     = "inc_array";
    public const GOOGLE_SESSION_INC_QUERY     = "inc_query";
    public const GOOGLE_SESSION_EXC_QUERY     = "exc_query";
    public const GOOGLE_SESSION_DATE_AFTER    = "date_after";
    public const GOOGLE_SESSION_DATE_BEFORE   = "date_before";
    public const SESSION_TOTAL_MESSAGES       = "total_message";
    public const SESSION_DOWNLOAD_PDF_FILE    = "file";
    public const SESSION_EMAIL_FROM           = "emailFrom";
    public const SESSION_YOUR_EMAIL           = "yourEmail";
    public const SESSIION_DOWNLOAD_AVAILABLE  = "downloadAvailable";
    public const SESSION_MESSAGES             = "queryMessages";


    public const ORDER_ID = "order_id";

    public function setMessages($messages){

        $messagesArray = $messages->map(function($message) {
            return [
                'id' => $message->getId(),
                'threadId' => $message->getThreadId(),
                'snippet' => $message->getSnippet(),
                'historyId' => $message->getHistoryId(),
                'internalDate' => $message->getInternalDate(),
                'from' => $message->getFrom(),
                'to' => $message->getTo(),
                'subject' => $message->getSubject(),
                'date' => $message->getDate(),
                'deliveredTo' => $message->getDeliveredTo(),
                'htmlBody' => $message->getHtmlBody(),
                'plainTextBody' => $message->getPlainTextBody(),
            ];
        })->toArray();

        session()->put([
            self::SESSION_MESSAGES => json_encode($messagesArray)
        ]);
        session()->save();
    }

    public function setEmailFrom(string $emailFrom){

        session()->put([
            self::SESSION_EMAIL_FROM => $emailFrom
        ]);

        session()->save();
    }
    public function setYourEmail(string $yourEmail){

        session()->put([
            self::SESSION_YOUR_EMAIL => $yourEmail
        ]);

        session()->save();
    }
    public function setQuery($data){

        session()->put([
            self::GOOGLE_SESSION_QUERY => $data
        ]);

        session()->save();
    }

    public function setIncArray($data){

        session()->put([
            self::GOOGLE_SESSION_INC_ARRAY => $data
        ]);

        session()->save();
    }


    public function setIncQuery($data){

        session()->put([
            self::GOOGLE_SESSION_INC_QUERY => $data
        ]);

        session()->save();
    }


    public function setExcQuery($data){

        session()->put([
            self::GOOGLE_SESSION_EXC_QUERY => $data
        ]);

        session()->save();
    }

    public function setDateBefore($data){

        session()->put([
            self::GOOGLE_SESSION_DATE_BEFORE => $data
        ]);

        session()->save();
    }

    public function setDateAfter($data){

        session()->put([
            self::GOOGLE_SESSION_DATE_AFTER => $data
        ]);

        session()->save();
    }

    public function setOrderId($id)
    {
        session()->put([
            self::ORDER_ID => $id
        ]);

        session()->save();
    }

    public function setTotalMessages($totalMessages)
    {
        session()->put([
            self::SESSION_TOTAL_MESSAGES => $totalMessages
        ]);

        session()->save();
    }

    public function setDownloadFile($file = null)
    {
        session()->put([
            self::SESSION_DOWNLOAD_PDF_FILE => $file
        ]);

        session()->save();
    }

    public function generateGoogleSession(){

    }
}
