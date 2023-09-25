<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $product_id = Product::inRandomOrder()->first();
        // Genera una URL de imagen ficticia con Faker
        $imageUrl = fake()->imageUrl(640, 480);

        // Obtiene el contenido de la imagen desde la URL generada
        $imageData = file_get_contents($imageUrl);

        // Genera un nombre único para la imagen
        $imageName = Str::random(10) . '.jpg';

        // Guarda la imagen en el sistema de archivos 'images'
        Storage::disk('products')->put($imageName, $imageData);


        return [
            'path'=> $imageName,
            'product_id' => $product_id->id

        ];
    }
}
