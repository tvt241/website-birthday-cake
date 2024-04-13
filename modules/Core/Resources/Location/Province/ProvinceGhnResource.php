<?php

namespace Modules\Core\Resources\Location\Province;

use Illuminate\Http\Resources\Json\JsonResource;

class ProvinceGhnResource extends JsonResource
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
            "id" => $this->ProvinceID,
            "name" => $this->ProvinceName
        ];
    }
}
