<?php

namespace Modules\Order\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Coupon\Models\Coupon;
use Modules\Customer\Enums\CustomerStatusEnum;
use Modules\Order\Enums\OrderChannelEnum;
use Modules\Order\Enums\OrderTypeEnum;
use Modules\Order\Enums\PaymentMethodEnum;
use Modules\Order\Http\Requests\CheckOut\StoreCheckoutRequest;
use Modules\Order\Models\Cart;
use Modules\Order\Models\Order;
use Modules\Order\Models\OrderDetail;
use Modules\Order\Services\PaymentService\PaymentVnPayService;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductItem;
use Modules\Product\Models\ProductVariation;
use PDO;

class CheckOutController extends Controller
{
    public function index()
    {
        if(!auth()->check()){
            $carts = session("carts", []);
            if(!sizeof($carts)){
                return redirect()->route("home");
            }
        }
        else{
            $carts = auth()->user()->carts;
            if(!$carts->count()){
                return redirect()->route("home");
            }
        }
        $cartTemp = [];
        foreach($carts as $key => $cart){
            $productItem = ProductItem::find($cart->product_item_id);
            if($productItem->quantity < $carts[$key]->quantity){
                $carts[$key]->quantity = $productItem->quantity;
            }
            $product = $productItem->product;
            $cartTemp[$key] = $cart;
            $cartTemp[$key]->name = $product->name;
            $cartTemp[$key]->info = $productItem->variation_string;
            $cartTemp[$key]->price = $productItem->price;
        }
       
        return view('order::pages.carts.checkout', [
            "carts" => $cartTemp
        ]);
    }

    public function store(StoreCheckoutRequest $request, PaymentVnPayService $vnPayService)
    {
        DB::beginTransaction();
        try {
            $order = $request->validated();
            $isLogin = auth()->check();
            if(!$isLogin){
                $carts = session("carts");
                if(!sizeof($carts)){
                    return redirect()->route("home");
                }
            }
            else{
                $carts = auth()->user()->carts;
                if(!$carts->count()){
                    return redirect()->route("home");
                }
                $userId = auth()->id();
                $order["user_id"] = $userId;
            }
            $address = "$request->ward_name, $request->district_name, $request->province_name";
            $order["address"] = $address;
            $order["order_code"] = renderOrderCode();
            $order["order_type"] = OrderTypeEnum::BOOKING;
            $order["order_channel"] = OrderChannelEnum::WEB;
            $order["coupon_value"] = 0;
            $order["total"] = 0;

            $orderDetails = [];
            foreach($carts as $key => $cart){
                $productItem = ProductItem::find($cart->product_item_id);
                if($productItem->quantity < $cart->quantity){
                    DB::rollBack();
                    return redirect()->route("carts.index")->with("error", "Một vài sản phẩm đã hết hàng");
                }
                $order["total"] += $productItem->price * $cart->quantity;

                $product = $productItem->product;
                $orderDetails[$key]["name"] = $product->name;
                $orderDetails[$key]["slug"] = $product->slug;
                $orderDetails[$key]["image"] = $product->image?->url;
                $orderDetails[$key]["price"] = $productItem->price;
                $orderDetails[$key]["price_import"] = $productItem->price_import;
                $orderDetails[$key]["quantity"] = $cart->quantity;
                $orderDetails[$key]["product_item_id"] = $cart->product_item_id;
                $orderDetails[$key]["info"] = $productItem->variation_string;
                // $orderDetails[$key]["order_id"] = $orderNew->id;
                if($isLogin){
                    if(auth()->user()->is_active == CustomerStatusEnum::VERIFIED->value){
                        $productItem->available -= $cart->quantity;
                        $productItem->save();
                    }
                }
            }
            if($request->coupon_code){
                $coupon = Coupon::where("code", $request->coupon_code)->first();
                if(!$coupon){
                    return back()->withInput()->with('error', "Mã giảm giá không hợp lệ hoặc đã hết hạn");
                }
                $valueDiscount = $coupon->checkCouponInvalid($order["total"]);
                if(!is_array($valueDiscount)){
                    return back()->withInput()->with("error", $valueDiscount);
                }
                $order["coupon_value"] = $valueDiscount["value"];
                $order["coupon_id"] = $coupon->id;

                $coupon->available -= 1;
                $coupon->budget_available -= $valueDiscount["value"];
                $coupon->save();
            }
    
            $order["shipping_price"] = 0;
            $order["payment_method"] = PaymentMethodEnum::getValue($request->method_payment);
            $order["amount"] = $order["total"] + $order["shipping_price"] - $order["coupon_value"];
            if($order["amount"] < 0){
                $order["amount"] = 0;
            }

            $orderNew = Order::create($order);
            foreach($orderDetails as $key => $orderDetail){
                $orderDetails[$key]["order_id"] = $orderNew->id;
            }
            OrderDetail::insert($orderDetails);
            DB::commit();
            if(!$isLogin){
                session()->put("carts", []);
            }
            else{
                Cart::where("user_id", $userId)->delete();
            }
            if($request->method_payment == "VNPAY"){
                $url = $vnPayService->create($orderNew);
                return redirect($url);
            }
            return redirect()->route("orders.index", ["code" => $orderNew->order_code]);
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return back()->withInput()->with("error", "Vui lòng thử lại sau");
        }
        
    }

    public function update(){
        
    }

}
