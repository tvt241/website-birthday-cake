<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\User\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            "email" => "admin@admin.com"
        ]);

        $role = Role::create(['name' => 'admin']);
        $permission = Permission::create(['name' => 'edit articles']);
        $role->givePermissionTo($permission);
        // $permission->assignRole($role);
        // $role->syncPermissions($permissions);
        // $permission->syncRoles($roles);
        // $role->revokePermissionTo($permission);
        // $permission->removeRole($role);

        

        User::factory(100)->create();
    }
}
