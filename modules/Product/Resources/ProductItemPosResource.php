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
        $product = $this->product;
        $variation = $this->variationsCollect();

        return [
            "id" => $this->id,
            "name" => $product->name,
            "slug" => $product->slug,
            "price" => $this->price,
            "available" => $this->available,
            "image" => $this->image?->url,
            "variation" => ""
        ];
    }
}
