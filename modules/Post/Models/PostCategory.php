<?php

namespace Modules\Post\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Post\Database\Factories\PostCategoryFactory;

class PostCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "slug",
        "is_active",
        "description"
    ];

    public function posts(){
        return $this->hasMany(Post::class, "category_id");
    }

    protected static function newFactory(): Factory
    {
        return PostCategoryFactory::new();
    }
}
