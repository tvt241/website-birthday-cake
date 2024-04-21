<?php

namespace Modules\Customer\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OtpSms extends Model
{
    use HasFactory;

    protected $fillable = [
        "email",
        "phone",
        "token",
        "otp",
    ];
    
    // protected static function newFactory()
    // {
    //     return \Modules\Customer\Database\factories\OtpSmsFactory::new();
    // }
}
