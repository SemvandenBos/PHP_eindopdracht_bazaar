<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\RentalProduct;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RentalProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Dit lijkt omslachtig, maar als je in de factory hetzelfde probeert bij definition wordt het gecached en krijg je maar 1 id
        RentalProduct::factory()
            ->count(20)
            ->make()
            ->each(function ($product) {
                $advertisers = User::whereIn('role', ['personal_advertiser', 'business_advertiser'])->get();
                $product->owner_id = $advertisers->random()->id;
                $product->save();
            });
    }
}
