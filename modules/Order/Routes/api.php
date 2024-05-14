<?php

use App\Events\MessageCreatedEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Modules\Order\Http\Controllers\Api\OrderApiController;
use Modules\Order\Http\Controllers\Api\PrintApiController;
use Modules\Order\Http\Controllers\Api\ReportApiController;
use Pusher\Pusher;

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
    Route::get('/orders/keys', [OrderApiController::class, 'keys']);
    Route::put('/orders/{order}/update-status', [OrderApiController::class, 'updateStatus']);
    Route::put('/orders/{order}/update-states', [OrderApiController::class, 'updateStates']);
    Route::apiResource('/orders', OrderApiController::class);
    Route::get("reports/month-in-year", [ReportApiController::class, "reportYear"]);
    Route::get("reports/top-user", [ReportApiController::class, "reportUser"]);
    Route::get("/print/invoice", [PrintApiController::class, "invoice"]);
});


Route::get('/connect', function(Request $request){
    $connection = config('broadcasting.connections.pusher');
    $pusher = new Pusher(
        $connection['key'],
        $connection['secret'],
        $connection['app_id'],
        $connection['options'] ?? []
    );
    $url = "/channels/presence-notifications";
    $data = [
        "info" => "user_count"
    ];
    // $data = []; 
    $users = $pusher->get($url, $data);
    if(!$users->user_count){
        dd(1);
    }
    dd(0);
});
