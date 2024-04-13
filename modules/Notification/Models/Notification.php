<?php

namespace Modules\Notification\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Core\Models\GatewayOption;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "slug",
        "activate",
    ];
}
