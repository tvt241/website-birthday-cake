<?php

use Illuminate\Support\Facades\Route;
use Modules\Setting\Http\Controllers\Api\BusinessApiSettingController;

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
    Route::post("/get-config", [BusinessApiSettingController::class, "getConfig"]);
    Route::post("/update-config/company", [BusinessApiSettingController::class, "updateCompanyConfig"]);
    Route::post("/get-service", [BusinessApiSettingController::class, "getService"]);
});
