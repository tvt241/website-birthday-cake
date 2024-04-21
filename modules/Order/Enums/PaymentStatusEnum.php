<?php
namespace Modules\Order\Enums;

use Modules\Core\Traits\EnumTrait;

enum PaymentStatusEnum : int
{
    use EnumTrait;
    case PENDING = 0;
    case LACK = 2;
    case DONE = 1;
}