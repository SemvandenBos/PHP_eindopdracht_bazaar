<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AuctionProduct>
 */
class AuctionProductFactory extends Factory
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
            'deadline' => now()->addDays(rand(-2, 5)),
            'owner_id' => 2, //TODO, alleen van advertisers maken
            // 'owner_id' => User::inRandomOrder()->first()?->id ?? User::factory()
        ];
    }
}
