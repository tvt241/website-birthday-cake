<?php

use App\Events\MessageCreatedEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Modules\Notification\Jobs\SendMailVerifyJob;
use Modules\Order\Events\Order\OrderCreatedEvent;
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
Route::get('/orders/keys', [OrderApiController::class, 'keys']);
Route::put('/orders/{order}/update-status', [OrderApiController::class, 'updateStatus']);
Route::apiResource('/orders', OrderApiController::class);
Route::get("reports/month-in-year", [ReportApiController::class, "reportYear"]);
Route::get("reports/top-user", [ReportApiController::class, "reportUser"]);
Route::get("/print/invoice", [PrintApiController::class, "invoice"]);

Route::get('/connect', function(Request $request){
    $connection = config('broadcasting.connections.pusher');
    $pusher = new Pusher(
        $connection['key'],
        $connection['secret'],
        $connection['app_id'],
        $connection['options'] ?? []
    );
    $url = "/channels/presence-chats";
    $data = [
        "info" => "user_count"
    ];
    // $data = []; 
    $users = $pusher->get($url, $data);

    dd($users);
});
