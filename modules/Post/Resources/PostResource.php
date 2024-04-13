<?php

namespace Modules\Post\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            "name" => $this->name,
            "slug" => $this->slug,
            "is_active" => $this->is_active,
            "category_name" => $this->category->name,
            "image" => $this->image?->url,
            "desc_sort" => $this->desc_sort,
            "desc" => $this->desc,
        ];
    }
}
