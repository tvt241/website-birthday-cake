<?php
namespace Modules\Customer\Enums;

use Modules\Core\Traits\EnumTrait;

enum CustomerKeyLoginEnum : string
{
    // use EnumTrait;
    case username = "Tên người dùng";
    case phone = "Số điện thoại";
    case email = "Địa chỉ email";

    public static function getValue($value) {
        $cases = self::cases();
        $index = array_search($value, array_column($cases, "name"));
        if ($index !== false) {
            return $cases[$index]->value;
        }
        return null;
    }
}