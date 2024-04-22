<?php

namespace Modules\Order\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Customer\Models\Customer;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        "id",
        "name",
        "phone",
        "user_id",
        "order_code",
        "order_type",
        "order_channel",
        "order_date",
        "address",
        "address2",
        "amount",
        "coupon_value",
        "coupon_id",
        "shipping_price",
        "payment_method",
        "payment_status",
        "status",
        "note",
    ];

    public function orderDetails(){
        return $this->hasMany(OrderDetail::class);
    }

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function payments(){
        return $this->hasMany(Payment::class);
    }
}
