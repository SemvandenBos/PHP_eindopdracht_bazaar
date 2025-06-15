<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\RentalProduct;
use App\Models\RentalProductReview;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RentalProductReview>
 */
class RentalProductReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        do {
            $user = User::inRandomOrder()->first() ?? User::factory()->create();
            $product = RentalProduct::inRandomOrder()->first() ?? RentalProduct::factory()->create();
        } while (RentalProductReview::where('reviewer_id', $user->id)
                ->where('rental_product_id', $product->id)
                ->exists());

        return [
            'reviewer_id' => $user->id,
            'rental_product_id' => $product->id,
            'review_text' => fake()->paragraph(),
            'review_score' => fake()->randomFloat(1, 1, 5),
        ];
    }
}
