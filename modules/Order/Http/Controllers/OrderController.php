<?php

namespace Modules\Order\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Order\Models\Order;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orderCode = $request->order_code;
        if($orderCode){
            $order = Order::where("order_code", $orderCode)->first();
            if(!auth()->check() && $order->user_id){
                return view("order::pages.order.index", [
                    "error" => "Bạn phải đăng nhập để xem đơn hàng này"
                ]);
            }
            $orderDetails = $order->orderDetails();
            return view("order::pages.order.index", [
                "order" => $order,
                "order_details" => $orderDetails
            ]);
        }
        return view("order::pages.order.index");
    }
}
