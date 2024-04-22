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
            [ "title" => "POS", "title" => "POS", "name" => "pos", "url" => "pos", "icon" => "mdi mdi-shopping", "menu_parent" => null, "module" => null],
        ];
        Permission::insert($permissions);

        $permissions_parent = Permission::create(["title" => "Đơn hàng", "label" => "Đơn hàng", "name" => "orders", "url" => "orders", "icon" => "mdi mdi-cart-outline", "menu_parent" => null, "module" => "Bán hàng"]);
        $permissions = [
            [ "title" => "Danh sách đơn hàng", "label" => "Danh sách đơn hàng", "name" => "orders", "url" => "orders", "menu_parent" => $permissions_parent->id, "module" => "Bán hàng"],
            [ "title" => "Thêm đơn hàng", "label" => "Thêm đơn hàng", "name" => "orders_create", "url" => "orders/create", "menu_parent" => $permissions_parent->id, "module" =>  "Bán hàng"],
            [ "title" => "Sửa đơn hàng", "label" => null, "name" => "orders_edit", "url" => "orders/:id/edit", "menu_parent" => $permissions_parent->id, "module" => "Bán hàng"],
            [ "title" => "Chi tiết đơn hàng", "label" => null, "name" => "orders_show", "url" => "orders/:id", "menu_parent" => $permissions_parent->id, "module" => "Bán hàng"],
            [ "title" => "Xóa đơn hàng", "label" => null, "name" => "orders_delete", "url" => "orders/:id", "menu_parent" => $permissions_parent->id, "module" => "Bán hàng"],
        ];

        $permissions_parent = Permission::create(["title" => "Sản phẩm", "label" => "Sản phẩm", "name" => "products", "icon" => "mdi mdi-alpha-p-box", "url" => "products", "menu_parent" => null, "module" => "Hàng hóa", "is_sub" => 1]);
        $permissions = [
            [ "title" => "Danh sách sản phẩm", "label" => "Danh sách sản phẩm", "name" => "products", "url" => "products", "menu_parent" => $permissions_parent->id, "module" => "Hàng hóa"],
            [ "title" => "Thêm sản phẩm", "label" => "Thêm sản phẩm", "name" => "products_create", "url" => "products/create", "menu_parent" => $permissions_parent->id, "module" => "Hàng hóa"],
            [ "title" => "Sửa sản phẩm", "label" => null, "name" => "products_edit", "url" => "products/:id/edit", "menu_parent" => $permissions_parent->id, "module" => "Hàng hóa"],
            [ "title" => "Chi tiết sản phẩm", "label" => null, "name" => "products_show", "url" => "products/:id", "menu_parent" => $permissions_parent->id, "module" => "Hàng hóa"],
            [ "title" => "Xóa sản phẩm", "label" => null, "name" => "products_delete", "url" => "products/:id", "menu_parent" => $permissions_parent->id, "module" => "Hàng hóa"],
        ];
        Permission::insert($permissions);

        $permissions_parent = Permission::create([ "title" => "Danh mục sản phẩm", "label" => "Danh mục sản phẩm", "name" => "product_categories", "url" => "categories", "icon" => "mdi mdi-text-short", "menu_parent" => null, "module" => "Hàng hóa"]);
        $permissions = [
            [ "title" => "Danh mục sản phẩm", "label" => "Danh mục sản phẩm", "name" => "product_categories", "url" => "categories", "menu_parent" => $permissions_parent->id, "module" => "Hàng hóa"],
            [ "title" => "Thêm danh mục sản phẩm", "label" => null, "name" => "product_categories_create", "url" => "categories/create", "menu_parent" => $permissions_parent->id, "module" => "Hàng hóa"],
            [ "title" => "Sửa danh mục sản phẩm", "label" => null, "name" => "product_categories_update", "url" => "categories/:id/edit", "menu_parent" => $permissions_parent->id, "module" => "Hàng hóa"],
            [ "title" => "Chi tiết danh mục sản phẩm", "label" => null, "name" => "product_categories_show", "url" => "categories/:id", "menu_parent" => $permissions_parent->id, "module" => "Hàng hóa"],
            [ "title" => "Xóa danh mục sản phẩm", "label" => null, "name" => "product_categories_delete", "url" => "categories/:id", "menu_parent" => $permissions_parent->id, "module" => "Hàng hóa"],
        ];
        Permission::insert($permissions);

        $permissions_parent = Permission::create([ "title" => "Bài viết", "label" => "Bài viết", "name" => "posts", "url" => "posts", "icon" => "mdi mdi-newspaper", "menu_parent" => null, "module" => "Marketing", "is_sub" => 1]);
        $permissions = [
            [ "title" => "Danh sách bài viết", "label" => "Danh sách bài viết", "name" => "posts", "url" => "posts", "menu_parent" => $permissions_parent->id, "module" => "Marketing",],
            [ "title" => "Thêm bài viết", "label" => "Thêm bài viết", "name" => "posts_create", "url" => "posts/create", "menu_parent" => $permissions_parent->id, "module" => "Marketing"],
            [ "title" => "Sửa bài viết", "label" => null, "name" => "post_edit", "url" => "posts/:id/edit", "menu_parent" => $permissions_parent->id, "module" => "Marketing"],
            [ "title" => "Chi tiết bài viết", "label" => null, "name" => "post_show", "url" => "posts/:id", "menu_parent" => $permissions_parent->id, "module" => "Marketing"],
            [ "title" => "Xóa bài viết", "label" => null, "name" => "post_delete", "url" => "posts/:id", "menu_parent" => $permissions_parent->id, "module" => "Marketing"],
        ];
        Permission::insert($permissions);

        $permissions_parent = Permission::create([ "title" => "Danh mục bài viết", "label" => "Danh mục bài viết", "name" => "post_categories", "url" => "posts/categories", "icon" => "mdi mdi-text-short", "menu_parent" => null, "module" => "Marketing"]);
        $permissions = [
            [ "title" => "Danh mục bài viết", "label" => "Danh mục bài viết", "name" => "post_categories", "url" => "posts/categories", "menu_parent" => $permissions_parent->id, "module" => "Marketing"],
            [ "title" => "Thêm danh mục bài viết", "label" => null, "name" => "post_categories_create", "url" => "posts/categories/create", "menu_parent" => $permissions_parent->id, "module" => "Marketing"],
            [ "title" => "Sửa danh mục bài viết", "label" => null, "name" => "post_categories_edit", "url" => "posts/categories/:id/edit", "menu_parent" => $permissions_parent->id, "module" => "Marketing"],
            [ "title" => "Chi tiết danh mục bài viết", "label" => null, "name" => "post_categories_show", "url" => "posts/categories/:id", "menu_parent" => $permissions_parent->id, "module" => "Marketing"],
            [ "title" => "Xóa danh mục bài viết", "label" => null, "name" => "post_categories_delete", "url" => "posts/categories/:id", "menu_parent" => $permissions_parent->id, "module" => "Marketing"],
        ];
        Permission::insert($permissions);

        $permissions_parent = Permission::create([ "title" => "Mã giảm giá", "label" => "Mã giảm giá", "name" => "coupons", "url" => "coupons", "icon" => "mdi mdi-ticket-percent", "menu_parent" => null, "module" => "Marketing", "is_sub" => 1]);
        $permissions = [
            [ "title" => "Mã giảm giá", "label" => "Mã giảm giá", "name" => "coupons", "url" => "coupons", "menu_parent" => $permissions_parent->id, "module" => "Marketing"],
            [ "title" => "Thêm mã giảm giá", "label" => "Thêm mã giảm giá", "name" => "coupons_create", "url" => "coupons/create", "menu_parent" => $permissions_parent->id, "module" => "Marketing"],
            [ "title" => "Sửa mã giảm giá", "label" => null, "name" => "coupons_edit", "url" => "coupons/:id/edit", "menu_parent" => $permissions_parent->id, "module" => "Marketing"],
            [ "title" => "Chi tiết mã giảm giá", "label" => null, "name" => "coupons_show", "url" => "coupons/:id", "menu_parent" => $permissions_parent->id, "module" => "Marketing"],
            [ "title" => "Xóa mã giảm giá", "label" => null, "name" => "coupons_delete", "url" => "coupons/:id", "menu_parent" => $permissions_parent->id, "module" => "Marketing"],
        ];
        Permission::insert($permissions);

        $permissions_parent = Permission::create([ "title" => "Thông báo", "label" => "Thông báo", "name" => "notifications", "url" => "notifications", "icon" => "mdi mdi-bell-ring", "menu_parent" => null, "module" => "Marketing"]);
        $permissions = [
            [ "title" => "Thêm thông báo", "label" => null, "name" => "notifications_create", "url" => "notifications/create", "menu_parent" => $permissions_parent->id, "module" => "Marketing"],
            [ "title" => "Sửa thông báo", "label" => null, "name" => "notifications_edit", "url" => "notifications/:id/edit", "menu_parent" => $permissions_parent->id, "module" => "Marketing"],
            [ "title" => "Chi tiết thông báo", "label" => null, "name" => "notifications_show", "url" => "notifications/:id", "menu_parent" => $permissions_parent->id, "module" => "Marketing"],
            [ "title" => "Xóa thông báo", "label" => null, "name" => "notifications_delete", "url" => "notifications/delete", "menu_parent" => $permissions_parent->id, "module" => "Marketing"],
        ];
        Permission::insert($permissions);

        $permissions_parent = Permission::create([ "title" => "Khách hàng", "label" => "Khách hàng", "name" => "customers", "url" => "customers", "icon" => "mdi mdi-account-group", "menu_parent" => null, "module" => "Người dùng", "is_sub" => 1]);
        $permissions = [
            [ "title" => "Khách hàng", "label" => "Khách hàng", "name" => "customers", "url" => "customers", "menu_parent" => $permissions_parent->id, "module" => "Người dùng"],
            [ "title" => "Thêm khách hàng", "label" => "Thêm khác hàng", "name" => "customers_create", "url" => "customers/create", "menu_parent" => $permissions_parent->id, "module" => "Người dùng"],
            [ "title" => "Sửa khách hàng", "label" => null, "name" => "customers_edit", "url" => "customers/:id/edit", "menu_parent" => $permissions_parent->id, "module" => "Người dùng"],
            [ "title" => "Chi tiết khách hàng", "label" => null, "name" => "customers_show", "url" => "customers/:id", "menu_parent" => $permissions_parent->id, "module" => "Người dùng"],
            [ "title" => "Xóa khách hàng", "label" => null, "name" => "customers_delete", "url" => "customers/:id", "menu_parent" => $permissions_parent->id, "module" => "Người dùng"],
        ];
        Permission::insert($permissions);

        $permissions_parent = Permission::create([ "title" => "Nhân viên", "label" => "Nhân viên", "name" => "employees", "url" => "employees", "icon" => "mdi mdi-account-multiple", "menu_parent" => null, "module" => "Người dùng", "is_sub" => 1]);
        $permissions = [
            [ "title" => "Nhân viên", "label" => "Nhân viên", "name" => "employees", "url" => "employees", "menu_parent" => $permissions_parent->id, "module" => "Người dùng"],
            [ "title" => "Thêm nhân viên", "label" => "Thêm nhân viên", "name" => "employees_create", "url" => "employees/create", "menu_parent" => $permissions_parent->id, "module" => "Người dùng"],
            [ "title" => "Sửa nhân viên", "label" => null, "name" => "employees_edit", "url" => "employees/:id/edit", "menu_parent" => $permissions_parent->id, "module" => "Người dùng"],
            [ "title" => "Chi tiết nhân viên", "label" => null, "name" => "employees_show", "url" => "employees/:id", "menu_parent" => $permissions_parent->id, "module" => "Người dùng"],
            [ "title" => "Xóa nhân viên", "label" => null, "name" => "employees_delete", "url" => "employees/:id", "menu_parent" => $permissions_parent->id, "module" => "Người dùng"],
        ];
        Permission::insert($permissions);

        $permissions = [
            [ "title" => "Thiết lập chung", "label" => "Thiết lập chung", "name" => "setting_business_setup", "url" => "settings/business-setups", "icon" => "mdi mdi-book-open-page-variant", "menu_parent" => null, "module" => "Thiết lập"],
        ];
        Permission::insert($permissions);

        $permissions_parent = Permission::create([ "title" => "Trang và mạng xã hội", "label" => "Trang và mạng xã hội", "name" => "setting_page_medias", "url" => "settings/page-medias", "icon" => "mdi mdi-account-multiple", "menu_parent" => null, "module" => "Thiết lập", "is_sub" => 1]);
        $permissions = [
            [ "title" => "Thiết lập trang", "label" => "Trang", "name" => "setting_page_setup", "url" => "settings/page-medias/page-setups", "menu_parent" => $permissions_parent->id, "module" => "Người dùng"],
            [ "title" => "Mạng xã hội", "label" => "Mạng xã hội", "name" => "setting_social_media", "url" => "settings/page-medias/social-medias", "menu_parent" => $permissions_parent->id, "module" => "Người dùng"],
        ];
        Permission::insert($permissions);

        $permissions = [
            [ "title" => "Thiết lập mẫu", "label" => "Thiết lập mẫu", "name" => "setting_template_setup", "url" => "settings/template-setups", "icon" => "mdi mdi-television-guide", "menu_parent" => null, "module" => "Thiết lập"],
            [ "title" => "Thiết lập hệ thống", "label" => "Thiết lập hệ thống", "name" => "setting_system_setup", "url" => "settings/system-setups", "icon" => "mdi mdi-settings", "menu_parent" => null, "module" => "Thiết lập"],
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
            "email" => "admin@gmail.com",
        ]);
        $permissions = Permission::get()->pluck(["id"])->toArray();
        $user->syncRoles($role);
        $role->givePermissionTo($permissions);
        // User::factory(100)->create();
    }
}
