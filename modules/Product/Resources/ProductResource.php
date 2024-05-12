<?php

namespace Modules\Product\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $productItem = $this->productItems;
        return [
            "id" => $this->id,
            "name" => $this->name,
            "slug" => $this->slug,
            "is_active" => $this->is_active,
            "min_price" => $this->min_price,
            "max_price" => $this->max_price,
            "category_name" => $this->category->name,
            "quantity" => $productItem->sum("quantity"),
            "available" => $productItem->sum("available"),
            "image" => $this->image?->url,
        ];
    }
}
