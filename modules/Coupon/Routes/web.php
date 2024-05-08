<?php
use Illuminate\Support\Facades\Route;
use Modules\Coupon\Http\Controllers\CouponController;

Route::post("coupons/check", [CouponController::class, "check"])->name("coupons.check");