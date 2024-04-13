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

    public function variations(){
        return $this->hasMany(ProductVariation::class);
    }

    public function category(){
        return $this->belongsTo(ProductCategory::class);
    }

    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'model');
    }

    
    // protected static function newFactory()
    // {
    //     return \Modules\Product\Database\factories\ProductFactory::new();
    // }
}
