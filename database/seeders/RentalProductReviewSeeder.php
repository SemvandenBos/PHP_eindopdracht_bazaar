<?php

namespace Database\Seeders;

use App\Models\RentalOrder;
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
        $orders = RentalOrder::with(['user', 'rentalProduct'])->get();

        $reviewPairs = [];

        foreach ($orders as $order) {
            $key = "{$order->user->id}-{$order->rentalProduct->id}";
            if (!isset($reviewPairs[$key])) {
                $time = now()->subDays(rand(1, 60));
                RentalProductReview::factory()->create([
                    'reviewer_id' => $order->user->id,
                    'rental_product_id' => $order->rentalProduct->id,
                    'created_at' => $time,
                    'updated_at' => $time,
                ]);

                $reviewPairs[$key] = true;
            }
        }
    }
}
