<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage; // Importa la clase Storage

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Storage::deleteDirectory('products');

        \App\Models\Brand::factory(20)->create();
        \App\Models\Provider::factory(40)->create();
        \App\Models\Category::factory(15)->create();
        \App\Models\Product::factory(100)->create();
        \App\Models\Image::factory(150)->create();


        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
