<?php
use Illuminate\Support\Facades\Route;
use Modules\Order\Http\Controllers\PaymentController;

Route::prefix('orders')->group(function() {
    Route::get('/', 'OrderController@index');
});

Route::post("checkout", [PaymentController::class, "store"])->name("checkout.store");

Route::get("payment", [PaymentController::class, "payment"])->name("checkout.payment");
