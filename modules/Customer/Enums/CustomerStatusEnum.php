<?php
namespace Modules\Customer\Enums;

enum CustomerStatusEnum : int
{
    case NO = 0;
    case YES = 1;
    case BLOCK = 2;
}