<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\User\Http\Controllers\Api\PermissionApiController;
use Modules\User\Http\Controllers\Api\RoleApiController;
use Modules\User\Http\Controllers\Api\UserApiController;
use Modules\User\Http\Controllers\Auth\LoginApiController;
use Modules\User\Models\User;
use Spatie\Permission\Models\Role;

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
    Route::post("refresh", [LoginApiController::class, "refresh"]);
    Route::group(["middleware" => "auth:api"], function(){
        Route::get("info", [LoginApiController::class, "info"]);
        Route::post("logout", [LoginApiController::class, "logout"]);
    });
});

Route::group([], function(){
    Route::get("roles/{id}/permissions", [RoleApiController::class, 'permissionByRole']);
    Route::put("roles/{id}/permissions", [RoleApiController::class, 'updatePermissionByRole']);
    Route::apiResource("roles", RoleApiController::class);
    Route::apiResource("employees", UserApiController::class);
});

Route::get("test", function(){
    // $ids = [];
    // for($i = 1; $i <= 62; $i++){
    //     $ids[] = $i;
    // }
    // $user = User::find(2);
    // $role = Role::find(2);
    // $user->syncRoles($role);
    // $role->givePermissionTo($ids);
    $user = User::find(2);
    $permissions = $user->roles()
    ->join("role_has_permissions", "roles.id", "=", "role_has_permissions.role_id")
    ->join("permissions", "role_has_permissions.permission_id", "=", "permissions.id")
    ->get([
        "permissions.name",
        "permissions.title",
    ]);
    dd($permissions);
});