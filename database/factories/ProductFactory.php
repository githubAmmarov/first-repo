<?php

namespace Database\Factories;

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

        return [
            'scientific_name' => fake()->name(),
            'commercial_name' => fake()->name(),
            'category' => fake()->name(),
            'manufacturer' => fake()->company(),
            'price' => 10000,
            'expire_date' => fake()->date(),
        ];
    }
}
