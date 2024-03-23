<?php

namespace Modules\Post\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Post\Database\Factories\PostCategoryFactory;
use \Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

class PostCategory extends Model
{
    use HasFactory;
    use HasRecursiveRelationships;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        "name",
        "slug",
        "category_id"
    ];

    public function getParentKeyName()
    {
        return 'category_id';
    }

    protected static function newFactory(): Factory
    {
        return PostCategoryFactory::new();
    }

    public function Categories(){
        return $this->hasMany(PostCategory::class);
    }
}
