<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Coupon\Http\Controllers\Api\CouponApiController;

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
    Route::apiResource("coupons", CouponApiController::class);
    Route::post("coupons/check", [CouponApiController::class, "check"])->name("coupons.check");
});
