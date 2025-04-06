<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RentalProduct>
 */
class RentalProductFactory extends Factory
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
            'price_per_day' => fake()->numberBetween(10, 100),
            'owner_id' => 2,
            // 'owner_id' => User::inRandomOrder()->first()?->id ?? User::factory()
        ];
    }
}
