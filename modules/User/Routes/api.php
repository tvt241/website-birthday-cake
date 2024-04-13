<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\User\Http\Controllers\Api\PermissionApiController;
use Modules\User\Http\Controllers\Api\RoleApiController;
use Modules\User\Http\Controllers\Auth\LoginApiController;

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

Route::group(["prefix" => "auth", "name" => "auth."], function(){
    Route::post("login", [LoginApiController::class, "login"]);
    Route::post("refresh-token", [LoginApiController::class, "refreshToken"]);
    // Route::post("logout", [LoginApiController::class, "logout"]);

    // Route::post("info", [LoginApiController::class, "info"]);
});

Route::group([], function(){
    Route::get("roles/{id}/permissions", [RoleApiController::class, 'permissionByRole']);
    Route::put("roles/{id}/permissions", [RoleApiController::class, 'updatePermissionByRole']);
    Route::apiResource("roles", RoleApiController::class);
});

