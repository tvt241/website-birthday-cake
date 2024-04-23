<?php

use Illuminate\Support\Facades\Route;
use Modules\Product\Http\Controllers\Api\ProductApiController;
use Modules\Product\Http\Controllers\Api\ProductCategoryApiController;
use Modules\Product\Http\Controllers\Api\ProductItemApiController;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductItem;

// Route::group(["middleware" => "auth:api"], function(){
    
// });

Route::get("products/items", [ProductItemApiController::class, "index"]);
Route::put("products/{id}/change-active", [ProductApiController::class, "changeActive"]);
Route::apiResource("products", ProductApiController::class);
Route::get("categories/get-all", [ProductCategoryApiController::class, "getAll"]);
Route::put("categories/{id}/change-active", [ProductCategoryApiController::class, "changeActive"]);
Route::apiResource("categories", ProductCategoryApiController::class);