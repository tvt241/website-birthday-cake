<?php

namespace Modules\Order\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderDetailsResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            "order" => new OrderResource($this),
            "details" => $this->orderDetails
        ];
    }
}
