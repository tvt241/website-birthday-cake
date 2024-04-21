<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Product\Models\Product;

class ProductController extends Controller
{
    public function index(){
        $products = Product::inValidByCategory()->with("image")->paginate();
        return view("pages.products.index", [
            "products" => $products,
        ]);
    }

    public function showBySlug(Request $request, $slug){
        $product = Product::inValidByCategory()->with("image:model_id,url")->where("slug", $slug)->first();
        if(!$product){
            return view("product::pages.products.details", [
                "is_invalid" => false,
            ]);
        }
        $variations = $product->variationsCollect();
        $items = $product->productItems()->with("image:model_id,url")->get(["id", "price", "quantity", "product_variation_id"]);
        return view("product::pages.products.details", [
            "is_invalid" => true,
            "product" => $product,
            "variations" => $variations,
            "items" => $items
        ]);
    }
}
