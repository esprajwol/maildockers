<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Jobs\Order\OrderPdfGenerateJob;
use App\Models\Order;
use Dacastro4\LaravelGmail\Facade\LaravelGmail;
use Illuminate\Http\Request;

class DownloadController extends Controller
{

    public function dispatchJobOrder(Request $request)
    {
        $this->validate($request,[
            "pdf_send_to_email" => "required|email",
            "order_id" => "required|exists:orders,id",
        ]);

        try {
            $order = Order::query()->findOrFail($request->order_id);
            $order->update([
                "notify_value" => $request->pdf_send_to_email,
            ]);
            $token  = LaravelGmail::getToken()["access_token"];
            dispatch(new OrderPdfGenerateJob($order,$token));
            session()->forget("order_id");
            session()->forget("notify_value");
            session()->forget("total_messages");
            session()->forget("session_order_id");

            return redirect("/")."?pdf_sending=true";
        }
        catch (\Throwable $e){

        }
    }
    public function download($file=null) {

        $path = storage_path('app/public/' . $file);

        if (!file_exists($path)) {

            return redirect("/");
        }

        return response()->download($path, $file)->deleteFileAfterSend(true);
    }

    public function destroy($file=Null) {

        $path = storage_path('app/public/' . $file);
        if (!file_exists($path)) {
            return response()->json(['message' => 'File not found.'], 404);
        }
        unlink($path);
        return response()->json(['message' => 'File deleted.']);
    }
}
