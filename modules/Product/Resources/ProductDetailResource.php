<?php

namespace Modules\Product\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Product\Enums\ProductStatusEnum;
use Modules\Product\Models\ProductItem;

class ProductDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $category = $this->category;
        $productItems = $this->productItems;
        return [
            "id" => $this->id,
            "name" => $this->name,
            "slug" => $this->slug,
            "active_name" => ProductStatusEnum::getKey($this->is_active),
            "is_active" => $this->is_active,
            "min_price" => $this->min_price,
            "max_price" => $this->max_price,
            "category_id" => $category->id,
            "category_name" => $category->name,
            "quantity" => $productItems->sum("quantity"),
            "available" => $productItems->sum("available"),
            "image" => $this->image?->url,
            "desc_sort" => $this->desc_sort,
            "desc" => $this->desc,
            "product_items" => ProductItemResource::collection($this->productItems)
        ];
    }
}
