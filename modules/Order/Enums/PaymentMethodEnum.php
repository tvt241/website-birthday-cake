<?php
namespace Modules\Order\Enums;

use Modules\Core\Traits\EnumTrait;

enum PaymentMethodEnum : int
{
    use EnumTrait;
    case COD = 0;
    case VNPAY = 1;
}