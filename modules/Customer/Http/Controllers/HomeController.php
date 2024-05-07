<?php

namespace Modules\Customer\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Banner\Models\Banner;
use Modules\Customer\Http\Requests\StoreContactRequest;
use Modules\Customer\Models\Contact;
use Modules\Post\Models\Post;
use Modules\Product\Models\Product;

class HomeController extends Controller
{
    public function index(){
        $banners = Banner::where("is_active", 1)->with("image")->orderBy("order")->get();

        $productNews = Product::whereRelation("category", "is_active", 1)->with("image:model_id,url")->where("is_active", 1)->latest()->limit(12)->get();

        $productBestSales = Product::query()
            ->join("product_items", "product_items.product_id", "=", "products.id")
            ->join("order_details", "order_details.product_item_id", "=", "product_items.id")
            ->whereRelation("category", "is_active", 1)
            ->with("image:model_id,url")
            ->where("is_active", 1)
            ->groupBy("products.id")
            ->limit(12)->get(["products.*"]);
        $productBestSalesCount = $productBestSales->count();
        if($productBestSalesCount < 12){
            $productBestSalesNew = $productNews->slice(0, 12 - $productBestSalesCount);
            $productBestSales = $productBestSales->concat($productBestSalesNew);
        }
        
        $post_news = Post::whereRelation("category", "is_active", 1)->with("image:model_id,url")->where("is_active", 1)->latest()->limit(6)->get();
        return view("customer::pages.home", [
            "product_news" => $productNews,
            "product_best_sales" => $productBestSales,
            "post_news" => $post_news,
            "banners" => $banners,
        ]);
    }

    public function contact(){
        return view("customer::pages.contact");
    }

    public function storeContact(StoreContactRequest $request){
        Contact::create($request->validated());
        return back()->with("success", "Cảm ơn bạn đã liên hệ");
    }

    public function aboutUs(){
        return view("customer::pages.contact");
    }
}
