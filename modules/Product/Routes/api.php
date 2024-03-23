<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Product\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/product', function (Request $request) {
    return $request->user();
});

// Route::group(["prefix" => "products", "as" => "products."], function(){
//     Route::get("", [ProductController::class, "index"]);
//     Route::post("store", [ProductController::class, "store"]);
//     Route::get("{id}", [ProductController::class, "show"]);
//     Route::put("{id}", [ProductController::class, "update"]);
//     Route::delete("{id}", [ProductController::class, "destroy"]);
// });

Route::apiResource("products", ProductController::class);
