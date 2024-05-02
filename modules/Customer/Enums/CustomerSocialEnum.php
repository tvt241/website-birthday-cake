<?php
namespace Modules\Customer\Enums;

use Modules\Core\Traits\EnumTrait;

enum CustomerSocialEnum : int
{
    use EnumTrait;
    case GMAIL = 0;
    case FACEBOOK = 1;
    case GITHUB = 2;
}