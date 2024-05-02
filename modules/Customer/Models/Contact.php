<?php

namespace Modules\Customer\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Facades\DB;
use Modules\Core\Models\Image;
use Modules\Order\Models\Cart;
use Modules\Order\Models\Order;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "email",
        "content",
        "is_seen",
        "is_reply",
    ];
}
