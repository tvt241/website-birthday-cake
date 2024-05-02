<?php

use Illuminate\Support\Facades\Route;
use Modules\Customer\Http\Controllers\Api\CustomerApiController;

Route::apiResource("customers", CustomerApiController::class);