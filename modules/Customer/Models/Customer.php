<?php

namespace Modules\Customer\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Modules\Core\Models\Image;
use Modules\Order\Models\Cart;
use Modules\Order\Models\Order;

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
        "is_active"
    ];

    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'model');
    }

    protected function password(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value,
            set: fn ($value) => bcrypt($value),
        );
    }

    public function orders(){
        return $this->hasMany(Order::class, "user_id");
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
