<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Core\Http\Controllers\Api\LocationApiController;
use Modules\Core\Http\Controllers\CkEditorApiController;
use Modules\Core\Http\Controllers\UploadFileApiController;

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

// Route::middleware('auth:api')->get('/core', function (Request $request) {
//     return $request->user();
// });
Route::group(["prefix" => "upload-files", "as" => 'upload-files.'], function(){
    Route::post("/image", [UploadFileApiController::class, "image"]);
    Route::post("/ckeditor", [UploadFileApiController::class, "ckeditorUpload"]);
});

Route::group(["prefix" => "locations", "as" => "locations."], function(){
    Route::get("provinces", [LocationApiController::class, "provinces"])->name("provinces");
    Route::get("districts/{province}", [LocationApiController::class, "districts"])->name("districts");
    Route::get("wards/{district}", [LocationApiController::class, "wards"])->name("wards");
});