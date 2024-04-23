<?php

namespace Modules\Setting\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
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
            "service" => $this->group,
            "options" => $this->services,
            "using" => $this->using->value,
            "configs" => ConfigResource::collection($this->configs),
        ];
    }
}
