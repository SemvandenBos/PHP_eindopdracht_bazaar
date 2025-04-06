<?php

namespace Database\Seeders;

use App\Models\AuctionProduct;
use App\Models\User;
use App\Models\Bid;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuctionProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $auctionProducts = AuctionProduct::factory(10)->create();
        $users = User::all();

        //Unique bids, also only going up in time and price
        //Maybe todo: cleaner way of making sure that $bidTime is not after the deadline -> basing the rand() from 1 to $timeLeft or something
        foreach ($auctionProducts as $product) {
            $lowestBid = fake()->numberBetween(10, 100);
            $bidTime = $product->deadline->copy()->subHours(48);

            foreach ($users->random(rand(0, 3)) as $user) {
                $lowestBid += rand(0, 3);
                $bidTime = $bidTime->addHours(rand(1, 10));

                Bid::factory()->create([
                    'price' => $lowestBid,
                    'user_id' => $user->id,
                    'auction_product_id' => $product->id,
                    'created_at' => $bidTime,
                    'updated_at' => $bidTime,
                ]);
            }
        }
    }
}
