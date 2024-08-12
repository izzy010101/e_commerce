<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Image;
use Faker\Factory as Faker;

class DownloadImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Define category-specific keywords for image generation
        $categoryKeywords = [
            'women' => 'fashion',
            'men' => 'fashion',
            'kids' => 'children',
            'baby' => 'babies',
            'lingerie' => 'lingerie',
            'school' => 'shoes',
            'offers' => 'special_offers',

        ];

        // Get all products and attach 4 images to each product based on category
        Product::with('category')->get()->each(function ($product) use ($faker, $categoryKeywords) {
            $categoryName = strtolower($product->category->name);

            // Determine the keyword based on the category
            $keyword = $categoryKeywords[$categoryName] ?? 'clothing'; // Default to 'clothing' if category is not found

            for ($i = 0; $i < 4; $i++) {
                Image::create([
                    'product_id' => $product->id,
                    'path' => $faker->imageUrl(320, 240, $keyword, true),
                ]);
            }
        });
    }
}
