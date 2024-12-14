<?php

namespace App\Services\File;

use App\Models\OrderMessage;
use App\Models\User;
use App\Services\Google\OrderMessageService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class DynamicService
{
    public function generateFileName($from, $to, $orderId, $responseOnlyFileName = false)
    {
        if (!File::isDirectory(storage_path('app/public'))) {
            //make the directory because it doesn't exists
            File::makeDirectory(storage_path('app/public'));
        } 
        
        // Generate a sanitized file name
        $fileName    = "order_id_{$orderId}".'.json';

        return storage_path('app/public/' . $fileName);
    }


    public function readTheMessageIds($messages, $token, $txtFile, $order)
    {
        $messageConversationBody = [];
        // Capture the start time
        $startTime = microtime(true);

        $order->update([
            "fetch_start_at"=> now(),
            "processing_status"=> 1 // Fetching Start
        ]);

        $countData = count($messages);
        $num = 0;
        info("Order ID: {$order->id} &  Order Messages storing started. Messages count for this order is: $countData");
        foreach($messages as $key=>$message){
            $messages[$key] = $message['id'];

            try {
                $orderFromEmail = $order->from_email; // Order sender email
                $orderToEmail = $order->recipient_email;     // Order recipient email

                // Fetch a single message
                $singleMessage = (new OrderMessageService())->fetchSingleMessage($message['id'], $token);

                if (!empty($singleMessage)) {
                    $parseMessage = SnappyPdfService::parseGmailMessage($singleMessage);

                    // Only add valid parsed messages
                    if (!empty($parseMessage)) {

                        $thread = (new OrderMessageService())->fetchThreadMessage($message['threadId'], $token);

                        $threadMessages = $thread['messages'];
                        foreach ($threadMessages as $threadData) {
                            $threadParsedMessage = SnappyPdfService::parseGmailMessage($threadData);

                            if (!empty($threadParsedMessage)){
                                // Merge 'from', 'to', 'cc', and 'bcc' into a single array of emails
                                $threadEmails = array_merge(
                                    array_map('extractEmail', $threadParsedMessage['from']),
                                    array_map('extractEmail', $threadParsedMessage['to']),
                                    array_map('extractEmail', $threadParsedMessage['cc']),
                                    array_map('extractEmail', $threadParsedMessage['bcc'])
                                );

                                // Check if both order 'from' and 'to' emails are present in the thread
                                if (in_array($orderFromEmail, $threadEmails) && in_array($orderToEmail, $threadEmails)) {
                                    $parseMessage['threads'][] = $threadParsedMessage;
                                }
                            }
                        }

                        $messageConversationBody[] = $parseMessage;
                        $num++;

                        // Calculate and update progress
                        $progress = 25 + floor(($num / $countData) * 25);
                        $orderKey = $order->id;
                        $redisKey = "job_progress_{$orderKey}";
                        Redis::set($redisKey, json_encode(['status' => 'processing', 'progress' => $progress]));
                    }
                }
            } catch (\Exception $e) {
                // Log any exceptions during the message fetch or parse process
                Log::error("Order ID: {$order->id}, Message ID: {$message['id']} encountered an error: {$e->getMessage()}");
            }
        }

        /**
         * Run another loop to store the messages
         * */
//        $chunks = array_chunk($messageConversationBody, 50); // Adjust chunk size as needed
//
//        DB::transaction(function () use ($chunks) {
//            foreach ($chunks as $chunk) {
//                DB::table('order_messages')->insert($chunk);
//            }
//        });

        $order->update([
            "fetch_end_at"=> now(),
            "processing_status"=> 2 // Fetching End
        ]);

        info("Order ID: {$order->id} &  Order Messages storing END.");

//        DB::table("order_messages")->insert($messageConversationBody);
        // Capture the end time
        $endTime = microtime(true);

        // Calculate the total execution time
        $executionTime = $endTime - $startTime;

        // Log the execution time using the info() function
        Log::info("Order ID :{$order->id}, execution time: {$executionTime} seconds");

        // Write the data into the JSON file only if there's data to write
        if (!empty($messageConversationBody)) {
            $jsonData = json_encode($messageConversationBody, JSON_PRETTY_PRINT);
            File::put($txtFile, $jsonData);
        } else {
            Log::warning("Order ID: {$order->id}, JSON file is empty as no messages were parsed.");
        }

        return $messageConversationBody;
    }

    public function storeOrderMessages($order, array $messagePayload, $onlyPayloadResponse = false)
    {
        $user_id = User::query()->first()->id;

        $payload = [
            'order_id' => $order->id,
            "user_id"  => $user_id,
            "subject"  => $messagePayload['subject'],
            "message"  => json_encode($messagePayload)
        ];

        return $onlyPayloadResponse ? $payload : OrderMessage::query()->create($payload);
    }

    function parseMessage($messageDetails)
    {
        $parsedMessage = [];

        $headers = isset($messageDetails['payload'],$messageDetails['payload']['headers']) ? $messageDetails['payload']['headers'] : [];

        if(empty($headers)){
            return $parsedMessage;
        }

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
                // Remove the redundant timezone specification
                $timeString = preg_replace('/\([^)]+\)/', '', $header['value']);
                $date          = Carbon::parse($timeString);
                $formattedDate = $date->format('d/m/Y H:i');

                $parsedMessage['date'] = $formattedDate; // $header['value'];
            }
        }

        // Get body
        $body = getBody($messageDetails['payload']);
        $parsedMessage['body'] = $body;


        return $parsedMessage;
    }

}
