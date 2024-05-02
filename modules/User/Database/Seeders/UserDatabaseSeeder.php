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
            [ "title" => "Tổng quan", "label" => "Tổng quan", "name" => "dashboard", "icon" => "mdi mdi-view-dashboard-outline", "menu_parent" => null, "module" => null],
            [ "title" => "POS", "label" => "POS", "name" => "pos", "icon" => "mdi mdi-shopping", "menu_parent" => null, "module" => null],
        ];
        Permission::insert($permissions);

        $permissions_parent = Permission::create(["title" => "Đơn hàng", "label" => "Đơn hàng", "name" => "module-orders", "icon" => "mdi mdi-cart-outline", "menu_parent" => null, "module" => "Bán hàng"]);
        $permissions = [
            [ "title" => "Đơn hàng", "label" => "Danh sách đơn hàng", "name" => "orders", "icon" => "mdi mdi-cart-outline", "menu_parent" => $permissions_parent->id, "module" => "Bán hàng"],
            [ "title" => "Thêm đơn hàng", "label" => null, "name" => "orders.create", "icon" => "", "menu_parent" => $permissions_parent->id, "module" =>  "Bán hàng"],
            [ "title" => "Sửa đơn hàng", "label" => null, "name" => "orders.edit", "icon" => "", "menu_parent" => $permissions_parent->id, "module" => "Bán hàng"],
            [ "title" => "Chi tiết đơn hàng", "label" => null, "name" => "orders.details", "icon" => "", "menu_parent" => $permissions_parent->id, "module" => "Bán hàng"],
            [ "title" => "Xóa đơn hàng", "label" => null, "name" => "orders.delete", "icon" => "", "menu_parent" => $permissions_parent->id, "module" => "Bán hàng"],
        ];
        Permission::insert($permissions);

        $permissions_parent = Permission::create(["title" => "Sản phẩm", "label" => "Sản phẩm", "name" => "module-products", "icon" => "mdi mdi-alpha-p-box", "menu_parent" => null, "module" => "Hàng hóa", "is_sub" => 1]);
        $permissions = [
            [ "title" => "Danh sách sản phẩm", "label" => "Danh sách sản phẩm", "name" => "products", "icon" => "", "menu_parent" => $permissions_parent->id, "module" => "Hàng hóa"],
            [ "title" => "Thêm sản phẩm", "label" => "Thêm sản phẩm", "name" => "products.create", "icon" => "", "menu_parent" => $permissions_parent->id, "module" => "Hàng hóa"],
            [ "title" => "Sửa sản phẩm", "label" => null, "name" => "products.edit", "icon" => "", "menu_parent" => $permissions_parent->id, "module" => "Hàng hóa"],
            [ "title" => "Chi tiết sản phẩm", "label" => null, "name" => "products.details", "icon" => "", "menu_parent" => $permissions_parent->id, "module" => "Hàng hóa"],
            [ "title" => "Xóa sản phẩm", "label" => null, "name" => "products.delete", "icon" => "", "menu_parent" => $permissions_parent->id, "module" => "Hàng hóa"],
        ];
        Permission::insert($permissions);

        $permissions_parent = Permission::create([ "title" => "Danh mục sản phẩm", "label" => "Danh mục sản phẩm", "name" => "module-product_categories", "icon" => "mdi mdi-text-short", "menu_parent" => null, "module" => "Hàng hóa"]);
        $permissions = [
            [ "title" => "Danh mục sản phẩm", "label" => "Danh mục sản phẩm", "name" => "products.categories", "icon" => "mdi mdi-text-short", "menu_parent" => $permissions_parent->id, "module" => "Hàng hóa"],
            [ "title" => "Thêm danh mục sản phẩm", "label" => null, "name" => "products.categories.create", "icon" => "", "menu_parent" => $permissions_parent->id, "module" => "Hàng hóa"],
            [ "title" => "Sửa danh mục sản phẩm", "label" => null, "name" => "products.categories.update", "icon" => "", "menu_parent" => $permissions_parent->id, "module" => "Hàng hóa"],
            [ "title" => "Chi tiết danh mục sản phẩm", "label" => null, "name" => "product.categories.details", "icon" => "", "menu_parent" => $permissions_parent->id, "module" => "Hàng hóa"],
            [ "title" => "Xóa danh mục sản phẩm", "label" => null, "name" => "products.categories.delete", "icon" => "", "menu_parent" => $permissions_parent->id, "module" => "Hàng hóa"],
        ];
        Permission::insert($permissions);

        $permissions_parent = Permission::create([ "title" => "Bài viết", "label" => "Bài viết", "name" => "module-posts", "icon" => "mdi mdi-newspaper", "menu_parent" => null, "module" => "Marketing", "is_sub" => 1]);
        $permissions = [
            [ "title" => "Danh sách bài viết", "label" => "Danh sách bài viết", "name" => "posts", "icon" => "", "menu_parent" => $permissions_parent->id, "module" => "Marketing",],
            [ "title" => "Thêm bài viết", "label" => "Thêm bài viết", "name" => "posts.create", "icon" => "", "menu_parent" => $permissions_parent->id, "module" => "Marketing"],
            [ "title" => "Sửa bài viết", "label" => null, "name" => "posts.edit", "icon" => "", "menu_parent" => $permissions_parent->id, "module" => "Marketing"],
            [ "title" => "Chi tiết bài viết", "label" => null, "name" => "posts.details", "icon" => "", "menu_parent" => $permissions_parent->id, "module" => "Marketing"],
            [ "title" => "Xóa bài viết", "label" => null, "name" => "posts.delete", "icon" => "", "menu_parent" => $permissions_parent->id, "module" => "Marketing"],
        ];
        Permission::insert($permissions);

        $permissions_parent = Permission::create([ "title" => "Danh mục bài viết", "label" => "Danh mục bài viết", "name" => "module-post_categories", "icon" => "mdi mdi-text-short", "menu_parent" => null, "module" => "Marketing"]);
        $permissions = [
            [ "title" => "Danh mục bài viết", "label" => "Danh mục bài viết", "name" => "posts.categories", "icon" => "mdi mdi-text-short", "menu_parent" => $permissions_parent->id, "module" => "Marketing"],
            [ "title" => "Thêm danh mục bài viết", "label" => null, "name" => "posts.categories.create", "icon" => "", "menu_parent" => $permissions_parent->id, "module" => "Marketing"],
            [ "title" => "Sửa danh mục bài viết", "label" => null, "name" => "posts.categories.edit", "icon" => "", "menu_parent" => $permissions_parent->id, "module" => "Marketing"],
            [ "title" => "Chi tiết danh mục bài viết", "label" => null, "name" => "posts.categories.details", "icon" => "", "menu_parent" => $permissions_parent->id, "module" => "Marketing"],
            [ "title" => "Xóa danh mục bài viết", "label" => null, "name" => "posts.categories.delete", "icon" => "", "menu_parent" => $permissions_parent->id, "module" => "Marketing"],
        ];
        Permission::insert($permissions);

        $permissions_parent = Permission::create([ "title" => "Quảng cáo", "label" => "Quảng cáo", "name" => "module-banners", "icon" => "mdi mdi-web", "menu_parent" => null, "module" => "Marketing"]);
        $permissions = [
            [ "title" => "Quảng cáo", "label" => "Quảng cáo", "name" => "banners", "icon" => "mdi mdi-web", "menu_parent" => $permissions_parent->id, "module" => "Marketing"],
            [ "title" => "Thêm quảng cáo", "label" => null, "name" => "banners.create", "icon" => "", "menu_parent" => $permissions_parent->id, "module" => "Marketing"],
            [ "title" => "Sửa quảng cáo", "label" => null, "name" => "banners.edit", "icon" => "", "menu_parent" => $permissions_parent->id, "module" => "Marketing"],
            [ "title" => "Chi tiết quảng cáo", "label" => null, "name" => "banners.details", "icon" => "", "menu_parent" => $permissions_parent->id, "module" => "Marketing"],
            [ "title" => "Xóa quảng cáo", "label" => null, "name" => "banners.delete", "icon" => "", "menu_parent" => $permissions_parent->id, "module" => "Marketing"],
        ];
        Permission::insert($permissions);

        $permissions_parent = Permission::create([ "title" => "Mã giảm giá", "label" => "Mã giảm giá", "name" => "module-coupons", "icon" => "mdi mdi-ticket-percent", "menu_parent" => null, "module" => "Marketing", "is_sub" => 1]);
        $permissions = [
            [ "title" => "Mã giảm giá", "label" => "Mã giảm giá", "name" => "coupons", "icon" => "", "menu_parent" => $permissions_parent->id, "module" => "Marketing"],
            [ "title" => "Thêm mã giảm giá", "label" => "Thêm mã giảm giá", "name" => "coupons.create", "icon" => "", "menu_parent" => $permissions_parent->id, "module" => "Marketing"],
            [ "title" => "Sửa mã giảm giá", "label" => null, "name" => "coupons.edit", "icon" => "", "menu_parent" => $permissions_parent->id, "module" => "Marketing"],
            [ "title" => "Chi tiết mã giảm giá", "label" => null, "name" => "coupons.details", "icon" => "", "menu_parent" => $permissions_parent->id, "module" => "Marketing"],
            [ "title" => "Xóa mã giảm giá", "label" => null, "name" => "coupons.delete", "icon" => "", "menu_parent" => $permissions_parent->id, "module" => "Marketing"],
        ];
        Permission::insert($permissions);

        $permissions_parent = Permission::create([ "title" => "Thông báo", "label" => "Thông báo", "name" => "module-notifications", "icon" => "mdi mdi-bell-ring", "menu_parent" => null, "module" => "Marketing"]);
        $permissions = [
            [ "title" => "Thông báo", "label" => "Thông báo", "name" => "notifications","icon" => "mdi mdi-bell-ring", "menu_parent" => $permissions_parent->id, "module" => "Marketing"],
            [ "title" => "Thêm thông báo", "label" => null, "name" => "notifications.create", "icon" => "", "menu_parent" => $permissions_parent->id, "module" => "Marketing"],
            [ "title" => "Sửa thông báo", "label" => null, "name" => "notifications.edit", "icon" => "", "menu_parent" => $permissions_parent->id, "module" => "Marketing"],
            [ "title" => "Chi tiết thông báo", "label" => null, "name" => "notifications.details", "icon" => "", "menu_parent" => $permissions_parent->id, "module" => "Marketing"],
            [ "title" => "Xóa thông báo", "label" => null, "name" => "notifications.delete", "icon" => "", "menu_parent" => $permissions_parent->id, "module" => "Marketing"],
        ];
        Permission::insert($permissions);

        $permissions_parent = Permission::create([ "title" => "Khách hàng", "label" => "Khách hàng", "name" => "module-customers", "icon" => "mdi mdi-account-group", "menu_parent" => null, "module" => "Người dùng", "is_sub" => 1]);
        $permissions = [
            [ "title" => "Khách hàng", "label" => "Khách hàng", "name" => "customers", "icon" => "", "menu_parent" => $permissions_parent->id, "module" => "Người dùng"],
            [ "title" => "Thêm khách hàng", "label" => "Thêm khác hàng", "name" => "customers.create", "icon" => "", "menu_parent" => $permissions_parent->id, "module" => "Người dùng"],
            [ "title" => "Sửa khách hàng", "label" => null, "name" => "customers.edit", "icon" => "", "menu_parent" => $permissions_parent->id, "module" => "Người dùng"],
            [ "title" => "Chi tiết khách hàng", "label" => null, "name" => "customers.details", "icon" => "", "menu_parent" => $permissions_parent->id, "module" => "Người dùng"],
            [ "title" => "Xóa khách hàng", "label" => null, "name" => "customers.delete", "icon" => "", "menu_parent" => $permissions_parent->id, "module" => "Người dùng"],
        ];
        Permission::insert($permissions);

        $permissions_parent = Permission::create([ "title" => "Nhân viên", "label" => "Nhân viên", "name" => "module-employees", "icon" => "mdi mdi-account-multiple", "menu_parent" => null, "module" => "Người dùng", "is_sub" => 1]);
        $permissions = [
            [ "title" => "Nhân viên", "label" => "Nhân viên", "name" => "employees", "icon" => "", "menu_parent" => $permissions_parent->id, "module" => "Người dùng"],
            [ "title" => "Thêm nhân viên", "label" => "Thêm nhân viên", "name" => "employees.create", "icon" => "", "menu_parent" => $permissions_parent->id, "module" => "Người dùng"],
            [ "title" => "Sửa nhân viên", "label" => null, "name" => "employees.edit", "icon" => "", "menu_parent" => $permissions_parent->id, "module" => "Người dùng"],
            [ "title" => "Chi tiết nhân viên", "label" => null, "name" => "employees.details", "icon" => "", "menu_parent" => $permissions_parent->id, "module" => "Người dùng"],
            [ "title" => "Xóa nhân viên", "label" => null, "name" => "employees.delete", "icon" => "", "menu_parent" => $permissions_parent->id, "module" => "Người dùng"],
        ];
        Permission::insert($permissions);

        $permissions_parent = Permission::create([ "title" => "Vai trò & Phân quyền", "label" => "Vai trò & Phân quyền", "name" => "module-roles", "icon" => "mdi mdi-pocket", "menu_parent" => null, "module" => "Người dùng"]);
        $permissions = [
            [ "title" => "Vai trò & Phân quyền", "label" => "Vai trò & Phân quyền", "name" => "roles", "icon" => "mdi mdi-pocket", "menu_parent" => $permissions_parent->id, "module" => "Người dùng"],
            [ "title" => "Thêm vai trò", "label" => null, "name" => "roles.create", "icon" => "", "menu_parent" => $permissions_parent->id, "module" => "Người dùng"],
            [ "title" => "Sửa vai trò", "label" => null, "name" => "roles.edit", "icon" => "", "menu_parent" => $permissions_parent->id, "module" => "Người dùng"],
            [ "title" => "Chi tiết vai trò", "label" => null, "name" => "roles.details", "icon" => "", "menu_parent" => $permissions_parent->id, "module" => "Người dùng"],
        ];
        Permission::insert($permissions);

        $permissions_parent = Permission::create([ "title" => "Thiết lâp chung", "label" => "Thiết lập chung", "name" => "settings.business_setup", "icon" => "mdi mdi-book-open-page-variant", "menu_parent" => null, "module" => "Thiết lập"]);
        // business_setup
        $permissions = [
            [ "title" => "Thiết lập chung", "label" => "Thiết lập chung", "name" => "settings.business_setup.page_setup", "icon" => "mdi mdi-book-open-page-variant",  "menu_parent" => null, "menu_parent" => $permissions_parent->id,  "module" => "Thiết lập"],
            [ "title" => "Thiết lập chi nhánh", "label" => null, "name" => "settings.business_setup.branch_setup", "icon" => "", "menu_parent" => $permissions_parent->id, "module" => "Thiết lập"],
            [ "title" => "Thiết lập thông báo", "label" => null, "name" => "settings.business_setup.notification_setup", "icon" => "", "menu_parent" => $permissions_parent->id, "module" => "Thiết lập"],
        ];

        Permission::insert($permissions);

        $permissions_parent = Permission::create([ "title" => "Trang và mạng xã hội", "label" => "Trang và mạng xã hội", "name" => "module-setting_page_medias", "icon" => "mdi mdi-book-open-variant", "menu_parent" => null, "module" => "Thiết lập", "is_sub" => 1]);
        $permissions = [
            [ "title" => "Thiết lập trang", "label" => "Trang", "name" => "settings.page_medias.page_setups", "icon" => "", "menu_parent" => $permissions_parent->id, "module" => "Thiết lập"],
            [ "title" => "Trang Về chúng tôi", "label" => null, "name" => "settings.page_medias.page_setups.about_us", "icon" => "", "menu_parent" => $permissions_parent->id, "module" => "Thiết lập"],
            [ "title" => "Trang Điều khoản và điều kiện", "label" => null, "name" => "settings.page_medias.page_setups.terms_and_condition", "icon" => "", "menu_parent" => $permissions_parent->id, "module" => "Thiết lập"],
            [ "title" => "Trang Chính sách bảo mật", "label" => null, "name" => "settings.page_medias.page_setups.privacy_policy", "icon" => "", "menu_parent" => $permissions_parent->id, "module" => "Thiết lập"],
            [ "title" => "Trang Chính sách trả hàng", "label" => null, "name" => "settings.page_medias.page_setups.return_policy", "icon" => "", "menu_parent" => $permissions_parent->id, "module" => "Thiết lập"],
            [ "title" => "Trang Chính sách hoàn tiền", "label" => null, "name" => "settings.page_medias.page_setups.refund_policy", "icon" => "", "menu_parent" => $permissions_parent->id, "module" => "Thiết lập"],
            [ "title" => "Trang Chính sách hủy", "label" => null, "name" => "settings.page_medias.page_setups.cancellation_policy", "icon" => "", "menu_parent" => $permissions_parent->id, "module" => "Thiết lập"],
            [ "title" => "Mạng xã hội", "label" => "Mạng xã hội", "name" => "settings.social_media", "icon" => "", "menu_parent" => $permissions_parent->id, "module" => "Thiết lập"],
        ];
        Permission::insert($permissions);

        $permissions = [
            [ "title" => "Thiết lập mẫu", "label" => "Thiết lập mẫu", "name" => "settings.template_setups", "icon" => "mdi mdi-television-guide", "menu_parent" => null, "module" => "Thiết lập"],
        ];
        Permission::insert($permissions);

        $permissions_parent = Permission::create([ "title" => "Thiết lập hệ thống", "label" => "Thiết lập hệ thống", "name" => "settings.system_setups", "icon" => "mdi mdi-settings", "menu_parent" => null, "module" => "Thiết lập"]);

        $permissions = [
            [ "title" => "Thiết lập hệ thống", "label" => "Thiết lập hệ thống", "name" => "settings.system_setups", "icon" => "mdi mdi-settings", "menu_parent" => $permissions_parent->id, "module" => "Thiết lập"],
            [ "title" => "Thiết lập mail", "label" => null, "name" => "settings.system_setups.mail", "icon" => "", "menu_parent" => $permissions_parent->id, "module" => "Thiết lập"],
            [ "title" => "Thiết lập thông báo", "label" => null, "name" => "settings.system_setups.notification", "icon" => "", "menu_parent" => $permissions_parent->id, "module" => "Thiết lập"],
            [ "title" => "Thiết lập sms", "label" => null, "name" => "settings.system_setups.sms", "icon" => "", "menu_parent" => $permissions_parent->id, "module" => "Thiết lập"],
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
            "phone" => "0987654321"
        ]);
        $permissions = Permission::get()->pluck(["id"])->toArray();
        $user->syncRoles($role);
        $role->givePermissionTo($permissions);
        // User::factory(100)->create();
    }
}
