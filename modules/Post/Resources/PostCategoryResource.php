<?php

namespace Modules\Post\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PostCategoryResource extends JsonResource
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
            "name" => $this->name,
            "slug" => $this->slug,
            "is_active" => $this->is_active,
            "description" => $this->description
        ];
    }
}
