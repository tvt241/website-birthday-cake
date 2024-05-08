<?php

namespace Modules\Coupon\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Coupon\Enums\CouponStatusEnum;

class CouponDetailsResource extends JsonResource
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
            "discount_value" => $this->discount_value,
            "discount_type" => $this->discount_type,
            "discount_max" => $this->discount_max,
            "limit_per_user" => $this->limit_per_user,
            "desc" => $this->desc,
            "budget" => $this->budget,
            "budget_available" => $this->budget_available,
            "is_active" => $this->is_active,
            "active_name" => CouponStatusEnum::getKey($this->is_active),
            "date_start" => $this->date_start->format("Y-m-d\TH:i"),
            "date_end" => $this->date_end->format("Y-m-d\TH:i"),
            "created_at" => $this->created_at->format("Y-m-d\TH:i"),
            "orders" => CouponOrderResource::collection($this->orders)
        ];
    }
}
