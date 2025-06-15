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
            'name' => fake()->randomElement([
                'Vintage',
                'Modern',
                'Cozy',
                'Stylish',
                'Elegant',
                'Minimalist',
                'Trendy',
                'Retro',
                'Classic',
                'Comfy',
                'Durable',
                'Worn',
                'Chic',
                'Sleek',
                'Soft',
                'Faded',
                'Bright',
                'Muted',
                'Handmade',
                'Rare'
            ]) . ' ' . fake()->randomElement([
                'Jacket',
                'Backpack',
                'Chair',
                'Sofa',
                'T-Shirt',
                'Table',
                'Lamp',
                'Watch',
                'Mirror',
                'Coat',
                'Sneakers',
                'Blender',
                'Microwave',
                'Coffee Table',
                'Phone',
                'Headphones',
                'Book',
                'Rug',
                'Painting',
                'Shelf',
                'Camera',
                'Hat',
                'Desk',
                'Dress',
                'Fan',
                'Speaker'
            ]),
            'price' => fake()->numberBetween(10, 100),
            'deadline' => now()->addDays(rand(-10, 6)),
        ];
    }
}
