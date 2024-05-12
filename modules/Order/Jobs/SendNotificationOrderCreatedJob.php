<?php

namespace Modules\Order\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Modules\Notification\Services\SendNotification\SendNotificationTelegramService;
use Pusher\Pusher;

class SendNotificationOrderCreatedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $order;
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(SendNotificationTelegramService $sendNotificationTelegramService)
    {
        $connection = config('broadcasting.connections.pusher');
        $pusher = new Pusher(
            $connection['key'],
            $connection['secret'],
            $connection['app_id'],
            $connection['options'] ?? []
        );
        $url = "/channels/presence-notifications";
        $data = [
            "info" => "user_count"
        ];
        $users = $pusher->get($url, $data);
        if(!$users->user_count){
            $order = $this->order;
            $message = "Bạn có đơn hàng mới
                        Người mua: {$order->name}
                        Số điện thoại: {$order->phone}
                        Giá trị: {$order->amount}";
            $sendNotificationTelegramService->sendMessage($message);
        }
    }
}
