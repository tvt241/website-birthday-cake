<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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
    Route::post("/image", [UploadFileApiController::class, "image"])->name("image");
});
