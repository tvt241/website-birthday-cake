<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('notifications', function ($user) {
    return true;
}, ["guards" => ["api", "customer_web"]]);


Broadcast::channel('chats', function ($user) {
    return [
        "id" => $user->id,
        
    ];
}, ["guards" => ["api", "customer_web"]]);
