<?php

namespace Modules\Customer\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Modules\Order\Models\Cart;

class Customer extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        "username",
        "first_name",
        "last_name",
        "password",
        "gender",
        "phone",
        "email",
        "last_name",
        "social",
        "status_active"
    ];

    protected function password(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value,
            set: fn ($value) => bcrypt($value),
        );
    }

    public function carts(){
        return $this->hasMany(Cart::class, "user_id");
    }

    public function getCartFormat(){
        $subQuery = DB::table('product_items')
        ->select('id', 'price', "quantity", "product_variation_id", "product_id");

        $carts = $this->carts()
        ->select(DB::raw("pItemSub.id as product_item_id, pItemSub.price, pItemSub.product_variation_id, pItemSub.product_id, carts.quantity, pItemSub.price * carts.quantity as total_price"))
        ->joinSub($subQuery, 'pItemSub', function ($join) {
            $join->on('pItemSub.id', '=', 'carts.product_item_id');
        })
        ->get();
        return $carts;
    }
    
    // protected static function newFactory()
    // {
    //     return \Modules\Customer\Database\factories\CustomerFactory::new();
    // }
}
