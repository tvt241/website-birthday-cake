<?php

namespace Modules\Product\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Modules\Core\Models\Image;
use Illuminate\Database\Eloquent\Casts\Attribute;

class ProductItem extends Model
{
    use HasFactory;

    protected $fillable = [
        "id",
        "product_id",
        "product_variation_id",
        "value",
        "price_import",
        "price",
        "quantity",
        "barcode",
        "available"
    ];

    public function genBarCode(){
        $productItemId = (string)$this->id;
        $barcode = env("BARCODE_LOCALE") . env("BARCODE_COMPANY_CODE") . str_pad($productItemId, 5, "0", STR_PAD_LEFT);
        $totalOld = 0;
        $totalEvent = 0;
        for($i = 0; $i < strlen($barcode); $i++){
            if($i % 2 == 0){
                $totalEvent += (int)$barcode[$i];
                continue;
            }
            $totalOld += (int)$barcode[$i];
        }
        $total = $totalEvent * 3 + $totalOld;
        $checkDigit = ($total % 10 != 0) ? 10 - ($total % 10) : 0;
        return $barcode . $checkDigit;
    }

    public function variation(){
        return $this->belongsTo(ProductVariation::class, "id");
    }

    public function variationsCollect(){
        return ProductVariation::where("id", $this->product_variation_id)
            ->with(["ancestors:id,name,value,path"])
            ->first(["id", "name", "value", "product_variation_id"]);
    }

    public function variationsToArray()
    {
        $variation = $this->variationsCollect();
        if($variation->name == "default"){
            return null;
        }
        $variations = [
            [
                "name" => $variation->name,
                "value" => $variation->value,
            ]
        ];
        if($variation->ancestors->count()){
            foreach($variation->ancestors as $variation_parent){
                array_unshift($variations, [
                    "name" => $variation_parent->name,
                    "value" => $variation_parent->value,
                ]);
            }
        }
        return $variations;
    }

    public function variationString() : Attribute
    {
        $variations = $this->variationsToArray();
        $variationString = "";
        if($variations){
            foreach($variations as $key => $variation){
                $variationString .= $variation['value'];
                if($key != sizeof($variations) - 1){
                    $variationString .= ", ";
                }
            }
        }
        return Attribute::make(
            get: fn () => $variationString,
        );
    }

    public function variationFullString() : Attribute
    {
        $variations = $this->variationsToArray();
        $variationString = "";
        if($variations){
            foreach($variations as $key => $variation){
                $variationString .= $variation['name'] . ": " . $variation['value'];
                if($key != sizeof($variations) - 1){
                    $variationString .= ", ";
                }
            }
        }
        return Attribute::make(
            get: fn () => $variationString,
        );
    }

    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'model');
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
