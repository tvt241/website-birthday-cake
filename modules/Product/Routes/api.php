<?php

use Illuminate\Support\Facades\Route;
use Modules\Product\Http\Controllers\Api\ProductApiController;
use Modules\Product\Http\Controllers\Api\ProductCategoryApiController;
use Modules\Product\Models\Product;

Route::apiResource("products", ProductApiController::class);
Route::get("categories/get-all", [ProductCategoryApiController::class, "getAll"]);
Route::apiResource("categories", ProductCategoryApiController::class);


Route::get("test", function(){
    $product = Product::find(2);
    return response()->json([
        "data" => $product->variationsCollect()
    ]);
});