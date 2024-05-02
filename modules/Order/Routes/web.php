<?php

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Modules\Order\Http\Controllers\Api\CartApiController;
use Modules\Order\Http\Controllers\Api\ShippingApiController;
use Modules\Order\Http\Controllers\CartController;
use Modules\Order\Http\Controllers\CheckOutController;
use Modules\Order\Http\Controllers\OrderController;
use Modules\Order\Http\Controllers\PaymentController;
use Modules\Order\Models\Cart;

Route::get('/checkout', [CheckOutController::class, "index"])->name("checkout.index");
Route::post("checkout", [CheckOutController::class, "store"])->name("checkout.store");

Route::get("payment", [PaymentController::class, "payment"])->name("payment.index");

Route::prefix('api')->as('api.')->group(function () {
    Route::apiResource("carts", CartApiController::class)->except("show");
});

Route::get('/carts', [CartController::class, 'index'])->name("carts.index");

Route::get("shippings/services", [ShippingApiController::class, "services"])->name("shippings.services");
Route::get("shippings/fee", [ShippingApiController::class, "fee"])->name("shippings.fee");

Route::get('/order-details', [OrderController::class, 'index'])->name("orders.index");
Route::post('/order-details/{order}', [OrderController::class, 'show'])->name("orders.details");

Route::get("test", function(){
    $subQuery = DB::table('product_items')
        ->select('id', 'price', "quantity", "product_variation_id");

    $carts = Cart::query()->where("user_id", auth()->id())
    ->select(DB::raw("pItemSub.price * carts.quantity as total_price"))
    ->joinSub($subQuery, 'pItemSub', function ($join) {
        $join->on('pItemSub.id', '=', 'carts.product_item_id');
    })
    ->get();
    dump($carts->sum("total_price"));
    dd($carts->count());

    // dd($carts);

});
