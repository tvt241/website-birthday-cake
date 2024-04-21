<?php
namespace Modules\Order\Enums;

use Modules\Core\Traits\EnumTrait;

enum OrderStatusEnum : string
{
    use EnumTrait;
    case CANCELLED = "Đã hủy";
    case CANCELLED_SELLER = "Người bán hủy";
    case PENDING = "Chờ sử lý";
    case PROCESSING = "Chuẩn bị hàng";
    case SHIPPED = "Đã gửi hàng";
    case IN_TRANSIT = "Đang vận chuyển";
    case OUT_FOR_DELIVERY = "Đang giao đến bạn";
    case DELIVERED = "Đã giao hàng";
    case COMPLETED = "Hoàn thành";
    case AUTO_COMPLETED = "Hoàn thành (a)";
    case DELIVERED_FAILED = "Giao hàng thất bại";
    case REFUNDED = "Đã hoàn tiền";
    case RETURNED = "Đã trả hàng";
    case PAUSE = "Tạm dừng";
}