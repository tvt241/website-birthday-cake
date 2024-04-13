<?php

namespace Modules\Post\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Modules\Core\Models\Image;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "slug",
        "is_active",
        "desc_sort",
        "category_id",
        "desc"
    ];

    public function category(){
        return $this->belongsTo(PostCategory::class, "category_id");
    }

    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'model');
    }

}
