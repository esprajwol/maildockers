<?php

namespace App\Jobs\WkHtmlToPdf;

use App\Mail\Partner\OrderFailMail;
use App\Models\Order;
use App\Models\User;
use App\Mail\OrderNotifyMail;
use App\Services\File\SnappyPdfService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;

class WkHtmlToPdfJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $order;
    protected $keywords;

    public function __construct(Order $order, array $keywords)
    {
        $this->order = $order;
        $this->keywords = $keywords;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        setMemoryLimitation();
        $order = $this->order;

        $order->update([
            "pdf_gen_start_at" => now(),
            "processing_status" => 3 // Fetching Start
        ]);

        $startTime = microtime(true);
        $startCpu = getrusage();


        $jsonFile = storage_path('app/public/' . $order->msg_json_file);

        // if file not exists then fail the order
        if (!File::exists($jsonFile)) {
            $this->fail(new \Exception('Json File not found.'));
        }

        // Get the file content
        $jsonData = File::get($jsonFile);

        // Decode the JSON file into an associative array
        $messages = json_decode($jsonData, true);

        if (!$messages) {
            $this->fail(new \Exception('Messages not found in json file.'));
        }

        $pdfFile = SnappyPdfService::generate($order, $messages, $this->keywords, $order->language);

        // Get the end time
        $endTime = microtime(true);
        $endMemory = memory_get_peak_usage();
        $endCpu = getrusage();

        // Calculate the total execution time
        $executionTime = $endTime - $startTime;

        // Calculate the CPU time (user time + system time)
        $cpuTime = ($endCpu["ru_utime.tv_sec"] - $startCpu["ru_utime.tv_sec"]) +
            ($endCpu["ru_utime.tv_usec"] - $startCpu["ru_utime.tv_usec"]) / 1e6 +
            ($endCpu["ru_stime.tv_sec"] - $startCpu["ru_stime.tv_sec"]) +
            ($endCpu["ru_stime.tv_usec"] - $startCpu["ru_stime.tv_usec"]) / 1e6;

        // Calculate CPU usage as a percentage
        $cpuUsage = ($cpuTime / $executionTime) * 100;

        $peakMemory = $this->convertToReadableSize($endMemory);

        info("Execution Time : {$executionTime} seconds");
        info("CPU Usage : {$cpuUsage} %");
        info("Peak Memory Usage : {$peakMemory}");

        if ($pdfFile != null) {
            // delete the json file
            //unlink($jsonFile);

            //send mail when pdf is generated
            $to = explode(',',config('developerMail.pdf-testing-email-ids'));
            $server = config('app.env');
            if ($server != 'local' && !empty($to)) {
                Mail::raw("This PDF is generated between email: {$order->from_email} and {$order->recipient_email}", function ($message) use ($pdfFile, $to, $server) {
                    $message->to($to)
                        ->subject(ucfirst($server) . ' Server PDF Generated')  
                        ->attach(storage_path('app/public/' . $pdfFile), [
                            'as' => $pdfFile,
                            'mime' => 'application/pdf',
                        ]);
                });
            }

            // file found
            $order->update([
                "pdf_gen_end_at" => now(),
                "processing_status" => 4,
                "pdf_file" => $pdfFile,
                "status" => "Done"
            ]);

            // Update progress in Redis
            $orderKey = $order->id;
            $redisKey = "job_progress_{$orderKey}";
            Redis::set($redisKey, json_encode(['status' => 'processing', 'progress' => 100]));
            $this->notifyOrderEmail();
        } else {
            $this->PdfGenerationFailed($order);
        }
    }

    private function notifyOrderEmail()
    {
        $order = $this->order;

        if ($order->notify == 1) {

            if ($order->user_id) {
                $email = User::find($order->user_id)->email;
            } else {
                $email = $order->from_email;
            }

            Mail::to($email)->queue(new OrderNotifyMail($order));

            info("Order Complete and sending email to notify.");
        }
    }

    private function convertToReadableSize($size)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        for ($i = 0; $size >= 1024 && $i < count($units) - 1; $i++) {
            $size /= 1024;
        }

        return round($size, 2) . ' ' . $units[$i];
    }

    /**
     * Handle a job failure.
     *
     * @param \Throwable $exception
     * @return void
     */
    public function failed(\Throwable $exception)
    {
        // Log the exception using Laravel's default report method
        report($exception);

        // Update the related order's status to 'Failed'
        // Assuming you have access to the order instance in the job
        $order = $this->order;
        $this->PdfGenerationFailed($order);
    }

    protected function PdfGenerationFailed(Order $order)
    {
        if ($order) {

            // Check if job is running for first time then only mail will be sent
            if ($this->attempts() == 1) {
                //Find partner and send mail to partner
                $partner = User::where('id', $order->partner_id)->first();
                if ($partner && $partner->email != '' && $partner->email != null) {

                    Mail::to($partner->email)->queue(new OrderFailMail($order));
                }
            }

            $order->update([
                "pdf_gen_end_at" => now(),
                "status" => "Failed"
            ]);
        }
    }
}
