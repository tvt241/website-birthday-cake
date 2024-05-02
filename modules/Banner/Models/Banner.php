<?php

namespace Modules\Banner\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Modules\Core\Models\Image;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "order",
        "content",
        "url",
        "is_active",
    ];

    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'model');
    }
    
    protected static function newFactory()
    {
        return \Modules\Banner\Database\factories\BannerFactory::new();
    }
}
