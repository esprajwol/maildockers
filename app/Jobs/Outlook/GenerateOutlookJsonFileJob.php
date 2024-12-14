<?php

namespace App\Jobs\Outlook;

use App\Mail\Partner\OrderFailMail;
use App\Models\Order;
use App\Models\User;
use App\Services\File\SnappyPdfService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;


class GenerateOutlookJsonFileJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $order;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        setMemoryLimitation();
        // Retrieve messages from Redis
        $messages = json_decode(Redis::get("order_messages_{$this->order->id}"), true);

        if (!$messages) {
            $this->fail(new \Exception('Messages not found on redis.'));
        }

        $order = $this->order;

        $order->update([
            "fetch_start_at" => now(),
            "processing_status" => 1 // Fetching Start
        ]);

        if (!File::isDirectory(storage_path('app/public'))) {
            //make the directory because it doesn't exists
            File::makeDirectory(storage_path('app/public'));
        }

        $fileName    = "order_id_{$order->id}" . '.json';
        $msgJsonFile = storage_path('app/public/' . $fileName);

        // Initialize an array to hold parsed messages
        $parsedMessages = [];

        $countData = count($messages);
        $num = 0;

        // Loop through each message and parse it
        foreach ($messages as $key => $message) {

            // check for threads
            $hasThreads = isset($message['threads']);

            if ($hasThreads) {
                $parsedMessages[$key] = SnappyPdfService::parseOutlookMessage($message);
                foreach ($message['threads'] as $threadMessage) {
                    $parsedMessage = SnappyPdfService::parseOutlookMessage($threadMessage);
                    $parsedMessages[] = $parsedMessage;
                    $parsedMessages[$key]['threads'][] = $parsedMessage;
                }
            } else {
                $parsedMessage = SnappyPdfService::parseOutlookMessage($message);
                $parsedMessages[] = $parsedMessage;
                $parsedMessages[$key] = $parsedMessage;
            }

            $num++;
            $progress = 25 + floor(($num / $countData) * 25);

            // Update progress in Redis
            $orderKey = $order->id;
            $redisKey = "job_progress_{$orderKey}";
            Redis::set($redisKey, json_encode(['status' => 'processing', 'progress' => $progress]));
        }
        $order->update([
            "fetch_end_at" => now(),
            "processing_status" => 2 // Fetching End
        ]);

        // Write Into the JSON File
        $jsonData = json_encode($parsedMessages, JSON_PRETTY_PRINT);
        File::put($msgJsonFile, $jsonData);

        //store the json file in db after file successfully generated
        $order->update([
            "msg_json_file" => "order_id_{$order->id}.json"
        ]);

        // After processing, delete the messages from Redis
        Redis::del("order_messages_{$this->order->id}");
    }

    public function failed(\Exception $exception)
    {

        $order = $this->order;

        if ($order) {
            $order->pdf_gen_end_at = now();
            $order->status = 'Failed';
            $order->save();

            // Check if job is running for first time then only mail will be sent
            if ($this->attempts() == 1) {
                //Find partner and send mail to partner
                $partner = User::where('id', $order->partner_id)->first();
                if ($partner && $partner->email != '' && $partner->email != null) {
                    Mail::to($partner->email)->queue(new OrderFailMail($order));
                }
            }
        }
    }
}
