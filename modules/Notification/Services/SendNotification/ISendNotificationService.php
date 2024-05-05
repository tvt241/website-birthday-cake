<?php

namespace Modules\Notification\Services\SendNotification;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

interface ISendNotificationService {
    public function sendMessage($message);
}