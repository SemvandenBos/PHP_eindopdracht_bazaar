<?php

use App\Models\User;
use App\Models\RentalProduct;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rental_product_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'reviewer_id')->constrained();
            $table->foreignIdFor(RentalProduct::class, 'rental_product_id')->constrained()->onDelete('cascade');
            $table->string('review_text')->nullable(false);
            $table->float('review_score')->nullable(false);
            $table->timestamps();

            $table->unique(['reviewer_id', 'rental_product_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rental_product_reviews');
    }
};
