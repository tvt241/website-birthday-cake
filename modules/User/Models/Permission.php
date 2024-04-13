<?php

namespace Modules\User\Models;

use Spatie\Permission\Exceptions\PermissionAlreadyExists;
use Spatie\Permission\Models\Permission as ModelsPermission;
use \Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;


class Permission extends ModelsPermission
{
    use HasRecursiveRelationships;

    public function getParentKeyName()
    {
        return 'menu_parent';
    }

    public static function create(array $attributes = [])
    {
        $attributes['guard_name'] = $attributes['guard_name'] ?? "api";

        $permission = static::getPermission(['name' => $attributes['name'], 'guard_name' => $attributes['guard_name']]);

        if ($permission) {
            throw PermissionAlreadyExists::create($attributes['name'], $attributes['guard_name']);
        }

        return static::query()->create($attributes);
    }
}
