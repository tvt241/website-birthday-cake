<?php

namespace Modules\Order\Observers;

use Modules\Order\Models\Order;

class OrderObserver
{
    public function created(Order $order)
    {
        
    }
 
    public function updated($user)
    {
        //
    }

    // public function deleted(User $user)
    // {
    //     //
    // }

    // public function restored(User $user)
    // {
    //     //
    // }

    // public function forceDeleted(User $user)
    // {
    //     //
    // }
}
