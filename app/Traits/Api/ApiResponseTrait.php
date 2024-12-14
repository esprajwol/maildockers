<?php

namespace App\Traits\Api;

trait ApiResponseTrait
{

    public function sendResponse(
        $code = 201,
        $message = "Default Api Response",
        string | array $data = [],
        string | array $optional = []
    )
    {
        $codeEnum = $this->codeEnum($code);

        $payloads = [
            "message" => $message,
            "data" => $data,
            "optional" => $optional
        ]+$codeEnum;

        if(!$payloads["status"]){
            commonLog("False Api Response LOG", $payloads, logService()::LOG_FAILED_RESPONSE);
        }

        return response()->json($payloads, $code);
    }


    public function codeEnum($code)
    {
        $appStatic = appStatic();

        return match ($code) {
            $appStatic::SUCCESS_WITH_DATA => [
                "status" => true,
                "code" => $appStatic::SUCCESS_WITH_DATA,
            ],
            $appStatic::NOT_FOUND => [
                "status" => false,
                "code" => $appStatic::NOT_FOUND,
            ],
            $appStatic::VALIDATON_ERROR => [
                "status" => false,
                "code" => $appStatic::VALIDATON_ERROR,
            ],
            $appStatic::UNAUTHORIZED => [
                "status" => false,
                "code" => $appStatic::UNAUTHORIZED,
            ],
            $appStatic::INTERNAL_SERVER_ERROR => [
                "status" => false,
                "code" => $appStatic::INTERNAL_SERVER_ERROR,
            ],
        };
    }


}
