<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Redis;
use App\Services\File\PdfService;
use App\Services\Google\OrderMessageService;
use App\Models\Order;

class GeneratePdfJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $orderId;
    protected $messagesKey;
    protected $email_address;
    protected $language;
    protected $inc_array;
    protected $token;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($orderId, $messagesKey, $email_address, $language, $inc_array, $token)
    {
        $this->orderId = $orderId;
        $this->messagesKey = $messagesKey;
        $this->email_address = $email_address;
        $this->language = $language;
        $this->inc_array = $inc_array;
        $this->token = $token;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $redisKey = "job_progress_{$this->orderId}";

        try {
            // Update progress in Redis
            Redis::set($redisKey, json_encode(['status' => 'processing', 'progress' => 0]));

            // Retrieve messages from Redis
            $messages = json_decode(Redis::get($this->messagesKey), true);

            info("Inside Generate PDF Job token:" . $this->token);
            $oneMessage = (new OrderMessageService())->fetchSingleMessage($messages[0]["id"], $this->token);

            info($oneMessage);
            $parseOneMessage = (new PdfService())->parseMessage($oneMessage, 1);

            info($parseOneMessage);

            // Generate PDF
            $order = Order::findOrFail($this->orderId);
            $filePath = (new PdfService())->createPDFWithJob(
                $messages,
                $this->email_address,
                $this->language,
                $this->inc_array,
                $this->token,
                $order,
                $parseOneMessage
            );

            if ($filePath) {
                // Update order status
                $order->status = 'Done';
                $order->save();
                info('Order status updated to Done for order ID: ' . $this->orderId);
            } else {
                info('PDF generation failed for order ID: ' . $this->orderId);
                throw new \Exception('PDF generation failed.');
            }

            // Final progress update
            Redis::set($redisKey, json_encode(['status' => 'done', 'progress' => 100]));

            // Update order status
            $order->status = 'Done';
            $order->save();
            info('Order status updated to Done for order ID: ' . $this->orderId);

            // Optionally, delete the Redis key
            Redis::del($this->messagesKey);
        } catch (\Exception $e) {
            info('Error in GeneratePdfJob: ' . $this->orderId . ' - ' . $e->getMessage());
            Redis::set($redisKey, json_encode(['status' => 'error', 'progress' => 0]));
            throw $e;
        }
    }
}
