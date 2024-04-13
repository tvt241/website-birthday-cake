<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\User\Models\Permission;
use Modules\User\Models\User;
use Spatie\Permission\Models\Role;

class UserDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ["name" => "Quản trị viên"],
            ["name" => "Quản lý"],
            ["name" => "Bán hàng"],
            ["name" => "Nội dung"],
            ["name" => "Giao hàng"]
        ];
        Role::insert($roles);

        $permissions = [
            [ "title" => "Tổng quan", "name" => "dashboard", "url" => "Tổng quan", "icon" => "", "menu_parent" => null],
            // [ "title" => "Tin nhắn", "name" => "messages", "url" => "Tổng quan", "icon" => "", "menu_parent" => null],
            // [ "title" => "Đơn bán hàng", "name" => "orders", "url" => "Tổng quan", "icon" => "", "menu_parent" => null]
        ];
        Permission::insert($permissions);

        // module products
        $permissions_parent = Permission::create([ "title" => "Sản phẩm", "name" => "products", "url" => "products", "icon" => "", "menu_parent" => null]);
        $permissions = [
            [ "title" => "Thêm sản phẩm", "name" => "products_create", "url" => "products/create", "icon" => "", "type" => "create", "menu_parent" => $permissions_parent->id],
            [ "title" => "Sửa sản phẩm", "name" => "products_edit", "url" => "products/edit", "icon" => "", "type" => "edit", "menu_parent" => $permissions_parent->id],
            [ "title" => "Chi tiết sản phẩm", "name" => "products_show", "url" => "products/show", "icon" => "", "type" => "show", "menu_parent" => $permissions_parent->id],
            [ "title" => "Xóa sản phẩm", "name" => "product_delete", "url" => "products/delete", "icon" => "", "type" => "delete", "menu_parent" => $permissions_parent->id],
        ];
        Permission::insert($permissions);

        $permissions_parent = Permission::create([ "title" => "Danh mục sản phẩm", "name" => "product_categories", "url" => "categories", "icon" => "", "menu_parent" => null]);
        $permissions = [
            [ "title" => "Thêm danh mục sản phẩm", "name" => "product_categories_create", "url" => "categories/create", "icon" => "","type" => "create", "menu_parent" => $permissions_parent->id],
            [ "title" => "Sửa danh mục sản phẩm", "name" => "product_categories_update", "url" => "categories/edit", "icon" => "", "type" => "edit", "menu_parent" => $permissions_parent->id],
            [ "title" => "Xem danh mục sản phẩm", "name" => "product_categories_show", "url" => "categories/show", "icon" => "", "type" => "show", "menu_parent" => $permissions_parent->id],
            [ "title" => "Xóa danh mục sản phẩm", "name" => "product_categories_delete", "url" => "categories/delete", "icon" => "", "type" => "delete", "menu_parent" => $permissions_parent->id],
        ];
        Permission::insert($permissions);

        // $permissions = [
            // [ "title" => "Mã giảm giá", "name" => "", "url" => "Tổng quan", "icon" => "", "menu_parent" => null],
            // [ "title" => "Thêm mã giảm giá", "name" => "", "url" => "Tổng quan", "icon" => "", "menu_parent" => null],
            // [ "title" => "Sửa mã giảm giá", "name" => "", "url" => "Tổng quan", "icon" => "", "menu_parent" => null],
            // [ "title" => "Xóa mã giảm giá", "name" => "", "url" => "Tổng quan", "icon" => "", "menu_parent" => null],

            // [ "title" => "Thông báo", "name" => "", "url" => "Tổng quan", "icon" => "", "menu_parent" => null],
            // [ "title" => "Thêm thông báo", "name" => "", "url" => "Tổng quan", "icon" => "", "menu_parent" => null],
            // [ "title" => "Sửa thông báo", "name" => "", "url" => "Tổng quan", "icon" => "", "menu_parent" => null],
            // [ "title" => "Xóa thông báo", "name" => "", "url" => "Tổng quan", "icon" => "", "menu_parent" => null],

            // [ "title" => "Bài viết", "name" => "", "url" => "Tổng quan", "icon" => "", "menu_parent" => null],
            // [ "title" => "Thêm bài viết", "name" => "", "url" => "Tổng quan", "icon" => "", "menu_parent" => null],
            // [ "title" => "Sửa bài viết", "name" => "", "url" => "Tổng quan", "icon" => "", "menu_parent" => null],
            // [ "title" => "Xóa bài viết", "name" => "", "url" => "Tổng quan", "icon" => "", "menu_parent" => null],

            // [ "title" => "Danh mục bài viết", "name" => "", "url" => "Tổng quan", "icon" => "", "menu_parent" => null],
            // [ "title" => "Thêm danh mục bài viết", "name" => "", "url" => "Tổng quan", "icon" => "", "menu_parent" => null],
            // [ "title" => "Sửa danh mục bài viết", "name" => "", "url" => "Tổng quan", "icon" => "", "menu_parent" => null],
            // [ "title" => "Xóa danh mục bài viết", "name" => "", "url" => "Tổng quan", "icon" => "", "menu_parent" => null],

            // [ "title" => "Nhân viên", "name" => "", "url" => "Tổng quan", "icon" => "", "menu_parent" => null],
            // [ "title" => "Thêm nhân viên", "name" => "", "url" => "Tổng quan", "icon" => "", "menu_parent" => null],
            // [ "title" => "Sửa nhân viên", "name" => "", "url" => "Tổng quan", "icon" => "", "menu_parent" => null],
            // [ "title" => "Xóa nhân viên", "name" => "", "url" => "Tổng quan", "icon" => "", "menu_parent" => null],

            // [ "title" => "Khách hàng", "name" => "", "url" => "Tổng quan", "icon" => "", "menu_parent" => null],
            // [ "title" => "Thêm khách hàng", "name" => "", "url" => "Tổng quan", "icon" => "", "menu_parent" => null],
            // [ "title" => "Sửa khách hàng", "name" => "", "url" => "Tổng quan", "icon" => "", "menu_parent" => null],
            // [ "title" => "Xóa khách hàng", "name" => "", "url" => "Tổng quan", "icon" => "", "menu_parent" => null],
        // ];

        $role = Role::find(1);
        $user = User::factory()->create([
            "email" => "admin@gmail.com"
        ]);
        $user->syncRoles($role);
        $role->givePermissionTo([1,2,3,4,5,6,7,8]);

        $role = Role::find(2);
        $user = User::factory()->create([
            "email" => "manager1@gmail.com"
        ]);
        $user->syncRoles($role);

        $user = User::factory()->create([
            "email" => "manager2@gmail.com"
        ]);
        $user->syncRoles($role);
        $role->givePermissionTo([1,2,3]);

        // User::factory(100)->create();
    }
}
