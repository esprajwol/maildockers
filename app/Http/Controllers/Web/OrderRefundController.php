<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderRefund;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;

class OrderRefundController extends Controller
{
    public function store(Request $request)
    {

        $rules = array(
            'order_id' => 'required|exists:orders,id',
        );

        $messages = array(
            'order_id.*' => localize("provide_order_id")
        );

        $validator = Validator::make($request->all(), $rules, $messages);

        // Validate the input and return correct response
        if ($validator->fails()) {
            $message = $validator->getMessageBag()->first();
            return response()->json(['status' => false, 'message' => $message], 422);
        }

        $user_email = null;
        if (session('yourEmail')) {
            $user_email = session('yourEmail');
        } elseif (session('userEmail')) {
            $user_email = session('userEmail');
        }

        // order id and session of your email should match with order
        if (!$user_email) {
            return response()->json(['status' => false, 'message' => localize("session_request_expired")], 403);
        }

        // order must be failed status
        $order = Order::where('status', 'Failed')
            ->where('from_email', $user_email)
            ->where('id', $request->order_id)
            ->first();
            
        if (!$order) {
            return response()->json(['status' => false, 'message' => localize("provide_order_id")], 422);
        }

        // create new refund request
        OrderRefund::create([
            'order_id' => $order->id,
            'partner_id' => $order->partner_id,
        ]);

        // update the order status to refund
        $order->status = "Refund";
        $order->save();

        // delete the progress data stored in redis
        Redis::del("job_progress_{$order->id}");

        // send response back to user
        return response()->json(['status' => true, 'message' => localize('refund_request_success')], 200);
    }
}
