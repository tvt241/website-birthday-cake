<?php

namespace Modules\Core\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Modules\Customer\Enums\CustomerStatusEnum;
use Modules\Product\Models\ProductCategory;
use Modules\Product\Models\ProductItem;
use Modules\Setting\Models\BusinessSetting;

class CoreMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $categories = cache("categories");
        if(!$categories){
            $categories = ProductCategory::treeOf(function($query) {
                $query->where("is_active", 1)->whereNull("category_id");
            })
            ->leftJoin("images", function ($join) {
                $join->on("laravel_cte.id", "=", "images.model_id")
                    ->where("images.model_type", ProductCategory::class);
            })
            ->get([
                "laravel_cte.id",
                "laravel_cte.name",
                "laravel_cte.slug",
                "laravel_cte.category_id",
                "laravel_cte.depth",
                "laravel_cte.is_active",
                "laravel_cte.description",
                "images.url as image"
            ])->toTree();
            cache(["categories" => $categories], now()->addDay());
        }

        View::share("categories", $categories);


        $company = cache("company");
        if(!$company){
            $companySetup = BusinessSetting::where("group", "company")->get();
            foreach($companySetup as $setup){
                $company[$setup->key] = $setup->value;
            }
            cache(["company" => $company], now()->addYear());
        }

        View::share("company", $company);

        $social = cache("social_media");
        if(!$social){
            $socialSetup = BusinessSetting::where("group", "social_media")->whereNotNull("value")->get();
            foreach($socialSetup as $setup){
                $social[$setup->key] = $setup->value;
            }
            cache(["social_media" => $social], now()->addMonth());
        }
        View::share("social_media", $social);
        
        if(!auth()->check()){
            $carts = session("carts", []);
            $cartsPrice = 0;

            if(sizeof($carts)){
                foreach($carts as $key => $cart){
                    $productItem = ProductItem::find($cart->product_item_id);
                    if(!$productItem){
                        array_splice($carts, $key, 1);
                        continue;
                    }
                    if($productItem->available == 0){
                        array_splice($carts, $key, 1);
                        continue;
                    }
                    if($carts[$key]->quantity >= $productItem->available)
                    {
                        $carts[$key]->quantity = $productItem->available;
                    }
                    $cartsPrice += $productItem->price * $carts[$key]->quantity;
                }
                session()->put("carts", $carts);
            }
            $cartsPrice = formatCurrency($cartsPrice);
            $cartsQuantity = sizeof($carts);

            View::share("carts_quantity", $cartsQuantity);
            View::share("carts_price", $cartsPrice);
            return $next($request);
        }
        $user = auth()->user();
        if($user->is_active == CustomerStatusEnum::BLOCK->value){
            Auth::logout();
            return redirect()->route("login");
        }
        $carts = $user->carts;
        $cartsQuantity = $carts->count();
        $cartsPrice = 0;
        if(sizeof($carts)){
            foreach($carts as $key => $cart){
                $productItem = ProductItem::find($cart->product_item_id);
                if(!$productItem){
                    $cart->delete();
                    continue;
                }
                if($productItem->available == 0){
                    $cart->delete();
                    continue;
                }
                if($carts[$key]->quantity >= $productItem->available)
                {
                    $carts[$key]->quantity = $productItem->available;
                    $cart->save();
                }
                $cartsPrice += $productItem->price * $carts[$key]->quantity;
            }
        }
        $cartsPrice = formatCurrency($cartsPrice);

        View::share("carts_quantity", $cartsQuantity);
        View::share("carts_price", $cartsPrice);
        return $next($request);
    }
}
