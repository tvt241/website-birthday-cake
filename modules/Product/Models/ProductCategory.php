<?php

namespace Modules\Product\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Product\Database\Factories\ProductCategoryFactory;
use \Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Modules\Core\Models\Image;

class ProductCategory extends Model
{
    use HasFactory, HasRecursiveRelationships;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        "id",
        "name",
        "slug",
        "category_id"
    ];

    public function getParentKeyName()
    {
        return 'category_id';
    }
    
    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'model');
    }

    protected static function newFactory(): Factory
    {
        return ProductCategoryFactory::new();
    }
}
