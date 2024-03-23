<?php

namespace Modules\Post\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


class PostCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\Post\Models\PostCategory::class;

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
        ];
    }
}

