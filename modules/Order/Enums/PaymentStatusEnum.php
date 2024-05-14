<?php
namespace Modules\Order\Enums;

use Modules\Core\Traits\EnumTrait;

enum PaymentStatusEnum : int
{
    use EnumTrait;
    case UNPAID = 0;
    case LACK = 2;
    case DONE = 1;
    case RETURN = 3;
}