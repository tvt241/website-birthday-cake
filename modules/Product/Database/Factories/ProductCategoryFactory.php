<?php

namespace Modules\Product\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


class ProductCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Product\Models\ProductCategory::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $name = fake()->name();
        $slug = Str::slug($name);
        return [
            "name" => $name,
            "slug" => $slug,
            "is_active" => 1
        ];
    }
}

