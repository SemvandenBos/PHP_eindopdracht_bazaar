<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentalProductReview extends Model
{
    /** @use HasFactory<\Database\Factories\RentalProductReviewFactory> */
    use HasFactory;

    protected $fillable = ['reviewer_id', 'rental_product_id', 'review_text', 'review_score'];


    public function reviewer()
    {
        return $this->belongsTo(User::class);
    }

    public function rentalProduct()
    {
        return $this->belongsTo(RentalProduct::class);
    }
}
