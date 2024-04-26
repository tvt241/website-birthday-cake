<?php

namespace Modules\Order\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Core\Traits\ResponseTrait;
use Modules\Order\Models\Order;
use Modules\Order\Resources\OrderInfoResource;

class OrderController extends Controller
{
    use ResponseTrait;
    public function index(Request $request)
    {
        return view("order::pages.order.index");
    }

    public function show($code){
        $order = Order::where("order_code", $code)->first();
        if(!$order){
            $message = "Mã đơn hàng không đúng";
            return $this->ErrorResponse($message);
        }
        // if(!auth()->check() && $order->user_id){
        //     $message = "Bạn phải đăng nhập để xem đơn hàng này";
        //     return $this->ErrorResponse($message);
        // }
        return $this->SuccessResponse(new OrderInfoResource($order));
    }
}
