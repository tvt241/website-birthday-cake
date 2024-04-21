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
        $permissions = [
            [ "title" => "Tổng quan", "label" => "Tổng quan", "name" => "dashboard", "url" => "dashboard", "icon" => "mdi mdi-view-dashboard-outline", "menu_parent" => null, "module" => null],
            [ "title" => "POS", "label" => "POS", "name" => "pos", "url" => "pos", "icon" => "mdi mdi-shopping", "menu_parent" => null, "module" => null],
        ];
        Permission::insert($permissions);

        $permissions_parent = Permission::create([ "title" => "Đơn hàng", "label" => "Đơn hàng", "name" => "orders", "url" => "orders", "icon" => "mdi mdi-cart-outline", "menu_parent" => null, "module" => "Bán hàng"]);
        $permissions = [
            [ "title" => "Danh sách đơn hàng", "label" => "Đơn hàng", "name" => "orders", "url" => "orders", "icon" => "mdi mdi-cart-outline", "type" => "list", "menu_parent" => $permissions_parent->id, "module" => "Bán hàng"],
            [ "title" => "Thêm đơn hàng", "label" => "Thêm đơn hàng", "name" => "orders_create", "url" => "orders/create", "icon" => "", "type" => "create", "menu_parent" => $permissions_parent->id, "module" =>  "Bán hàng"],
            [ "title" => "Sửa đơn hàng", "label" => null, "name" => "orders_edit", "url" => "orders/:id/edit", "icon" => "", "type" => "edit", "menu_parent" => $permissions_parent->id, "module" => "Bán hàng"],
            [ "title" => "Chi tiết đơn hàng", "label" => null, "name" => "orders_show", "url" => "orders/:id", "icon" => "", "type" => "show", "menu_parent" => $permissions_parent->id, "module" => "Bán hàng"],
            [ "title" => "Xóa sản phẩm", "label" => null, "name" => "orders_delete", "url" => "orders/:id", "icon" => "", "type" => "delete", "menu_parent" => $permissions_parent->id, "module" => "Bán hàng"],
        ];

        $permissions_parent = Permission::create([ "title" => "Sản phẩm", "label" => "Sản phẩm", "name" => "products", "url" => "products", "icon" => "mdi mdi-alpha-p-box", "type" => "list", "menu_parent" => null, "module" => "Hàng hóa"]);
        $permissions = [
            [ "title" => "Thêm sản phẩm", "label" => "Thêm sản phẩm", "name" => "products_create", "url" => "products/create", "icon" => "", "type" => "create", "menu_parent" => $permissions_parent->id, "module" =>  "Hàng hóa"],
            [ "title" => "Sửa sản phẩm", "label" => null, "name" => "products_edit", "url" => "products/:id/edit", "icon" => "", "type" => "edit", "menu_parent" => $permissions_parent->id, "module" => "Hàng hóa"],
            [ "title" => "Chi tiết sản phẩm", "label" => null, "name" => "products_show", "url" => "products/:id", "icon" => "", "type" => "show", "menu_parent" => $permissions_parent->id, "module" => "Hàng hóa"],
            [ "title" => "Xóa sản phẩm", "label" => null, "name" => "products_delete", "url" => "products/:id", "icon" => "", "type" => "delete", "menu_parent" => $permissions_parent->id, "module" => "Hàng hóa"],
        ];
        Permission::insert($permissions);

        $permissions_parent = Permission::create([ "title" => "Danh mục sản phẩm", "label" => "Danh mục sản phẩm", "name" => "product_categories", "url" => "categories", "icon" => "mdi mdi-text-short", "type" => "list", "menu_parent" => null, "module" => "Hàng hóa"]);
        $permissions = [
            [ "title" => "Thêm danh mục sản phẩm", "label" => null, "name" => "product_categories_create", "url" => "categories/create", "icon" => "", "type" => "create", "menu_parent" => $permissions_parent->id, "module" => "Hàng hóa"],
            [ "title" => "Sửa danh mục sản phẩm", "label" => null, "name" => "product_categories_update", "url" => "categories/:id/edit", "icon" => "", "type" => "edit", "menu_parent" => $permissions_parent->id, "module" => "Hàng hóa"],
            [ "title" => "Chi tiết danh mục sản phẩm", "label" => null, "name" => "product_categories_show", "url" => "categories/:id", "icon" => "", "type" => "show", "menu_parent" => $permissions_parent->id, "module" => "Hàng hóa"],
            [ "title" => "Xóa danh mục sản phẩm", "label" => null, "name" => "product_categories_delete", "url" => "categories/:id", "icon" => "", "type" => "delete", "menu_parent" => $permissions_parent->id, "module" => "Hàng hóa"],
        ];
        Permission::insert($permissions);

        $permissions_parent = Permission::create([ "title" => "Bài viết", "label" => "Bài viết", "name" => "posts", "url" => "posts", "icon" => "mdi mdi-newspaper", "type" => "list", "menu_parent" => null, "module" => "Marketing"]);
        $permissions = [
            [ "title" => "Thêm bài viết", "label" => "Thêm bài viết", "name" => "posts_create", "url" => "posts/create", "icon" => "", "type" => "create", "menu_parent" => $permissions_parent->id, "module" => "Marketing"],
            [ "title" => "Sửa bài viết", "label" => null, "name" => "post_edit", "url" => "posts/:id/edit", "icon" => "", "type" => "edit", "menu_parent" => $permissions_parent->id, "module" => "Marketing"],
            [ "title" => "Chi tiết bài viết", "label" => null, "name" => "post_show", "url" => "posts/:id", "icon" => "", "type" => "show", "menu_parent" => $permissions_parent->id, "module" => "Marketing"],
            [ "title" => "Xóa bài viết", "label" => null, "name" => "post_delete", "url" => "posts/:id", "icon" => "", "type" => "delete", "menu_parent" => $permissions_parent->id, "module" => "Marketing"],
        ];
        Permission::insert($permissions);

        $permissions_parent = Permission::create([ "title" => "Danh mục bài viết", "label" => "Danh mục bài viết", "name" => "post_categories", "url" => "posts/categories", "icon" => "mdi mdi-text-short", "type" => "list", "menu_parent" => null, "module" => "Marketing"]);
        $permissions = [
            [ "title" => "Thêm danh mục bài viết", "label" => null, "name" => "post_categories_create", "url" => "posts/categories/create", "icon" => "", "type" => "create", "menu_parent" => $permissions_parent->id, "module" => "Marketing"],
            [ "title" => "Sửa danh mục bài viết", "label" => null, "name" => "post_categories_edit", "url" => "posts/categories/:id/edit", "icon" => "", "type" => "edit", "menu_parent" => $permissions_parent->id, "module" => "Marketing"],
            [ "title" => "Chi tiết danh mục bài viết", "label" => null, "name" => "post_categories_show", "url" => "posts/categories/:id", "icon" => "", "type" => "show", "menu_parent" => $permissions_parent->id, "module" => "Marketing"],
            [ "title" => "Xóa danh mục bài viết", "label" => null, "name" => "post_categories_delete", "url" => "posts/categories/:id", "icon" => "", "type" => "delete", "menu_parent" => $permissions_parent->id, "module" => "Marketing"],
        ];
        Permission::insert($permissions);


        $permissions_parent = Permission::create([ "title" => "Mã giảm giá", "label" => "Mã giảm giá", "name" => "coupons", "url" => "coupons", "icon" => "mdi mdi-ticket-percent", "type" => "list", "menu_parent" => null, "module" => "Marketing"]);
        $permissions = [
            [ "title" => "Thêm mã giảm giá", "label" => "Thêm mã giảm giá", "name" => "coupons_create", "url" => "coupons/create", "icon" => "", "type" => "create", "menu_parent" => $permissions_parent->id, "module" => "Marketing"],
            [ "title" => "Sửa mã giảm giá", "label" => null, "name" => "coupons_edit", "url" => "coupons/:id/edit", "icon" => "", "type" => "edit", "menu_parent" => $permissions_parent->id, "module" => "Marketing"],
            [ "title" => "Chi tiết mã giảm giá", "label" => null, "name" => "coupons_show", "url" => "coupons/:id", "icon" => "", "type" => "show", "menu_parent" => $permissions_parent->id, "module" => "Marketing"],
            [ "title" => "Xóa mã giảm giá", "label" => null, "name" => "coupons_delete", "url" => "coupons/:id", "icon" => "", "type" => "delete", "menu_parent" => $permissions_parent->id, "module" => "Marketing"],
        ];
        Permission::insert($permissions);

        $permissions_parent = Permission::create([ "title" => "Thông báo", "label" => "Thông báo", "name" => "notifications", "url" => "notifications", "icon" => "mdi mdi-bell-ring", "type" => "list", "menu_parent" => null, "module" => "Marketing"]);
        $permissions = [
            [ "title" => "Thêm thông báo", "label" => null, "name" => "notifications_create", "url" => "notifications/create", "icon" => "", "type" => "create", "menu_parent" => $permissions_parent->id, "module" => "Marketing"],
            [ "title" => "Sửa thông báo", "label" => null, "name" => "notifications_edit", "url" => "notifications/:id/edit", "icon" => "", "type" => "edit", "menu_parent" => $permissions_parent->id, "module" => "Marketing"],
            [ "title" => "Chi tiết thông báo", "label" => null, "name" => "notifications_show", "url" => "notifications/:id", "icon" => "", "type" => "show", "menu_parent" => $permissions_parent->id, "module" => "Marketing"],
            [ "title" => "Xóa thông báo", "label" => null, "name" => "notifications_delete", "url" => "notifications/delete", "icon" => "", "type" => "delete", "menu_parent" => $permissions_parent->id, "module" => "Marketing"],
        ];
        Permission::insert($permissions);

        $permissions_parent = Permission::create([ "title" => "Khách hàng", "label" => "Khách hàng", "name" => "customers", "url" => "customers", "icon" => "mdi mdi-account-group", "type" => "list", "menu_parent" => null, "module" => "Người dùng"]);
        $permissions = [
            [ "title" => "Thêm khách hàng", "label" => "Thêm khác hàng", "name" => "customers_create", "url" => "customers/create", "icon" => "", "type" => "create", "menu_parent" => $permissions_parent->id, "module" => "Người dùng"],
            [ "title" => "Sửa khách hàng", "label" => null, "name" => "customers_edit", "url" => "customers/:id/edit", "icon" => "", "type" => "edit", "menu_parent" => $permissions_parent->id, "module" => "Người dùng"],
            [ "title" => "Chi tiết khách hàng", "label" => null, "name" => "customers_show", "url" => "customers/:id", "icon" => "", "type" => "show", "menu_parent" => $permissions_parent->id, "module" => "Người dùng"],
            [ "title" => "Xóa khách hàng", "label" => null, "name" => "customers_delete", "url" => "customers/:id", "icon" => "", "type" => "delete", "menu_parent" => $permissions_parent->id, "module" => "Người dùng"],
        ];
        Permission::insert($permissions);

        $permissions_parent = Permission::create([ "title" => "Nhân viên", "label" => "Nhân viên", "name" => "employees", "url" => "employees", "icon" => "mdi mdi-account-multiple", "type" => "list", "menu_parent" => null, "module" => "Người dùng"]);
        $permissions = [
            [ "title" => "Thêm nhân viên", "label" => "Thêm nhân viên", "name" => "employees_create", "url" => "employees/create", "icon" => "", "type" => "create", "menu_parent" => $permissions_parent->id, "module" => "Người dùng"],
            [ "title" => "Sửa nhân viên", "label" => null, "name" => "employees_edit", "url" => "employees/:id/edit", "icon" => "", "type" => "edit", "menu_parent" => $permissions_parent->id, "module" => "Người dùng"],
            [ "title" => "Chi tiết nhân viên", "label" => null, "name" => "employees_show", "url" => "employees/:id", "icon" => "", "type" => "show", "menu_parent" => $permissions_parent->id, "module" => "Người dùng"],
            [ "title" => "Xóa nhân viên", "label" => null, "name" => "employees_delete", "url" => "employees/:id", "icon" => "", "type" => "delete", "menu_parent" => $permissions_parent->id, "module" => "Người dùng"],
        ];
        Permission::insert($permissions);

        $permissions = [
            [ "title" => "Thiết lập chung", "label" => "Thiết lập chung", "name" => "setting_business_setup", "url" => "settings/business-setups", "icon" => "mdi mdi-view-dashboard-outline", "menu_parent" => null, "module" => "Thiết lập"],
        ];
        Permission::insert($permissions);

        $permissions_parent = Permission::create([ "title" => "Trang và mạng xã hội", "label" => "Trang và mạng xã hội", "name" => "setting_page_setup", "url" => "employees", "icon" => "mdi mdi-account-multiple", "type" => "list", "menu_parent" => null, "module" => "Thiết lập"]);
        $permissions = [
            [ "title" => "Thiết lập trang", "label" => "Trang", "name" => "setting_page_settup", "url" => "employees/create", "icon" => "", "type" => "create", "menu_parent" => $permissions_parent->id, "module" => "Người dùng"],
            [ "title" => "Sửa nhân viên", "label" => null, "name" => "employees_edit", "url" => "employees/:id/edit", "icon" => "", "type" => "edit", "menu_parent" => $permissions_parent->id, "module" => "Người dùng"],
            [ "title" => "Chi tiết nhân viên", "label" => null, "name" => "employees_show", "url" => "employees/:id", "icon" => "", "type" => "show", "menu_parent" => $permissions_parent->id, "module" => "Người dùng"],
            [ "title" => "Xóa nhân viên", "label" => null, "name" => "employees_delete", "url" => "employees/:id", "icon" => "", "type" => "delete", "menu_parent" => $permissions_parent->id, "module" => "Người dùng"],
        ];
        Permission::insert($permissions);

        $roles = [
            ["name" => "Quản trị viên"],
            ["name" => "Quản lý"],
            ["name" => "Bán hàng"],
            ["name" => "Nội dung"],
            ["name" => "Giao hàng"]
        ];
        Role::insert($roles);

        $role = Role::find(1);
        $user = User::factory()->create([
            "email" => "admin@gmail.com"
        ]);
        $permissions = Permission::get()->pluck(["id"])->toArray();
        $user->syncRoles($role);
        $role->givePermissionTo($permissions);
        // User::factory(100)->create();
    }
}
