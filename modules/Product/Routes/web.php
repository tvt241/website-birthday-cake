<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Modules\Notification\Services\SendNotification\SendNotificationTelegramService;
use Modules\Product\Http\Controllers\ProductController;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductItem;

Route::get('/products', [ProductController::class, 'index'])->name("products");

Route::get('/products/{slug}', [ProductController::class, "showBySlug"])->name("products.details");

Route::get("test", function(){
    $product = Product::find(18);
    $productItems = $product->productItems;
    $variationsIds = [];
    foreach($productItems as $productItem){
        $variationsIds = array_merge($variationsIds, $productItem->variationIds());
    }
    $variationsIds = array_unique($variationsIds);
    dd($variationsIds);
});