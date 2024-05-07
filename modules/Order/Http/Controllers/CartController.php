<?php

namespace Modules\Order\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Order\Models\Cart;
use Modules\Order\Services\PaymentService\VnPayService;
use Modules\Product\Models\ProductItem;
use PDO;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        if(!auth()->check()){
            $carts = session("carts", []);
            if(empty($carts)){
                return view("order::pages.carts.details",[
                    "carts" => $carts
                ]);
            }
            $cartTemp = [];
            foreach($carts as  $key => $cart){
                $productItem = ProductItem::find($cart->product_item_id);
                if($productItem->available < $carts[$key]->quantity){
                    $carts[$key]->quantity = $productItem->available;
                }
                $product = $productItem->product;
                $cartTemp[$key] = $cart;
                $cartTemp[$key]->name = $product->name;
                $cartTemp[$key]->slug = $product->slug;
                $cartTemp[$key]->info = $productItem->variation_full_string;
                $cartTemp[$key]->image = $cartTemp[$key]->info ? $productItem->image?->url : $product->image?->url;
                $cartTemp[$key]->price = $productItem->price;
                $cartTemp[$key]->max_quantity = $productItem->available;
            }
            session()->put("carts", $carts);
            return view("order::pages.carts.details",[
                "carts" => $cartTemp
            ]);
        }

        $carts = auth()->user()->carts;
        if(!$carts->count()){
            return view("order::pages.carts.details",[
                "carts" => $carts
            ]);
        }
        $cartTemp = [];
        foreach($carts as $key => $cart){
            $productItem = ProductItem::find($cart->product_item_id);
            if($productItem->available < $carts[$key]->quantity){
                $carts[$key]->quantity = $productItem->available;
                $cart->save();
            }
            $product = $productItem->product;
            $cartTemp[$key] = $cart;
            $cartTemp[$key]->name = $product->name;
            $cartTemp[$key]->slug = $product->slug;
            $cartTemp[$key]->info = $productItem->variation_full_string;
            $cartTemp[$key]->image = $cartTemp[$key]->info ? $productItem->image?->url : $product->image?->url;
            $cartTemp[$key]->price = $productItem->price;
            $cartTemp[$key]->max_quantity = $productItem->available;
        }
        
        return view("order::pages.carts.details",[
            "carts" => $carts
        ]);
    }

}
