<?php

namespace Database\Seeders;

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
        RentalProduct::factory()->count(20)->create();
    }
}
