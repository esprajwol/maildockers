<?php
namespace App\Jobs\Order;

use App\Models\Order;
use App\Services\Google\OrderMessageService;
use Google\Service\CloudSearch\IntegerFacetingOptions;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use App\Http\Controllers\Web\HomeController;
use App\Services\File\PdfService;
use App\Utils\SessionLab;
use App\Mail\OrderPdfMail;
use Illuminate\Support\Facades\Mail;

class OrderPdfGenerateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $order;
    protected $messages;
    protected $token;
    public function __construct(Order $order,$token)
    {
        $this->order = $order;
        $this->token = $token;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        ini_set('memory_limit', '-1');
        set_time_limit(-1);
        try {
            $order = $this->order;
            $token = $this->token;

            $generatedPdfFile = null;

            $messages = (new OrderMessageService())->getMessages($order,false, $token);

            $temp = new HomeController();

            // Task 1 : Generate the PDF
            $file = '';
            if ($order->platform_type == 2) {
                $filePath = $temp->outlookPdfGenerate();
    //            $temp->customSessionForgot();

                $file = storage_path('app/public/' . $filePath);
            }else{
    //            $sessionLab = new SessionLab();
                $request       = json_decode($order->request);
                $filePath      = $order->downloadFile;
                $language      = $request->language;
                $inc_array     = $request->inc_array ?? null;
                $email_address = $request->email_from ?? null;


                $pdfFile = (new PdfService())->createPdfUsingSnappy(
                    $messages,
                    $email_address,
                    $language,
                    $inc_array,
                    $token,
                    $order
                );

                $generatedPdfFile = $pdfFile;

                $file = storage_path('app/public/' . $pdfFile);
            }

            // return true;

            // Your Task 1 Code is here


            // Task 2 : Send the email
            if (file_exists($file)) {
                $toEmail = empty($order->notify_value) ? $order->from_email : $order->notify_value;
                Mail::to($toEmail)->send(new OrderPdfMail($generatedPdfFile, $file, $order));
            }
        // Your Task 2 code is here.
        }
        catch (\Throwable $e) {
            info("Job Failed Exception : ".json_encode(errorArray($e)));
        }
    }
}
