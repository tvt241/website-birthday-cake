<?php

namespace Modules\Product\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Modules\Core\Models\Image;
use Modules\Core\Models\Traits\CategoryTrait;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Product extends Model
{
    use HasFactory, CategoryTrait;

    protected $fillable = [
        "id",
        "name",
        "slug",
        "desc",
        "desc_sort",
        "min_price",
        "max_price",
        "category_id",
        "is_active"
    ];

    public function variationsCollectFull()
    {
        $variations = ProductVariation::where("laravel_cte.product_id", $this->id)->tree()
            ->joinProductItemWithImage()
            ->get([
                "laravel_cte.id",
                "laravel_cte.name",
                "laravel_cte.value",
                "laravel_cte.product_variation_id",
                "laravel_cte.depth",
                "laravel_cte.path",
                "images.url as image",
                "product_items.price_import",
                "product_items.available",
                "product_items.price",
                "product_items.quantity",
            ]);
        return $variations->toTree();
    }

    public function variationsCollect()
    {
        $variations = ProductVariation::where("laravel_cte.product_id", $this->id)->tree()
            ->joinProductItemWithImage()
            ->get([
                "laravel_cte.id",
                "laravel_cte.name",
                "laravel_cte.value",
                "laravel_cte.product_variation_id",
                "laravel_cte.depth",
                "laravel_cte.path",
                "images.url as image",
                "product_items.id as product_item_id",
                "product_items.price",
                "product_items.available",
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

    public function price() :  Attribute
    {
        return Attribute::make(
            get: function ($value){
                if($this->min_price > 0){
                    return formatCurrency($this->min_price) . " - " . formatCurrency($this->max_price);
                }
                return formatCurrency($this->max_price);
            },
        );
    }
    
    // protected static function newFactory()
    // {
    //     return \Modules\Product\Database\factories\ProductFactory::new();
    // }
}
