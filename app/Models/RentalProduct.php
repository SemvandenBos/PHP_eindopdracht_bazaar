<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class RentalProduct extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price_per_day', 'owner_id'];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function orders()
    {
        return $this->hasMany(RentalOrder::class);
    }

    public function bids()
    {
        return $this->hasMany(Bid::class);
    }

    public function reviews()
    {
        return $this->hasMany(RentalProductReview::class);
    }

    public function availableTomorrow(): bool
    {
        $tomorrow = Carbon::tomorrow();
        $exists = $this->orders()
            ->whereDate('rent_start_date', '<=', $tomorrow)
            ->whereDate('rent_end_date', '>=', $tomorrow)
            ->exists();

        return !$exists;
    }

    public function available($startDate, $endDate)
    {
        // Convert start and end dates to Carbon instances
        $startDate = Carbon::parse($startDate);
        $endDate = Carbon::parse($endDate);

        // Check if there are any overlapping rentals for the product
        $overlappingRentals = $this->orders()
            ->where(function ($query) use ($startDate, $endDate) {
                $query->whereBetween('rent_start_date', [$startDate, $endDate])
                    ->orWhereBetween('rent_end_date', [$startDate, $endDate])
                    ->orWhere(function ($q) use ($startDate, $endDate) {
                        $q->where('rent_start_date', '<', $startDate)
                            ->where('rent_end_date', '>', $endDate);
                    });
            })
            ->exists();

        // If there are any overlapping rentals, the product is not available
        return !$overlappingRentals;
    }

    public function reviewScore(): float
    {
        return round($this->reviews()->avg('review_score') ?? 0, 1);
    }

    public function favouritedBy(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'favourite');
    }
}
