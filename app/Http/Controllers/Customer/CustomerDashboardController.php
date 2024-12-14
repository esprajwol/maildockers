<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderMessage;
use Illuminate\Http\Request;

class CustomerDashboardController extends Controller
{
    public function orders(){
        $data['orders'] = Order::query()->paginate(20);
        return view('dashboard.customer.orders')->with($data);
    }
    public function orderMessages($orderId){
        $data['messages'] = OrderMessage::query()->where('order_id',$orderId)->paginate(20);
        return view('dashboard.customer.order_messages')->with($data);
    }
}
