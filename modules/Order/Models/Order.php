<?php

namespace Modules\Order\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    // protected static function newFactory()
    // {
    //     return \Modules\Order\Database\factories\OrderFactory::new();
    // }
}
