<?php

namespace Modules\Product\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductCategory;

class ProductCategoryDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hostPath = "/storage/categories/";
        
        $category = ProductCategory::create([
            "name" => "Mới - Bán chạy",
            "slug" => "moi-ban-chạy",
        ]);
        $category->image()->create(["url" => $hostPath . "ban-chay.jpeg"]);

        $category = ProductCategory::create([
            "name" => "Tặng người yêu",
            "slug" => "tang-nguoi-yeu",
        ]);
        $category->image()->create(["url" => $hostPath . "tang-nguoi-yeu.jpg"]);

        $category = ProductCategory::create([
            "name" => "Vợ/ Chị em gái",
            "slug" => "tang-vo-chi-em-gai",
        ]);
        $category->image()->create(["url" => $hostPath . "tang-vo-chi-em-gai.jpg"]);

        $category = ProductCategory::create([
            "name" => "Chồng/ Anh em trai",
            "slug" => "tang-chong-anh-em-trai",
        ]);
        $category->image()->create(["url" => $hostPath . "tang-chong-anh-em-trai.jpg"]);

        $category = ProductCategory::create([
            "name" => "Bố/ Mẹ",
            "slug" => "tang-bo-me",
        ]);
        $category->image()->create(["url" => $hostPath . "tang-cha-me.jpg"]);

        $category = ProductCategory::create([
            "name" => "Sếp/ Khách hàng",
            "slug" => "tang-sep-khach-hang",
        ]);
        $category->image()->create(["url" => $hostPath . "tang-sep-doi-tac.jpg"]);

        $categoryParent = ProductCategory::create([
            "name" => "Bánh tầng",
            "slug" => "banh-tang",
        ]);
        $categoryParent->image()->create(["url" => $hostPath . "banh-nhieu-tang.jpg"]);

        $category = ProductCategory::create([
            "name" => "Bánh 1 tầng",
            "slug" => "banh-1-tang",
            "category_id" => $categoryParent->id
        ]);
        $category->image()->create(["url" => $hostPath . "banh-1-tang.jpg"]);

        $category = ProductCategory::create([
            "name" => "Bánh 2 tầng",
            "slug" => "banh-2-tang",
            "category_id" => $categoryParent->id
        ]);
        $category->image()->create(["url" => $hostPath . "banh-2-tang.jpeg"]);

        $category = ProductCategory::create([
            "name" => "Bánh 3 tầng",
            "slug" => "banh-3-tang",
            "category_id" => $categoryParent->id
        ]);
        $category->image()->create(["url" => $hostPath . "banh-3-tang.jpg"]);

        $category = ProductCategory::create([
            "name" => "Bánh 4 tầng",
            "slug" => "banh-4-tang",
            "category_id" => $categoryParent->id
        ]);
        $category->image()->create(["url" => $hostPath . "banh-4-tang.jpg"]);

        $category = ProductCategory::create([
            "name" => "Đồ trang chí",
            "slug" => "do-trang-chi",
        ]);
        $category->image()->create(["url" => $hostPath . "phu-kien.jpg"]);
    }
}
