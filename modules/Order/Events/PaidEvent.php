<?php

namespace Modules\Order\Events;

use Illuminate\Queue\SerializesModels;

class PaidEvent
{
    use SerializesModels;

    private $orderCode;
    private $message = "";


    public function __construct($orderCode, $message = "")
    {
        $this->orderCode = $orderCode;
        
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
