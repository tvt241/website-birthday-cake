<?php

use Illuminate\Support\Facades\Route;
use Modules\Product\Http\Controllers\Api\ProductApiController;
use Modules\Product\Http\Controllers\Api\ProductCategoryApiController;

Route::apiResource("products", ProductApiController::class);
Route::get("categories/get-all", [ProductCategoryApiController::class, "getAll"]);
Route::apiResource("categories", ProductCategoryApiController::class);

