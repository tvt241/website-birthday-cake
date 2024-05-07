<?php

use Illuminate\Support\Facades\Route;
use Modules\Post\Http\Controllers\Api\PostApiController;
use Modules\Post\Http\Controllers\Api\PostCategoryApiController;


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


Route::prefix('posts')->as('posts.')->group(function () {
    Route::get("categories/get-all", [PostCategoryApiController::class, "getAll"]);
    Route::put("categories/{id}/change-active", [PostCategoryApiController::class, "changeActive"]);
    Route::apiResource("categories", PostCategoryApiController::class);
});
Route::put("posts/{id}/change-active", [PostApiController::class, "changeActive"]);
Route::apiResource("posts", PostApiController::class);