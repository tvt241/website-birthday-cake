<?php

namespace Modules\Core\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Modules\Product\Models\ProductCategory;
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
        $categories = cache("categories", []);
        if(!sizeof($categories)){
            $categories = ProductCategory::treeOf(function($query) {
                $query->where("is_active", 1);
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
            cache("categories", $categories, now()->addDay());
        }

        View::share("categories", $categories);


        $company = cache("company", []);
        if(!sizeof($company)){
            $companySetup = BusinessSetting::where("group", "company")->get();
            foreach($companySetup as $setup){
                $company[$setup->key] = $setup->value;
            }
            cache("company", $company, now()->addYear());
        }

        View::share("company", $company);

        $social = cache("company", []);
        if(!sizeof($social)){
            $socialSetup = BusinessSetting::where("group", "social_media")->whereNotNull("value")->get();
            foreach($socialSetup as $setup){
                $social[$setup->key] = $setup->value;
            }
            cache("social_media", $social, now()->addMonth());
        }
        View::share("social_media", $social);

        if(!auth()->check()){
            $carts = session("carts", []);
            $cartsQuantity = sizeof($carts);
            $cartsPrice = getPriceCart($carts);
        }
        else {
            $carts = auth()->user()->getCartPrice();
            $cartsQuantity = $carts->count();
            $cartsPrice = formatCurrency($carts->sum("total_price"));
        }

        View::share("carts_quantity", $cartsQuantity);
        View::share("carts_price", $cartsPrice);

        return $next($request);
    }
}
