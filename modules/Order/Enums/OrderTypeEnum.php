<?php
namespace Modules\Order\Enums;

use Modules\Core\Traits\EnumTrait;

enum OrderTypeEnum : int
{
    use EnumTrait;
    case BOOKING = 0;
    case SALES = 1;
}