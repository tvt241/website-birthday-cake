<?php

namespace Modules\Core\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

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
