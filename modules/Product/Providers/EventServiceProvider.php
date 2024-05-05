<?php

namespace Modules\Product\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Product\Models\ProductItem;
use Modules\Product\Observers\ProductItemObserver;

class EventServiceProvider extends ServiceProvider
{
    protected $observers = [
        ProductItem::class => [ProductItemObserver::class],
    ];
}
