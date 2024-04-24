<?php

namespace Modules\Order\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Coupon\Models\Coupon;
use Modules\Order\Enums\OrderChannelEnum;
use Modules\Order\Enums\OrderTypeEnum;
use Modules\Order\Enums\PaymentMethodEnum;
use Modules\Order\Http\Requests\CheckOut\StoreCheckoutRequest;
use Modules\Order\Models\Order;
use Modules\Order\Models\OrderDetail;
use Modules\Order\Services\PaymentService\PaymentVnPayService;

class CheckOutController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        if(!auth()->check()){
            $carts = session("carts", []);
        }
        return view('order::pages.carts.checkout', [
            "carts" => $carts
        ]);
    }

    public function store(StoreCheckoutRequest $request, PaymentVnPayService $vnPayService)
    {
        $order = $request->validated();
        $address = "$request->province_name, $request->district_name, $request->ward_name";
        $order["address"] = $address;
        $order["order_code"] = renderOrderCode();
        $order["order_type"] = OrderTypeEnum::BOOKING;
        $order["order_channel"] = OrderChannelEnum::WEB;
        if($request->coupon_code){
            $coupon = Coupon::where("code")->first();
            if($coupon){
                $order["coupon_value"] = 0;
                $order["coupon_id"] = $coupon;
            }
        }
        else{
            $order["coupon_value"] = 0;
        }

        $order["shipping_price"] = 0;

        if(!auth()->check()){
            $carts = session("carts");
            $order["total"] = getPriceCart($carts, "");
            $order["amount"] = $order["total"] + $order["shipping_price"] + $order["coupon_value"];
            $order["payment_method"] = PaymentMethodEnum::getValue($request->method_payment);
            $orderNew = Order::create($order);
            $orderDetails = [];
            foreach($carts as $key => $cart){
                $orderDetails[$key]["name"] = $cart->name;
                $orderDetails[$key]["slug"] = $cart->slug;
                $orderDetails[$key]["image"] = $cart->image;
                $orderDetails[$key]["price"] = $cart->price;
                $orderDetails[$key]["quantity"] = $cart->quantity;
                $orderDetails[$key]["product_item_id"] = $cart->product_item_id;
                $orderDetails[$key]["order_id"] = $orderNew->id;
                $string = "";
                $sizeVariation = sizeof($cart->variation);
                if($sizeVariation){
                    for ($i = $sizeVariation - 1; $i >= 0; $i--){
                        $string .= "{$cart->variation[$i]->name}: {$cart->variation[$i]->value}";
                        if($i != 0){
                            $string .= ", ";
                        }
                    }
                }
                $orderDetails[$key]["info"] = $string;
            }
        }
        try {
            OrderDetail::insert($orderDetails);
            if($request->method_payment == "VNPAY"){
                return $vnPayService->create($order);
            }
            return redirect()->route("orders.index", ["order_code" => $order["order_code"]]);
        } catch (\Exception $e) {
            return back()->withInput()->with("error", "Vui lòng thử lại sau");
        }
        
    }

    public function update(){
        
    }

}
