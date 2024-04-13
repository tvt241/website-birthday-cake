<?php

namespace Modules\Order\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Order\Models\Order;
use Modules\Order\Observers\OrderObserver;

class EventServiceProvider extends ServiceProvider
{
    protected $observers = [
        Order::class => [OrderObserver::class],
    ];

    // public function boot()
    // {
    //     Order::observe(OrderObserver::class);
    // }
}
