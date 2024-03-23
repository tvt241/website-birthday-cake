<?php

namespace Modules\Product\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use \Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

class ProductVariation extends Model
{
    use HasFactory, HasRecursiveRelationships;

    protected $fillable = [];

    public function getParentKeyName()
    {
        return 'product_attribute_id';
    }
    
    // protected static function newFactory()
    // {
    //     return \Modules\Product\Database\factories\ProductVariationFactory::new();
    // }
}
