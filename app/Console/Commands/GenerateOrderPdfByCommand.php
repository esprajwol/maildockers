<?php

namespace App\Console\Commands;

use App\Models\Order;
use App\Services\File\JsonToPdfService;
use Illuminate\Console\Command;

class GenerateOrderPdfByCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:order-pdf {orderId}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a PDF for a specific order by order ID';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        setMemoryLimitation();
        try{
            $orderId = $this->argument('orderId');

            $logMsg =  "Command Execution has started for the order-id: {$orderId}";
            info($logMsg);
            echo $logMsg;

            $order = Order::query()->findOrFail($orderId);

            $jsonFilePath = storage_path("app/public/{$order->msg_json_file}");
            $filePath = (new JsonToPdfService())->createPDFWithWkHtml2Pdf(
                $jsonFilePath,
                "rislam252@gmail.com",
                "en", [],
                true,
                $order
            );

//            $filePath = (new JsonToPdfService())->createPDF(
//                $jsonFilePath,
//                "rislam252@gmail.com",
//                "en", [],
//                true,
//                $order
//            );

//            $filePath = (new JsonToPdfService())->createPdfFromDatabase($order);

            if ($filePath) {
                $order->update([
                    "status"   => "Done",
                    "pdf_file" => $filePath
                ]);

                $logEndMsg =  "Command Execution has completed for the order-id: {$orderId}";
                info($logEndMsg);
                echo $logEndMsg;

                return 1; // Return success code
            }

            return 0;
        }
        catch(\Throwable $e){
            commonLog("Failed to execute order id from GenerateOrderPdfByCommand.php", errorArray($e));
            return 0;
        }

    }
}
