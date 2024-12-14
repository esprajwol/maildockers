<?php

namespace App\Http\Controllers\Google;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Traits\Api\ApiResponseTrait;
use App\Http\Requests\GenerateRequest;
use App\Services\Google\OrderMessageService;
use Dacastro4\LaravelGmail\Facade\LaravelGmail;
use App\Http\Requests\Order\OrderUpdateNotifyViaRequest;

class OrderMessageController extends Controller
{
    use ApiResponseTrait;
    public function generate(GenerateRequest $request, OrderMessageService $orderMessageService) {
        $appStatic = appStatic();

        try {
            DB::beginTransaction();

            $data = $request->validated();

            if(!isLaravelGmailSameEmail($request->your_email)) {
                return $this->sendResponse(
                    $appStatic::UNAUTHORIZED,
                    'Incorrect information for '.laravelGmailUser() . ', instead we get.'
                );
            }

            // Order Creation
            $order = $orderMessageService->storeOrder($data);
            // Order Messages Saving
            $orderMessages = $orderMessageService->storeOrderMessage($data);
            $order->update(['total_messages'=>$orderMessages]);

            session()->put('last_order_info',[
                'your_email'=> $request->your_email,
                'email_from'=> $request->email_from,
                'inc_keywords'=> $request->inc_keywords,
                'exc_keywords'=> $request->exc_keywords,
                'start_date'=> $request->start_date,
                'end_date'=> $request->end_date,
                'language'=> $request->language,
                'last_message_count'=> $orderMessages,
            ]);

            session()->put(["order_id" => $order->id]);
            session()->put('generate',true);
            session()->flash('return_status', 'messages');

            DB::commit();

            // TODO:: redirect to the customer order view

            flashMessage("Successfully generated","success");

            return redirect("/");

        } catch(\Throwable $e) {
            DB::rollBack();

            ddError($e);
            // return response(['catch' => "Sorry, there was a problem"], 500);
            return $this->sendResponse(
                $appStatic::INTERNAL_SERVER_ERROR,
                "Failed to Generate Order Message : ".$e->getMessage(),
                errorArray($e)
            );
        }
    }

    public function updateOrderNotifyVia(OrderUpdateNotifyViaRequest $request){
        $notify_channel = $request->notify_channel;
        $notify_value = $request->notify_value;

        $orderId = session("order_id");

        $order = Order::query()->findOrFail($orderId);

        $order->update([
            "notify_channel" => $notify_channel,
            "notify_value"   => $notify_value,
        ]);


        return $this->sendResponse(
            appStatic()::SUCCESS_WITH_DATA,
            "Successfully updated order notify channel",
            $order
        );
    }

    
    public function generateWhenLogin($data) {
        $appStatic = appStatic();
        $orderMessageService = new OrderMessageService();
        try {
            DB::beginTransaction();
            $order = $orderMessageService->storeOrder($data);
            session()->put('last_order_info',[
                'your_email'=> $data['your_email'],
                'email_from'=> $data['email_from'],
                'inc_keywords'=> $data['inc_keywords'],
                'exc_keywords'=> $data['exc_keywords'],
                'start_date'=> $data['start_date'],
                'end_date'=> $data['end_date'],
                'language'=> $data['language'],
//                'last_message_count'=> $orderMessages,
            ]);
            session()->put(["order_id" => $order->id]);
            session()->flash('return_status', 'messages');
            DB::commit();

            // TODO:: redirect to the customer order view

            flashMessage("Successfully generated","success");

            return true;

        } catch(\Throwable $e) {
            DB::rollBack();

            // ddError($e);
            // return response(['catch' => "Sorry, there was a problem"], 500);
            return $this->sendResponse(
                $appStatic::INTERNAL_SERVER_ERROR,
                "Failed to Generate Order Message : ".$e->getMessage(),
                errorArray($e)
            );
        }
    }
}
