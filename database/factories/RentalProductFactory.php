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
            'name' => fake()->randomElement([
                'Fast',
                'Cozy',
                'Eco',
                'Compact',
                'Luxury',
                'Reliable',
                'Speedy',
                'Modern',
                'Smart',
                'Urban',
                'Stylish',
                'Classic',
                'Bold',
                'Clean'
            ]) . ' ' . fake()->randomElement([
                'Car',
                'Bike',
                'Scooter',
                'Van',
                'Motorbike',
                'Truck',
                'Electric Bike',
                'SUV',
                'Convertible',
                'eScooter',
                'Pickup',
                'Minivan',
                'Camper',
                'Jeep'
            ]),
            'price_per_day' => fake()->numberBetween(10, 100),
        ];
    }
}
