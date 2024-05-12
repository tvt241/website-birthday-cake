<?php

namespace Modules\Order\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Customer\Models\Customer;
use Modules\Order\Enums\OrderStatusEnum;
use Modules\Order\Enums\OrderTypeEnum;
use Modules\Order\Enums\PaymentMethodEnum;
use Modules\Order\Enums\PaymentStatusEnum;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        "id",
        "name",
        "phone",
        "email",
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
        "total"
    ];

    protected function paymentStatusName(): Attribute
    {
        return Attribute::make(
            get: fn () => PaymentStatusEnum::getKey($this->payment_status),
        );
    }

    protected function paymentMethodName(): Attribute
    {
        return Attribute::make(
            get: fn () => PaymentMethodEnum::getKey($this->payment_status),
        );
    }

    protected function orderTypeMethodName(): Attribute
    {
        return Attribute::make(
            get: fn () => OrderTypeEnum::getKey($this->payment_method),
        );
    }

    protected function orderStatusName(): Attribute
    {
        return Attribute::make(
            get: fn () => OrderStatusEnum::getKey($this->status),
        );
    }

    protected function isCancel(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->status <= OrderStatusEnum::PROCESSING->value ? 1 : 0,
        );
    }

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
