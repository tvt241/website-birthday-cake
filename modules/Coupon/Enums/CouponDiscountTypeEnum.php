<?php
namespace Modules\Coupon\Enums;

use Modules\Core\Traits\EnumTrait;

enum CouponDiscountTypeEnum : int
{
    use EnumTrait;
    case CASH = 1;
    case PERCENT = 2;
}