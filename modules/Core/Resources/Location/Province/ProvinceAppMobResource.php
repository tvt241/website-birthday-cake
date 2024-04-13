<?php

namespace Modules\Core\Resources\Location\Province;

use Illuminate\Http\Resources\Json\JsonResource;

class ProvinceAppMobResource extends JsonResource
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
            "id" => $this->province_id,
            "name" => $this->province_name
        ];
    }
}
