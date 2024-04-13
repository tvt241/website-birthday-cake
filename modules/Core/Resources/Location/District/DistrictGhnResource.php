<?php

namespace Modules\Core\Resources\Location\District;

use Illuminate\Http\Resources\Json\JsonResource;

class DistrictGhnResource extends JsonResource
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
            "id" => $this->DistrictID,
            "name" => $this->DistrictName
        ];
    }
}
