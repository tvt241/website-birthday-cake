<?php

namespace Modules\Product\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Product\Database\Factories\ProductCategoryFactory;
use \Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

class ProductCategory extends Model
{
    use HasFactory, HasRecursiveRelationships;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        "name",
        "slug",
        "category_id"
    ];

    public function getParentKeyName()
    {
        return 'category_id';
    }

    protected static function newFactory(): Factory
    {
        return ProductCategoryFactory::new();
    }
}