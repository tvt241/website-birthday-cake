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
        foreach($cases as $key => $case){
            $enums[$key]["name"] = __($case->name);
            $enums[$key]["value"] = $case->value;
        }
        return $enums;
    }
}
