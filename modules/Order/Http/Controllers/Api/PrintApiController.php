<?php

namespace Modules\Order\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Core\Traits\ResponseTrait;
use Modules\Order\Models\Order;
use Modules\Order\Services\Shipping\ShippingGhnService;

class PrintApiController extends Controller
{
    use ResponseTrait;
    public function invoice(Request $request)
    {
        $pageType = $request->get("page-type");
        $orderCode = $request->code;
        $order = Order::where("order_code", $orderCode)->first();
        if(!$order){
            return $this->ErrorResponse("Mã đơn hàng không đúng");
        }
        $invoice = null;
        switch ($pageType) {
            case 'K80':
                $invoice = view("order::invoice.K80", [
                    "order" => $order
                ])->render();
                break;
            default:
                $invoice = view("order::invoice.K80-mini", [
                    "order" => $order
                ])->render();
                break;
        }
        $data = [
            "invoice" => $invoice
        ];
        return $this->SuccessResponse($data);
    }

}
