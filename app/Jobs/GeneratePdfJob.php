<?php

namespace App\Jobs;

use App\Jobs\Order\OrderPdfJob;
use App\Mail\ExceptionMail;
use App\Mail\Partner\OrderFailMail;
use App\Models\User;
use App\Services\File\DynamicService;
use App\Services\File\JsonToPdfService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
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
    protected $order;

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
        $this->order = Order::findOrFail($this->orderId);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        setMemoryLimitation();

        try {

            // Retrieve messages from Redis
            $messages      = json_decode(Redis::get($this->messagesKey), true);

            if (!$messages){
                $this->fail(new \Exception('Messages not found on redis.'));
            }

            $order         = $this->order;

            $fromEmail     = $order->from_email;
            $recipentEmail = $order->recipent_email;
            $order_id      = $order->id;

            // File name of the json file.
            $msgJsonFile    = (new DynamicService())->generateFileName(
                $fromEmail,
                $recipentEmail,
                $order_id,
                true
            );

            // Reading the messages and storing in give file name
            $parsedMessages = (new DynamicService())->readTheMessageIds($messages,$this->token, $msgJsonFile, $order);

            //store the json file in db after file successfully generated
            $order->update([
                "msg_json_file" => "order_id_{$order_id}.json"
            ]);

            // After processing, delete the messages from Redis
            Redis::del($this->messagesKey);

        } catch (\Exception $e) {
            info('Error in GeneratePdfJob: ' . $this->orderId . ' - ' . json_encode(errorArray($e)));
            throw $e;
        }
    }
    public function failed(\Exception $exception)
    {
        // Find and delete the order
        $order = $this->order;

        if ($order) {
            $order->pdf_gen_end_at = now();
            $order->status = 'Failed';
            $order->save();

            // Check if job is running for first time then only mail will be sent
            if ($this->attempts() == 1){
                //Find partner and send mail to partner
                $partner = User::where('id',$order->partner_id)->first();
                if ($partner && $partner->email != '' && $partner->email != null){
                    Mail::to($partner->email)->queue(new OrderFailMail($order));
                }
            }


            info('Order status updated to Failed for order ID: ' . $this->orderId);
        }


        // Optionally log additional details about the failure
        info('Failed job for order ID: ' . $this->orderId . ' - Exception: ' . $exception->getMessage());
    }
}
