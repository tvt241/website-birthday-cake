<?php

namespace Modules\Coupon\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Coupon\Enums\CouponDiscountTypeEnum;
use Modules\Coupon\Enums\CouponStatusEnum;
use Modules\Order\Enums\OrderStatusEnum;
use Modules\Order\Models\Order;

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
        "budget_available",
        "limit_per_user",
        "desc",
        "date_start",
        "date_end",
        "is_active"
    ];

    // protected function paymentMethodName(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn () => PaymentMethodEnum::getKey($this->payment_status),
    //     );
    // }

    public function checkCouponInvalid($amount){
        $message = "Mã giảm giá không đúng hoặc đã hết hạn";
        if($this->is_active !== CouponStatusEnum::ACTIVATE->value){
            return $message;
        }
        if($this->date_end < now() || $this->date_start > now()){
            return $message;
        }
        if($this->available == 0){
            return "Mã giảm giá đã hết số lượt sử dụng";
        }
        $data = [];
        if($this->limit_per_user){
            $user = auth()->user();
            if(!$user){ 
                return "Mã giảm giá chỉ dành cho thành viên"; 
            }
            $oderUsedCoupon = Order::where("coupon_id", $this->id)
                                    ->where("user_id", $user->id)
                                    ->where("status", "<", OrderStatusEnum::START_ORDER_ERROR)
                                    ->count();
            if($oderUsedCoupon && $oderUsedCoupon > $this->limit_per_user){ 
                return "Số lần sử dụng mã giảm giá này của bạn đã đạt tối đa";
            }
        }
        $data = [];
        if($this->discount_type == CouponDiscountTypeEnum::CASH->value){
            $data["value"] = $this->discount_value;
            if($data["value"] > $amount){
                $data["value"] = $amount;
            }
        }
        else{
            $data["value"] = $amount / 100 * $this->discount_value;
            if($data["value"] > $this->discount_max){
                $data["value"] = $this->discount_max;
            }
        }
        if($this->budget_available && $this->budget_available < $data["value"]){
            return "Ngân sách cho mã giảm giá này đã hết";
        }
        return $data;
    }
    
    // protected static function newFactory()
    // {
    //     return \Modules\Coupon\Database\factories\CouponFactory::new();
    // }

    protected $casts = [
        'date_start' => 'datetime',
        'date_end' => 'datetime',
    ];
}
