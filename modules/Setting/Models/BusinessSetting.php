<?php

namespace Modules\Setting\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BusinessSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        "group",
        "key",
        "value"
    ];
    
    // protected static function newFactory()
    // {
    //     return \Modules\Setting\Database\factories\BusinessSettingFactory::new();
    // }
}
