<?php

namespace App\Console\Commands;

use App\Services\File\JsonToPdfService;
use App\Services\Google\OrderMessageService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\View;

class GenerateOrderPdf extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */

    protected $signature   = 'generate:order-pdf-wk {orderId}';
    protected $description = 'Generate a PDF for the given order ID';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        setMemoryLimitation();

        $startTime = now();
// Get the start time
        $startTime1 = microtime(true);

        info("Execution starting from GenerateOrderPdf : {$startTime->toDateTimeString()}");
        $orderId = $this->argument('orderId');
        $order   = (new OrderMessageService())->getOrderById($orderId);

        $pdfHtmlRender = (new JsonToPdfService())->pdfHtmlRender($order);

        $htmlContent = View::make("wkhtmltopdf.pdf-rendered-messages")->with([
            "htmlData" => $pdfHtmlRender
        ]);

        $tempHtmlFile = storage_path('app/public/temp.html');
        file_put_contents($tempHtmlFile, $htmlContent);
        $randomFileName = randomStringNumberGenerator(10,true,true);

        $pdfPath = storage_path('app/public/2030_'.$randomFileName.'rip_order_' . $orderId . '.pdf');
        $wkhtmltopdfPath = env('WKHTML_PDF_BINARY', '/usr/bin/wkhtmltopdf');

        $command = "$wkhtmltopdfPath $tempHtmlFile $pdfPath";
        exec($command, $output, $return_var);

        if ($return_var === 0) {
            $this->info("PDF generated successfully at $pdfPath");
        } else {
            $this->error("Error generating PDF. Return code: $return_var");
        }

        // Get the end time
        $endTime = microtime(true);

// Calculate the total execution time
        $executionTime = $endTime - $startTime1;

        info("Execution End from GenerateOrderPdf : {$startTime->toDateTimeString()}");
        info("Execution Time : {$executionTime} seconds");



//        if (file_exists($tempHtmlFile)) {
//            unlink($tempHtmlFile);
//        }
    }
}
