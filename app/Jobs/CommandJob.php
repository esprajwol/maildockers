<?php

namespace App\Jobs;

use App\Models\Order;
use App\Services\File\JsonToPdfService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CommandJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    protected $order;
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
        // Start capturing memory usage and CPU load before processing
        $startTime = microtime(true);
        $startCpu = getrusage();

        $order_id = $this->order->id;

        info("Execution starting from CommandJob: {$order_id}");

        if (!File::isDirectory(storage_path('app/public'))) {
            //make the directory because it doesn't exists
            File::makeDirectory(storage_path('app/public'));
        } 
         
        $jsonFilePath = storage_path("app/public/{$this->order->msg_json_file}");

        $filePath = (new JsonToPdfService())->createPDF(
            $jsonFilePath,
            "rislam252@gmail.com",
            "en", [],
            true,
            $this->order
        );

        if ($filePath) {
            $this->order->update([
                "status" => "Done",
                "pdf_file" => $filePath
            ]);
        }

        // Capture metrics after processing
        $endTime = microtime(true);
        $endMemory = memory_get_peak_usage();
        $endCpu = getrusage();

        // Calculate the duration
        $duration = $endTime - $startTime;

        // Calculate the CPU time (user time + system time)
        $cpuTime = ($endCpu["ru_utime.tv_sec"] - $startCpu["ru_utime.tv_sec"]) +
            ($endCpu["ru_utime.tv_usec"] - $startCpu["ru_utime.tv_usec"]) / 1e6 +
            ($endCpu["ru_stime.tv_sec"] - $startCpu["ru_stime.tv_sec"]) +
            ($endCpu["ru_stime.tv_usec"] - $startCpu["ru_stime.tv_usec"]) / 1e6;

        // Calculate CPU usage as a percentage
        $cpuUsage = ($cpuTime / $duration) * 100;

        // Convert memory usage to human-readable format
        $peakMemory = $this->convertToReadableSize($endMemory);

        info("PDF generation duration: ".round($duration, 2) . ' seconds');
        info("PDF generation cpuUsage: ".round($cpuUsage, 2) . '%');
        info("PDF generation peak Memory: ".$peakMemory);
    }

    private function convertToReadableSize($size)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        for ($i = 0; $size >= 1024 && $i < count($units) - 1; $i++) {
            $size /= 1024;
        }

        return round($size, 2) . ' ' . $units[$i];
    }
}
