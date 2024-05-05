<?php

namespace Modules\Product\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Picqer\Barcode\BarcodeGenerator;
use Picqer\Barcode\BarcodeGeneratorHTML;

class ProductItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $generator = new BarcodeGeneratorHTML();
        return [
            "id" => $this->id,
            "price_import" => $this->price_import,
            "price" => $this->price,
            "quantity" => $this->quantity,
            "available" => $this->available,
            // "barcode" => $generator->getBarcode($this->barcode, BarcodeGenerator::TYPE_CODE_128, 1),
            "barcode" => $this->barcode,
            "image" => $this->image?->url,
            "variation" => $this->variationsCollect()
        ];
    }
}
