<?php

namespace Modules\Notification\Services\SendNotification;

use Illuminate\Support\Facades\Http;
use Modules\Notification\Services\SendNotification\ISendNotificationService;

class SendNotificationTelegramService implements ISendNotificationService {
    private $http;
    public function __construct()
    {
        $url = config("telegram-logger.api_host");
        $this->http = Http::baseUrl($url);
    }
    public function sendMessage($message)
    {
        $url = "bot" . config("telegram-logger.token") . "/sendMessage";
        $data = [
            "chat_id" => env("TELEGRAM_CHAT_ID"),
            "text" => $message
        ];
        $this->http->get($url, $data);
    }
}