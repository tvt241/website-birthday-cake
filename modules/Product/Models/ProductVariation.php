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

    // protected static function newFactory()
    // {
    //     return \Modules\Product\Database\factories\ProductVariationFactory::new();
    // }
}
