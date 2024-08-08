<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            CategoriesTableSeeder::class,
            ProductsTableSeeder::class,
            DownloadImagesSeeder::class,
        ]);


        // Example of creating a specific admin user
        User::firstOrCreate([
            'email' => 'admin@gmail.com'  // Check if this email exists
        ], [
            'name' => 'Isidora',
            'password' => bcrypt('admin'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        \App\Models\User::factory(10)->create();
    }
}
