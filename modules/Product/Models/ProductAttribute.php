<?php

namespace Modules\Product\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductAttribute extends Model
{
    use HasFactory;

    protected $fillable = [
        "id",
        "name"
    ];
    
    // protected static function newFactory()
    // {
    //     return \Modules\Product\Database\factories\ProductAttributeFactory::new();
    // }
}
