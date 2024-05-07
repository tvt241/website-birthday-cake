<?php
namespace Modules\Customer\Enums;

use Modules\Core\Traits\EnumTrait;

enum CustomerStatusEnum : int
{
    use EnumTrait;
    case NOTVERIFIED = 0;
    case VERIFIED = 1;
    case BLOCK = 2;
    case DELETE = 3;
}