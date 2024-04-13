<?php

namespace Modules\Core\Resources\Location\Ward;

use Illuminate\Http\Resources\Json\JsonResource;

class WardGhnResource extends JsonResource
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
            "id" => $this->WardCode,
            "name" => $this->WardName
        ];
    }
}
