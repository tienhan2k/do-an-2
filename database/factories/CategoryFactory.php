<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Category;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = \App\Models\Category::class;

    public function definition()
    {
        return [
            'name' => fake()->unique->name(),
            'slug' => Str::slug(fake()->text()),
            'description' => fake()->paragraph,
            'image' => fake()->imageUrl(640, 480),
            'meta_title' => fake()->text(),
            'meta_keyword' => fake()->text(),
            'meta_description' => fake()->realText($maxNbChars = 50),
            'status' => 1,
        ];
    }
}
