<?php

namespace Database\Factories;

use App\Models\Product;
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
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->sentence(),
            'price' => $this->faker->randomFloat(2, 1, 1000),
            'stock' => $this->faker->numberBetween(10, 100),
            'colors' => json_encode($this->faker->randomElements([
                'Red', 'Blue', 'Green', 'Yellow', 'Black', 'White', 'Purple'
            ], $this->faker->numberBetween(1, 5))),
            // 'category_id' => Category::inRandomOrder()->first()->id, // Remove this line
        ];
    }
}
