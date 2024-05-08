<?php

namespace Modules\Coupon\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Coupon\Enums\CouponStatusEnum;

class CouponOrderResource extends JsonResource
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
            "name" => $this->name,
            "order_code" => $this->order_code,
            "coupon_value" => $this->coupon_value,
            "total" => $this->total,
            "amount" => $this->amount,
        ];
    }
}
