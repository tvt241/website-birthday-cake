<?php

namespace Modules\Product\Observers;

use Illuminate\Support\Facades\Cache;
use Modules\Product\Models\ProductCategory;

class ProductCategoryObserver
{
    public function created(ProductCategory $productCategory){
        Cache::delete("categories");
    }

    public function updated(ProductCategory $productCategory){
        Cache::delete("categories");
    }

    public function deleted(ProductCategory $productCategory){
        Cache::delete("categories");
    }

}
