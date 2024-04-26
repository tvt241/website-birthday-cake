<?php

namespace Modules\Order\Observers;

use Modules\Order\Events\Order\OrderCreatedEvent;
use Modules\Order\Models\Order;

class OrderObserver
{
    public function created(Order $order)
    {
        $sub = substr($order->phone, -3);
        $phone = str_replace($sub, "xxx", $order->phone);
        $message = $phone . " đã mua hàng";
        event(new OrderCreatedEvent($message));
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
