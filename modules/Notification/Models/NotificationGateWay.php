<?php

namespace Modules\Notification\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Core\Models\GatewayOption;

class NotificationGateWay extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "slug",
        "activate",
    ];

    public function gatewayOptions(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(GatewayOption::class, 'model');
    }
}
