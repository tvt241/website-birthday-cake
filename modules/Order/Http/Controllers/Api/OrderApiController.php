<?php

namespace Modules\Order\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Core\Traits\ResponseTrait;
use Modules\Order\Enums\OrderStatusEnum;
use Modules\Order\Enums\OrderTypeEnum;
use Modules\Order\Enums\PaymentMethodEnum;
use Modules\Order\Enums\PaymentStatusEnum;
use Modules\Order\Models\Order;
use Modules\Order\Resources\OrderDetailsResource;
use Modules\Order\Resources\OrderResource;
use Modules\Product\Models\ProductItem;

class OrderApiController extends Controller
{
    use ResponseTrait;

    public function index(){
        $query = Order::query();
        $orders = $query->paginate();
        $newItems = $orders->getCollection()->map(function ($order) {
            return new OrderResource($order);
        });
        $orders->setCollection($newItems);
        return $this->SuccessResponse($orders);
    }

    public function store(Request $request){
        
    }

    public function show(Request $request, $id){
        $order = Order::with("orderDetails")->find($id);
        if(!$order){
            return $this->ErrorResponse(message: __("No Results Found."), status_code: 422);
        }
        return $this->SuccessResponse(new OrderDetailsResource($order));
    }

    public function update(Request $request, $id){
        $order = Order::find($id);
        if(!$order){
            return $this->ErrorResponse(message: __("No Results Found."), status_code: 422);
        }
        $order->update([]);
        return $this->SuccessResponse();
    }

    public function delete(Request $request, $id){
        $order = Order::find($id);
        if(!$order){
            return $this->ErrorResponse(message: __("No Results Found."), status_code: 422);
        }
        $order->delete();
        return $this->SuccessResponse();
    }

    public function keys(Request $request){
        $key = $request->key;
        switch ($key) {
            case 'OrderStatusEnum':
                $enums = OrderStatusEnum::getValues();
                break;
            case 'OrderTypeEnum':
                $enums = OrderTypeEnum::getValues();
                break;
            case 'PaymentMethodEnum':
                $enums = PaymentMethodEnum::getValues();
                break;
            case 'PaymentStatusEnum':
                $enums = PaymentStatusEnum::getValues();
                break;
            default:
                $enums = [];
                break;
        }
        return $this->SuccessResponse($enums);
    }
}
