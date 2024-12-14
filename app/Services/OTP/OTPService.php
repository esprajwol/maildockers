<?php

namespace App\Services\OTP;

use App\Models\MessageArchive;
use Twilio\Rest\Client;

class OTPService
{

    const TWILIO_SID        = "AC5f175c5294f2bfc55ca3206d5f25d42e";
    CONST TWILIO_AUTH_TOKEN = "dd8b05e765bf2fd21e0436c41931b46a";
    CONST TWILIO_NUMBER     = '+447703647933';


    public function sendOTP($userSetting = null)
    {
        $user = user();

        $userSetting = is_null($userSetting) ? $user->setting : $userSetting;

        $user->sendEmailVerificationNotification();

        return true;
        //TODO:: Temporary stop until twilio phone number is ready
        if($userSetting->is_enable_sms){
            if(!empty($user->mobile_no)){
                $otp = randomStringNumberGenerator(6,true);
                $user->update([
                    "otp" => $otp
                ]);

                //TODO::SMS OTP Sending
                $message = $this->otpMessage($otp);

                $fromNumber = env("TWILIO_NUMBER",self::TWILIO_NUMBER);
                $toNumber   = $user->mobile_no;
                $payloads   = $this->prepareMessageArchive("otp", $toNumber, $fromNumber, $otp, $message);

                // Send the Message via provider
                $this->sendSMSVia($toNumber,$message);

                // Store Message Archive
                $this->storeMessageArchive($payloads);
            }

            flashMessage("Please, update your mobile no or Contact with Admin, Currently no mobile no found.","error");
        }
        else{
            $user->sendEmailVerificationNotification();
        }


    }


    public function sendSMSVia($toNumber, $message, $pipline = "twilio"){

        //TODO:: Will implements integration here
        $fromNumber      = env("TWILIO_NUMBER",self::TWILIO_NUMBER);
        $twilioSid       = env("TWILIO_SID",self::TWILIO_SID);
        $twilioAuthToken = env("TWILIO_AUTH_TOKEN",self::TWILIO_AUTH_TOKEN);

        $client = new Client($twilioSid, $twilioAuthToken);

        $client->setEdge('singapore');

        $twilioMessage = $client->messages->create(
            // The number you'd like to send the message to
            $toNumber,
            [
                'from' => $fromNumber,
                'body' => $message
            ]
        );

        commonLog("Twilio Message Send",["twilioResponse"=>$twilioMessage], logService()::LOG_TWILIO);

        return $twilioMessage;
    }


    public function prepareMessageArchive(
        $purpose,
        $to_number,
        $from_number,
        $otp = null,
        $messageBody,
        $smsProvider = "twilio"
    ){
        return [
            "purpose"      => $purpose,
            "to_number"    => $to_number,
            "from_number"  => $from_number,
            "body"         => $messageBody,
            "otp"          => $otp,
            "sms_provider" => $smsProvider,
        ];
    }

    public function otpMessage($otp){
           return "Your OTP for Goods Tracker login is: {$otp}\n
Please do not share this OTP with anyone.\n
If you didn't request this, contact support immediately.\n\n
Thanks,\n
Goods Tracker Team";
    }


    public function storeMessageArchive(array $payloads){

        return MessageArchive::query()->create($payloads);
    }


}
