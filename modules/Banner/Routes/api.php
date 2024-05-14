<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Banner\Http\Controllers\Api\BannerApiController;

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
Route::group(["middleware" => "auth:api"], function(){
    Route::get("banners/order", [BannerApiController::class, "order"]);
    Route::apiResource("banners", BannerApiController::class);
});