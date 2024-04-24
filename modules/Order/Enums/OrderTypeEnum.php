<?php
namespace Modules\Order\Enums;

use Modules\Core\Traits\EnumTrait;

enum OrderTypeEnum : int
{
    use EnumTrait;
    case SALES = 0;
    case BOOKING = 1;
}