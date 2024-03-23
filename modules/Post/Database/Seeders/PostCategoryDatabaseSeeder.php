<?php

namespace Modules\Post\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Post\Models\PostCategory;

class PostCategoryDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PostCategory::create([
            "name" => "Quần áo",
            "slug" => "quan-ao",
        ]);

        PostCategory::factory(5)->state([
            "category_id" => 1
        ])->create();

        PostCategory::create([
            "name" => "Trang sức",
            "slug" => "trang-suc",
        ]);

        PostCategory::factory(5)->state([
            "category_id" => 7
        ])->create();

        PostCategory::factory(5)->state([
            "category_id" => 10
        ])->create();

        PostCategory::factory(5)->state([
            "category_id" => 15
        ])->create();

        PostCategory::factory(5)->state([
            "category_id" => 16
        ])->create();

        PostCategory::factory(5)->state([
            "category_id" => 27
        ])->create();
    }
}
