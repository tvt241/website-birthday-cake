<?php

namespace Modules\Core\Traits;

trait EnumTrait
{
    public static function getValue($key) {
        $cases = self::cases();
        $index = array_search($key, array_column($cases, "name"));
        if ($index !== false) {
            return __($cases[$index]->value);
        }
        return null;
    }

    public static function getKey($value){
        if(!$value && $value !== 0){
            return null;
        }
        $cases = self::cases();
        $index = array_search($value, array_column($cases, "value"));
        if ($index !== false) {
            return __($cases[$index]->name);
        }
        return null;
    }

    public static function getValues(){
        $cases = self::cases();
        $enums = [];
        foreach($cases as $case){
            $enums[$case->value] = __($case->name);
        }
        return $enums;
    }
}
