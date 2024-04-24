<?php

namespace Modules\Order\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Order\Enums\OrderChannelEnum;
use Modules\Order\Enums\OrderTypeEnum;
use Modules\Order\Enums\PaymentMethodEnum;
use Modules\Order\Enums\PaymentStatusEnum;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "order_code" => $this->order_code,
            "customer_name" => $this->customer ? $this->customer->name : "Khách lẻ",
            "order_type" => OrderTypeEnum::getKey($this->order_type),
            "order_channel" => OrderChannelEnum::getKey($this->order_channel),
            "payment_method" => PaymentMethodEnum::getKey($this->payment_method),
            "payment_status" => PaymentStatusEnum::getKey($this->payment_status),
        ];
    }
}
