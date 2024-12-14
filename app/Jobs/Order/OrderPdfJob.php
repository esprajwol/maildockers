<?php

namespace App\Jobs\Order;

use App\Models\Order;
use App\Services\File\JsonToPdfService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Redis;

class OrderPdfJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $order;
    protected $redisKey;
    protected $messageKey;
    public function __construct(Order $order, $redisKey = null, $messageKey = null)
    {
        $this->order       = $order;
        $this->redisKey    = $redisKey;
        $this->messageKey = $messageKey;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $order    = $this->order;
        $redisKey = $this->redisKey;

        info("PDF Generation started, Inside OrderPdfJob for order ID: " . $order->id);

        $filePath = (new JsonToPdfService())->createPdfFromDatabase($order);

        if ($filePath) {
            // Update order status
            $order->update([
                "status"   => "Done",
                "pdf_file" => $filePath
            ]);

            // Final progress update
            if(!empty($redisKey)) {
                Redis::set($redisKey, json_encode(['status' => 'done', 'progress' => 100]));
            }

            if(!empty($this->messageKey)){
                // Optionally, delete the Redis key
                Redis::del($this->messageKey);
            }

            info('Pdf Generate has been complete ,Order status updated to Done for order ID: ' . $order->id);

        } else {
            throw new \Exception('PDF generation failed.');
        }
    }
}
