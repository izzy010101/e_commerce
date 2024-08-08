<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = [
            'Women',
            'Men',
            'Kids',
            'Baby',
            'Lingerie',
            'School',
            'Offers'
        ];

       foreach ($names as $name) {
           Category::factory()->state(['name' => $name])->create();
       }

    }
}
