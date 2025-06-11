<?php

namespace Database\Seeders;

use App\Models\RentalOrder;
use App\Models\User;
use App\Models\RentalProduct;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RentalOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $products = RentalProduct::all();

        foreach ($users as $user) {
            foreach ($products->random(rand(2, 4)) as $product) {
                $startDate = now()->addDays(rand(-5, 10));
                $endDate = $startDate->addDays(rand(0, 2));

                if ($product->available($startDate, $endDate)) {
                    $time = now()->subDays(rand(1, 60));
                    RentalOrder::factory()->create([
                        'user_id' => $user->id,
                        'rental_product_id' => $product->id,
                        'rent_start_date' => $startDate->toDateString(),
                        'rent_end_date' => $endDate->toDateString(),
                    ]);
                }
            }
        }
    }
}
