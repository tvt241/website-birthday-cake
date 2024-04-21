<?php

namespace Modules\Product\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use \Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;


class ProductVariation extends Model
{
    use HasFactory, HasRecursiveRelationships;

    protected $fillable = [
        "id",
        "name",
        "product_id",
        "product_variation_id",
        "value",
        "price_import",
        "price",
        "type_sell",
        "value_sell",
        "quantity_sell",
        "time_sell",
    ];

    public function getParentKeyName()
    {
        return 'product_variation_id';
    }

    public function scopeJoinProductItemWithImage($query){
        return $query
            ->leftJoin("product_items", function ($join) {
                $join->on("laravel_cte.id", "=", "product_items.product_variation_id")
            ->leftJoin("images", function ($join) {
                $join->on("product_items.id", "=", "images.model_id")
                    ->where("images.model_type", ProductItem::class);
            });
        });
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }

    // protected static function newFactory()
    // {
    //     return \Modules\Product\Database\factories\ProductVariationFactory::new();
    // }
}
