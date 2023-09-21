<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Provider>
 */
class ProviderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=> fake()->company(),
            'description'=> fake()->sentence(1),
            'email'=> fake()->email(),
            'phone'=> fake()->phoneNumber(),
            'contact'=> fake()->name($gender = ''|'male'|'female') ,
            'web'=> fake()->companyEmail()
        ];
    }
}
