<?php

namespace Modules\Banner\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BannerResource extends JsonResource
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
            "title" => $this->title,
            "url" => $this->url,
            "order" => $this->order,
            "image" => $this->image?->url,
            "desc" => $this->desc,
            "is_active" => $this->is_active,
        ];
    }
}
