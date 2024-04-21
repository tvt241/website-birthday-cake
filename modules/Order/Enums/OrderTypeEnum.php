<?php
namespace Modules\Order\Enums;

use Modules\Core\Traits\EnumTrait;

enum OrderTypeEnum : int
{
    use EnumTrait;
    case WEB = 0;
    case POS = 1;
}