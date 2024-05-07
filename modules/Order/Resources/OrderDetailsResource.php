<?php

namespace Modules\Order\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Order\Enums\OrderChannelEnum;
use Modules\Order\Enums\OrderStatusEnum;
use Modules\Order\Enums\OrderTypeEnum;
use Modules\Order\Enums\PaymentMethodEnum;
use Modules\Order\Enums\PaymentStatusEnum;

class OrderDetailsResource extends JsonResource
{

    public function toArray($request)
    {
        $dateComplete = null;
        if($this->status >= OrderStatusEnum::START_ORDER_COMPLETE && $this->status <= OrderStatusEnum::END_ORDER_COMPLETE ){
            $dateComplete = $this->updated_at->format("H:i d-m-Y");
        }
        return [
            "id" => $this->id,
            "order_code" => $this->order_code,
            "customer_name" => $this->customer ? $this->customer->name : "Khách lẻ",
            "order_type" => OrderTypeEnum::getKey($this->order_type),
            "order_channel" => OrderChannelEnum::getKey($this->order_channel),
            "payment_method" => PaymentMethodEnum::getKey($this->payment_method),
            "payment_method_id" => $this->payment_method,
            "payment_status" => PaymentStatusEnum::getKey($this->payment_status),
            "payment_status_id" => $this->payment_status,
            "status" => OrderStatusEnum::getKey($this->status),
            "status_id" => $this->status,
            "total" => $this->total,
            "shipping_price" => $this->shipping_price,
            "coupon_value" => $this->coupon_value,
            "note" => $this->note,
            "phone" => $this->phone,
            "email" => $this->email,
            "name" => $this->name,
            "address" => $this->address,
            "address2" => $this->address2,
            "created_at" => $this->created_at->format("H:i d-m-Y"),
            "amount" => $this->amount,
            "completed_at" => $dateComplete,
            "details" => $this->orderDetails
        ];
    }
}
