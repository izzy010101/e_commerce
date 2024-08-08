<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();

        if ($categories->isEmpty()) {
            echo "No categories found. Exiting seeder.";
            return;
        }

        $productNames = ['Shirt', 'T-Shirt', 'Pants', 'Dress', 'Top', 'Skirt', 'Shorts', 'Onesie'];

        foreach ($categories as $category) {
            foreach ($productNames as $name) {
                for ($i = 0; $i < 5; $i++) {
                    Product::factory()->create([
                        'category_id' => $category->id,
                        'name' => $name . ' ' . ($i + 1),
                    ]);
                }
            }
        }
    }
}
