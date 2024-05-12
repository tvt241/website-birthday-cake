<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Product\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request){
        $queryCategories = function ($query) use ($request) {
            $query->where("is_active", 1);
            if ($request->category) {
                $query->where("slug", $request->category);
            }
        };
        $query = Product::with("image")->whereRelation("category", $queryCategories)
            ->join("product_items", "products.id", "=", "product_items.product_id")
            ->groupBy("products.id");
        if($request->search){
            $query->where("products.name", "like", "%$request->search%");
        }
        if(isset($request->min) && $request->min <= 0){
            $query->where("product_items.price", ">=", $request->min);
            $query->where("product_items.price", "<=", $request->max);
        }
        $arraySort = ["price-asc", "price-desc", "name-asc", "name-desc"];
        if($request->sort && in_array($request->sort, $arraySort)){
            $sorts = explode("-", $request->sort);
            if($sorts[0] == "price"){
                $sorts[0] = "max_price";
            }
            $query->orderBy($sorts[0], $sorts[1]);
        }
        $products = $query->select("products.*")->paginate(12);
        return view("product::pages.products.index", [
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
        if(!$product->is_active){
            return view("product::pages.products.details", [
                "is_invalid" => false,
            ]);
        }
        $variations = $product->variationsCollect();
        $items = $product->productItems()->with("image:model_id,url")->get(["id", "price", "available", "product_variation_id"]);
        $products = Product::where("category_id", $product->category_id)->where("id", "<>", $product->id)->whereRelation("category", "is_active", 1)->limit(6)->latest()->get();
        
        return view("product::pages.products.details", [
            "is_invalid" => true,
            "product" => $product,
            "variations" => $variations,
            "items" => $items,
            "products" => $products
        ]);
    }
}
