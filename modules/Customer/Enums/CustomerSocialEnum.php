<?php
namespace Modules\Customer\Enums;

use Modules\Core\Traits\EnumTrait;

enum CustomerSocialEnum : int
{
    use EnumTrait;
    case google = 0;
    case facebook = 1;
}