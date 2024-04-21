<?php
namespace Modules\Core\Models\Traits;

trait CategoryTrait
{
    public function scopeInvalidByCategory($query)
    {
        return $query->whereRelation("category", "is_active", 1);
    }
}