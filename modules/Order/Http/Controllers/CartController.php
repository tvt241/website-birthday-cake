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
            $cartIds = collect($carts)->pluck("product_item_id");
            $cartIdsString = implode(',',array_fill(0, count($cartIds), '?'));
            $productItems = ProductItem::whereIn("id", $cartIds)->with(["image", "product"])->orderByRaw("field(id,{$cartIdsString})", $cartIds)->get();   
            foreach($productItems as $key => $item){
                if($item->quantity < $carts[$key]->quantity){
                    $carts[$key]->quantity = $item->quantity;
                }
                $carts[$key]->price = $item->price;
                $carts[$key]->max_quantity = $item->quantity;
            }
            session()->put("carts", $carts);
        }
        else{
            $carts = auth()->user()->carts;
            if(!$carts->count()){
                return view("order::pages.carts.details",[
                    "carts" => $carts
                ]);
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
                $carts[$key]->slug = $item->product->slug;
                $carts[$key]->image = $item->image?->url;

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

        }
        return view("order::pages.carts.details",[
            "carts" => $carts
        ]);
    }

}
