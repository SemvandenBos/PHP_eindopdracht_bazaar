<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PurchasableProduct>
 */
class PurchasableProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'price' => fake()->numberBetween(10, 100),
            'seller_id' => 2,
            // 'seller_id' => User::inRandomOrder()->first()?->id ?? User::factory()
        ];
    }
}
