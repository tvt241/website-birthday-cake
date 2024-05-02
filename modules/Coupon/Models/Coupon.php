<?php

namespace Modules\Coupon\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "code",
        "discount_value",
        "discount_type",
        "discount_max",
        "quantity",
        "available",
        "budget",
        "limit_per_user",
        "desc",
        "date_start",
        "date_end",
        "is_active"
    ];
    
    // protected static function newFactory()
    // {
    //     return \Modules\Coupon\Database\factories\CouponFactory::new();
    // }

    protected $casts = [
        'date_start' => 'datetime',
        'date_end' => 'datetime',
    ];
}
