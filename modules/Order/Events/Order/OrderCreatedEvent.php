<?php

namespace Modules\Order\Events\Order;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class OrderCreatedEvent implements ShouldBroadcast
{
    use SerializesModels;

    private $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [
            new Channel("notifications"),
        ];
    }

    public function broadcastAs(){
        return "notifications";
    }

    public function broadcastWith(){
        return [
            "message" => $this->message,
            "title" => "Bạn có đơn hàng mới"
        ];
    }

}
