<?php

namespace Modules\Core\Resources\Location\Ward;

use Illuminate\Http\Resources\Json\JsonResource;

class WardAppMobResource extends JsonResource
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
            "id" => $this->ward_id,
            "name" => $this->ward_name
        ];
    }
}
