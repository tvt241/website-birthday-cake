<?php
namespace Modules\Order\Enums;

use Modules\Core\Traits\EnumTrait;

enum OrderChannelEnum : int
{
    use EnumTrait;
    case WEB = 0;
    case POS = 1;
    case APP = 2;
}