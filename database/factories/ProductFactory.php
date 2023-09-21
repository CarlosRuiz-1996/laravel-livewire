<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Provider;
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
        $brand = Brand::inRandomOrder()->first(); // Obtiene una marca aleatoria
        $provider = Provider::inRandomOrder()->first(); // Obtiene una marca aleatoria

        return [
            'name'=> fake()->company(),
            'description'=> fake()->sentence(1),
            'price'=> fake()->randomFloat(2, 10, 100),
            'stock'=> fake()->randomNumber(5, false),
            'brand_id'=>$brand->id,
            'provider_id'=>$provider->id
        ];
    }
}
