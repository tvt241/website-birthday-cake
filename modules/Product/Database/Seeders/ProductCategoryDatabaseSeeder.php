<?php

namespace Modules\Product\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Product\Models\ProductCategory;

class ProductCategoryDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductCategory::create([
            "name" => "Quần áo",
            "slug" => "quan-ao",
        ]);

        ProductCategory::factory(5)->state([
            "category_id" => 1
        ])->create();

        ProductCategory::create([
            "name" => "Trang sức",
            "slug" => "trang-suc",
        ]);

        ProductCategory::factory(5)->state([
            "category_id" => 7
        ])->create();

        ProductCategory::factory(5)->state([
            "category_id" => 10
        ])->create();

        ProductCategory::factory(5)->state([
            "category_id" => 15
        ])->create();

        ProductCategory::factory(5)->state([
            "category_id" => 16
        ])->create();

        ProductCategory::factory(5)->state([
            "category_id" => 27
        ])->create();
    }
}
