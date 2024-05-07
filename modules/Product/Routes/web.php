<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Modules\Notification\Services\SendNotification\SendNotificationTelegramService;
use Modules\Product\Http\Controllers\ProductController;

Route::get('/products', [ProductController::class, 'index'])->name("products");

Route::get('/products/{slug}', [ProductController::class, "showBySlug"])->name("products.details");

