<?php

namespace Modules\Order\Events\Employee\Order;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class OrderCreatedEvent implements ShouldBroadcast
{
    use SerializesModels;

    private $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [
            new PresenceChannel("notifications"),
        ];
    }

    public function broadcastAs(){
        return "notifications";
    }

    public function broadcastWith(){
        $order = $this->order;
        return [
            "data" => [
                "name" => $order->name,
                "amount" => $order->amount,
            ],
            "title" => "Bạn có đơn hàng mới"
        ];
    }
}
