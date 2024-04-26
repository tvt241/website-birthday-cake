<?php
namespace Modules\Order\Enums;

use Modules\Core\Traits\EnumTrait;

enum OrderStatusEnum : int
{
    use EnumTrait;
    case CANCELLED = -2;
    case CANCELLED_SELLER = -1;
    case PENDING = 0;
    case PROCESSING = 1;
    case SHIPPED = 2;
    case IN_TRANSIT = 3;
    case OUT_FOR_DELIVERY = 4;
    case DELIVERED = 5;
    case COMPLETED = 6;
    case AUTO_COMPLETED = 7;
    case PAUSE = 8;
    case DELIVERED_FAILED = 10;
    case REFUNDED = 20;
    case RETURNED = 21;
}