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
        "quantity"
    ];

    public function variation(){
        return $this->belongsTo(ProductVariation::class, "id");
    }

    public function variationsCollect(){
        return ProductVariation::where("id", $this->product_variation_id)
            ->with(["ancestors:id,name,value,path"])
            ->first(["id", "name", "value", "product_variation_id"]);
    }

    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'model');
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }

    
    // protected static function newFactory()
    // {
    //     return \Modules\Product\Database\factories\ProductFactory::new();
    // }
}
