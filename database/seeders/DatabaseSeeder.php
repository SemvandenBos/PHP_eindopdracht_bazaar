<?php

namespace Database\Seeders;

use App\Models\AuctionProduct;
use App\Models\RentalProduct;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'asdfasdf',
            'role' => 'user'
        ]);

        User::factory()->create([
            'name' => 'Test personal advertiser',
            'email' => 'advertiser@example.com',
            'password' => 'asdfasdf',
            'role' => 'personal_advertiser',
        ]);

        User::factory()->create([
            'name' => 'Test business',
            'email' => 'business@example.com',
            'password' => 'asdfasdf',
            'role' => 'business_advertiser',
        ]);

        User::factory()->create([
            'name' => 'Test admin',
            'email' => 'admin@example.com',
            'password' => 'asdfasdf',
            'role' => 'admin',
        ]);


        User::factory(10)->create();
        RentalProduct::factory(10)->create();

        $this->call([
            AuctionProductSeeder::class
        ]);

        $this->call([
            RentalProductReviewSeeder::class
        ]);

        $this->call([
            RentalOrderSeeder::class
        ]);
    }
}
