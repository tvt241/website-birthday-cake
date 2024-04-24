<?php
use Illuminate\Support\Facades\Route;
use Modules\Post\Http\Controllers\PostController;

Route::get('/blogs', [PostController::class, "index"])->name("blogs");

Route::get('/blogs/{slug}', [PostController::class, "showBySlug"])->name("blogs.details");
