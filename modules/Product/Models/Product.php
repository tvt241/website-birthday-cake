<?php

namespace Modules\Product\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Modules\Core\Models\Image;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        "id",
        "name",
        "slug",
        "desc",
        "desc_sort",
        "category_id",
        "is_active"
    ];

    public function variationsCollect()
    {
        $variations = ProductVariation::where("laravel_cte.product_id", $this->id)->tree()
            ->leftJoin("product_items", function ($join) {
                $join->on("laravel_cte.id", "=", "product_items.product_variation_id");
            })
            ->leftJoin("images", function ($join) {
                $join->on("product_items.id", "=", "images.model_id")
                    ->where("images.model_type", ProductItem::class);
            })
            ->get([
                "laravel_cte.id",
                "laravel_cte.name",
                "laravel_cte.value",
                "laravel_cte.product_variation_id",
                "laravel_cte.depth",
                "laravel_cte.path",
                "images.url as image",
                "product_items.price_import",
                "product_items.price",
                "product_items.quantity",
            ]);
        return $variations->toTree();
    }

    public function variations(){
        return $this->hasMany(ProductVariation::class);
    }

    public function productItems(){
        return $this->hasMany(ProductItem::class);
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
