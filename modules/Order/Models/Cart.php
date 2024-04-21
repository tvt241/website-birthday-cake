<?php

namespace Modules\Order\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Product\Models\ProductItem;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        "id",
        "product_item_id",
        "price",
        "quantity",
        "user_id"
    ];

    public function productItem(){
        return $this->belongsTo(ProductItem::class);
    }
    
    // protected static function newFactory()
    // {
    //     return \Modules\Order\Database\factories\CartFactory::new();
    // }
}
