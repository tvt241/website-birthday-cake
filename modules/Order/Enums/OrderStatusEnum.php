<?php
namespace Modules\Order\Enums;

use Modules\Core\Traits\EnumTrait;

enum OrderStatusEnum : int
{
    use EnumTrait;
    const START_ORDER_PENDING = 0;
    const END_ORDER_PENDING = 9;

    case PENDING = 0;
    case PROCESSING = 1;
    case SHIPPED = 2;
    case IN_TRANSIT = 3;
    case OUT_FOR_DELIVERY = 4;
    case DELIVERED = 5;

    const START_ORDER_COMPLETE = 10;
    const END_ORDER_COMPLETE = 19;

    case COMPLETED = 10;
    case AUTO_COMPLETED = 11;

    const START_ORDER_ERROR = 20;
    const END_ORDER_ERROR = 29;
    
    case CANCELLED = 20;
    case CANCELLED_SELLER = 21;
    case PAUSE = 22;
    case DELIVERED_FAILED = 23;
    case REFUNDED = 24;
    case RETURNED = 25;
    case OUTOFSTOCK = 26;
}