<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\RentalProduct;
use App\Models\RentalProductReview;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RentalProductReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $products = RentalProduct::all();

        $reviewPairs = [];

        foreach ($users as $user) {
            foreach ($products->random(rand(3, 7)) as $product) {
                $key = "{$user->id}-{$product->id}";

                //Force uniqueness of reviews
                if (!isset($reviewPairs[$key])) {
                    $reviewPairs[$key] = true;

                    $time = now()->subDays(rand(1, 60));
                    RentalProductReview::factory()->create([
                        'reviewer_id' => $user->id,
                        'rental_product_id' => $product->id,
                        'created_at' => $time,
                        'updated_at' => $time,
                    ]);
                }
            }
        }
    }
}
