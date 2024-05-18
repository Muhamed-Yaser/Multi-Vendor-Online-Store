<?php

namespace Database\Factories;

use App\Models\Store;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->name;
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'store_id' => Store::inRandomOrder()->first()->id,
            'category_id' => Category::inRandomOrder()->first()->id,
            'description' => $this->faker->sentence(12),
            'image' => $this->faker->imageUrl(300 , 400),
            'price' => rand(1 , 499),
            'compart_price' => rand(500 , 999),
            'featured' => rand(0 , 1)
        ];
    }
}
