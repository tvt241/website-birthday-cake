<?php
use Illuminate\Support\Facades\Route;
use Modules\Product\Http\Controllers\ProductController;

Route::get('/products', [ProductController::class, 'index'])->name("products");

Route::get('/products/{slug}', [ProductController::class, "showBySlug"])->name("products.details");
