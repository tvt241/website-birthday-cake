<?php
namespace Modules\Product\Enums;

use Modules\Core\Traits\EnumTrait;

enum ProductStatusEnum : int
{
    use EnumTrait;
    case ACTIVATE = 1;
    case DEACTIVATE = 0;
}