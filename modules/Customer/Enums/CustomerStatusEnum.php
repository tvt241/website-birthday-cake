<?php
namespace Modules\Customer\Enums;

use Modules\Core\Traits\EnumTrait;

enum CustomerStatusEnum : int
{
    use EnumTrait;
    case DEACTIVATE = 0;
    case ACTIVATE = 1;
    case BLOCK = 2;
}