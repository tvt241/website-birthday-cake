<?php

namespace Modules\Order\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Coupon\Models\Coupon;
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
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        if(!auth()->check()){
            $carts = session("carts", []);
            if(!sizeof($carts)){
                return redirect()->route("home");
            }
            return view('order::pages.carts.checkout', [
                "carts" => $carts
            ]);
        }
        $carts = auth()->user()->carts;
        if(!$carts->count()){
            return redirect()->route("home");
        }
        $cartIds = $carts->pluck("product_item_id");
        $cartIdsString = implode(',',array_fill(0, count($cartIds), '?'));
        $productItems = ProductItem::whereIn("id", $cartIds)->with(["image", "product"])->orderByRaw("field(id,{$cartIdsString})", $cartIds)->get();
        foreach($productItems as $key => $item){
            if($item->quantity < $carts[$key]->quantity){
                $carts[$key]->quantity = $item->quantity;
            }
            $carts[$key]->price = $item->price;
            $carts[$key]->name = $item->product->name;
            $variationInfo = $item->variationsCollect();
            $variation = [];
            if($variationInfo->name != "default"){
                $variation[] = (object)[
                    "name" => $variationInfo->name,
                    "value" => $variationInfo->value
                ];
                if($variationInfo->ancestors->count()){
                    foreach($variationInfo->ancestors as $variationParent){
                        $variation[] = (object)[
                            "name" => $variationParent->name,
                            "value" => $variationParent->value
                        ];
                    }
                }
            }
            $carts[$key]->variation = $variation;
        }
        return view('order::pages.carts.checkout', [
            "carts" => $carts
        ]);
    }

    public function store(StoreCheckoutRequest $request, PaymentVnPayService $vnPayService)
    {
        $order = $request->validated();
        $address = "$request->ward_name, $request->district_name, $request->province_name";
        $order["address"] = $address;
        $order["order_code"] = renderOrderCode();
        $order["order_type"] = OrderTypeEnum::BOOKING;
        $order["order_channel"] = OrderChannelEnum::WEB;
        if($request->email){
            $order["email"] = $request->email;
        }

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
        $order["payment_method"] = PaymentMethodEnum::getValue($request->method_payment);
        $isLogin = auth()->check();
        if(!$isLogin){
            $carts = session("carts");
            $order["total"] = getPriceCart($carts, "");
            $order["amount"] = $order["total"] + $order["shipping_price"] + $order["coupon_value"];
            $orderDetails = [];
            foreach($carts as $key => $cart){
                $orderDetails[$key]["name"] = $cart->name;
                $orderDetails[$key]["slug"] = $cart->slug;
                $orderDetails[$key]["image"] = $cart->image;
                $orderDetails[$key]["price"] = $cart->price;
                $orderDetails[$key]["quantity"] = $cart->quantity;
                $orderDetails[$key]["product_item_id"] = $cart->product_item_id;
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
        else{
            $userId = auth()->id();
            $carts = auth()->user()->getCartFormat();
            $order["user_id"] = $userId;
            $order["total"] = $carts->sum("total_price");
            $order["amount"] = $order["total"] + $order["shipping_price"] + $order["coupon_value"];
            $orderDetails = [];
            foreach($carts as $key => $cart){
                $product = Product::find($cart->product_id);

                $orderDetails[$key]["name"] = $product->name;
                $orderDetails[$key]["slug"] = $product->slug;
                $orderDetails[$key]["image"] = $product->image?->url;

                $orderDetails[$key]["price"] = $cart->price;
                $orderDetails[$key]["quantity"] = $cart->quantity;

                $orderDetails[$key]["product_item_id"] = $cart->product_item_id;
                
                // $orderDetails[$key]["order_id"] = $orderNew->id;
                $string = "";
                $variation = ProductVariation::find($cart->product_variation_id);
                if($variation->name == "default"){
                    $orderDetails[$key]["info"] = $string;
                }
                else{
                    $string = "{$variation->name}: {$variation->value}";
                    $ancestors = $variation->ancestors;
                    if($ancestors->count()){
                        foreach($ancestors as $variation){
                            $string = "{$variation->name}: {$variation->value}, " . $string;
                        }
                    }
                    $orderDetails[$key]["info"] = $string;
                }
            }
        }
        DB::beginTransaction();
        try {
            $orderNew = Order::create($order);
            foreach($orderDetails as $key => $order){
                $orderDetails[$key]["order_id"] = $orderNew->id;
                $productItem =  ProductItem::find($order["product_item_id"]);
                if($productItem->quantity < $order["quantity"]){
                    DB::rollBack();
                    return redirect()->route("carts.index")->with("error", "Một vài sản phẩm đã hết hàng");
                }
                // $productItem->update(["quantity" => $productItem->quantity - $order["quantity"]]);
            }
            OrderDetail::insert($orderDetails);
            if(!$isLogin){
                session()->put("carts", []);
            }
            else{
                Cart::where("user_id", $userId)->delete();
            }
            DB::commit();
            if($request->method_payment == "VNPAY"){
                return $vnPayService->create($orderNew);
            }
            return redirect()->route("orders.index", ["code" => $orderNew->order_code]);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with("error", "Vui lòng thử lại sau");
        }
        
    }

    public function update(){
        
    }

}
