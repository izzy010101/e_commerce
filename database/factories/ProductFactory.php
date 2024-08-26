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
            'images_urls' => json_encode($this->generatePicsumUrls()),
        ];
    }

    /**
     * Generate an array of Picsum image URLs.
     *
     * @return array<string>
     */
    protected function generatePicsumUrls(): array
    {
        $numImages = $this->faker->numberBetween(1, 4); // Random number of images
        $urls = [];

        for ($i = 0; $i < $numImages; $i++) {
            $width = $this->faker->numberBetween(300, 800);
            $height = $this->faker->numberBetween(300, 800);
            $urls[] = "https://picsum.photos/{$width}/{$height}?random=" . $this->faker->numberBetween(1, 10000);
        }

        return $urls;
    }
}
