<?php

namespace App\Http\Controllers;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class PdfDesignController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function pdfDesign()
    {
        return view('pdf_design');
    }
    public function downloadPdf($id)
    {
        try{

            $order = Order::query()->findOrFail($id);

            if(!empty($order->pdf_file)){
                $filePath = storage_path('app/public/'.$order->pdf_file);

                if(file_exists($filePath)){
                    $response = response()->download($filePath);
                    $response->headers->set('Content-Type', 'application/pdf'); // Set content type
                    return $response;
                }
            }
        }
        catch(\Throwable $e){
         commonLog("Failed to find order", errorArray($e));

        }
    }

    public function generateAgain($id)
    {
        // Logic for generating PDF again
    }
    public function downloadDonePDF($id, $file_name)
    {
        // Use findOrFail to check if the Order is found
        $order = Order::findOrFail($id);

        // Check if file is available or not
        // Define the paths to check
        $firstPath = storage_path('app/app/public/' . $file_name);
        $secondPath = storage_path('app/public/' . $file_name);

        // Check if the file exists in either of the paths
        if (file_exists($firstPath)) {
            $path = $firstPath;
        } elseif (file_exists($secondPath)) {
            $path = $secondPath;
        } else {
            // If file is not found in either location, show a 404 error
            abort(404, 'File not found');
        }

        $order->update([
            'pdf_downloaded_at'=>now()
        ]);

        // delete the progress data stored in redis
        Redis::del("job_progress_{$order->id}");

        // Create the file download response
        $response = response()->download($path);

        // Set the content type to application/pdf
        $response->headers->set('Content-Type', 'application/pdf');

        // Use deleteFileAfterSend to ensure the file is deleted after the download is complete
        $response->deleteFileAfterSend(true);

        // Register a termination callback to update the order after the response is sent
        app()->terminating(function () use ($order) {
            // Update the order status and set pdf_file to null after the response is fully sent
            $order->update([
                'status' => 'Downloaded',
                'pdf_file' => null,
                'pdf_deleted_at'=>now()
            ]);

        });

        return $response;
    }
}
