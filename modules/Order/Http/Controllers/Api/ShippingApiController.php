<?php

namespace Modules\Order\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Order\Services\Shipping\ShippingGhnService;

class ShippingApiController extends Controller
{
    protected $iShippingService;
    public function __construct(ShippingGhnService $shippingGhnService)
    {
        $this->iShippingService = $shippingGhnService;
    }
    public function services(Request $request)
    {
        return $this->iShippingService->getServices($request->district_code);
    }

    public function fee(Request $request)
    {
        if(!auth()->check()){
            $carts = session("carts", []);
            $order = [
                "amount" => getPriceCart($carts)
            ];
        }
        return $this->iShippingService->getFee($order, [], $request->district_code, $request->ward_code);
    }

}
