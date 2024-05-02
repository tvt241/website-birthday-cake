<?php

namespace Modules\Customer\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Customer\Http\Requests\StoreContactRequest;
use Modules\Customer\Models\Contact;
use Modules\Post\Models\Post;
use Modules\Product\Models\Product;

class HomeController extends Controller
{
    public function index(){
        $newProducts = Product::whereRelation("category", "is_active", 1)->with("image:model_id,url")->where("is_active", 1)->latest()->limit(12)->get();
        $newPosts = Post::whereRelation("category", "is_active", 1)->with("image:model_id,url")->where("is_active", 1)->latest()->limit(6)->get();
        return view("customer::pages.home", [
            "new_products" => $newProducts,
            "new_posts" => $newPosts,
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
