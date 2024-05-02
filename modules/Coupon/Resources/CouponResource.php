<?php

namespace Modules\Coupon\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Coupon\Enums\CouponStatusEnum;

class CouponResource extends JsonResource
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
            "code" => $this->code,
            "name" => $this->name,
            "quantity" => $this->quantity,
            "available" => $this->available,
            "budget" => $this->budget,
            "is_active" => $this->is_active,
            "active_name" => CouponStatusEnum::getKey($this->is_active),
            "date_start" => $this->date_start->format("H:i m/d/y"),
            "date_end" => $this->date_end->format("H:i m/d/y"),
        ];
    }
}
