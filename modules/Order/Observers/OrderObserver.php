<?php

namespace Modules\Order\Observers;

use Modules\Order\Enums\OrderChannelEnum;
use Modules\Order\Enums\OrderStatusEnum;
use Modules\Order\Events\Employee\Order\OrderCreatedEvent as OrderEmployeeCreatedEvent;
use Modules\Order\Events\Order\OrderCreatedEvent;
use Modules\Order\Jobs\SendNofiticationOrderCreatedJob;
use Modules\Order\Jobs\SendNotificationOrderCreatedJob;
use Modules\Order\Models\Order;

class OrderObserver
{
    public function created(Order $order)
    {
        $sub = substr($order->phone, -3);
        $phone = str_replace($sub, "xxx", $order->phone);
        $message = $phone . " đã mua hàng";
        event(new OrderCreatedEvent($message));
        // if($order->email){
            
        // }
        if($order->order_channel != OrderChannelEnum::POS->value){
            event(new OrderEmployeeCreatedEvent($order));
            SendNotificationOrderCreatedJob::dispatch($order);
        }
    }
 
    public function updated(Order $order)
    {
        if($order->user_id){
            
        }
        if($order->status >= OrderStatusEnum::START_ORDER_COMPLETE && $order->status >= OrderStatusEnum::END_ORDER_COMPLETE){

        }
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
