<?php

use App\Models\AuctionProduct;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('auction_products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->double('price');
            $table->foreignIdFor(User::class, 'owner_id');
            $table->date('deadline');
            $table->timestamps();
        });

        Schema::create('bids', function (Blueprint $table) {
            $table->float('price');
            $table->foreignIdFor(User::class, 'user_id')->constrained()->onDelete('cascade');
            $table->foreignIdFor(AuctionProduct::class, 'auction_product_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            $table->primary(['user_id', 'auction_product_id']);
        });

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auction_products');
        Schema::dropIfExists('bids');
    }
};
