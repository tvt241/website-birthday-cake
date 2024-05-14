<?php

use Illuminate\Support\Facades\Route;
use Modules\Customer\Http\Controllers\Api\CustomerApiController;


Route::group(["middleware" => "auth:api"], function(){
    Route::put("customers/{id}/change-active", [CustomerApiController::class, "changeActive"]);
    Route::apiResource("customers", CustomerApiController::class);
});
