<?php

namespace Modules\Order\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Order\Enums\OrderStatusEnum;
use Modules\Order\Enums\PaymentMethodEnum;
use Modules\Order\Enums\PaymentStatusEnum;

class OrderInfoFullResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "order_code" => $this->order_code,
            "customer_name" => $this->customer ? $this->customer->name : "Khách lẻ",
            "name" => $this->name,
            "address" => $this->address,
            "address2" => $this->address2,
            "phone" => $this->phone,
            "email" => $this->email,
            "coupon_value" => $this->coupon_value,
            "shipping_price" => $this->shipping_price,
            "status" => OrderStatusEnum::getKey($this->status),
            "payment_method" => PaymentMethodEnum::getKey($this->payment_method),
            "payment_status" => PaymentStatusEnum::getKey($this->payment_status),
            "total" => $this->total,
            "amount" => $this->amount,
            "created_at" => $this->created_at->format("h:i m-d-Y"),
            "order_details" => $this->orderDetails,
        ];
    }
}
