<?php

namespace Modules\Order\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "slug",
        "image",
        "info",
        "price",
        "price_import",
        "quantity",
        "product_item_id",
        "order_id"
    ];
    
    // protected static function newFactory()
    // {
    //     return \Modules\Order\Database\factories\OrderDetailFactory::new();
    // }
}
