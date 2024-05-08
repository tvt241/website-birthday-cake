<?php

namespace Modules\Product\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Picqer\Barcode\BarcodeGenerator;
use Picqer\Barcode\BarcodeGeneratorHTML;

class ProductItemPosResource extends JsonResource
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
            "price" => $this->price,
            "available" => $this->available,
            "image_url" => $this->product_item_image ? $this->product_item_image : $this->product_image,
            "variation" => $this->variation_string
        ];
    }
}