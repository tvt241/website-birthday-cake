<?php
namespace Modules\Coupon\Enums;

use Modules\Core\Traits\EnumTrait;

enum CouponStatusEnum : int
{
    use EnumTrait;
    case DEACTIVATE = 0;
    case ACTIVATE = 1;
    case AFTER = 2;
}