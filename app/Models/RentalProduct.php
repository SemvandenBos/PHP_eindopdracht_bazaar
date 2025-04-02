<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class RentalProduct extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price_per_day'];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function reviews()
    {
        return $this->hasMany(RentalProductReview::class);
    }

    public function available(): bool
    {
        return !$this->orders()
            ->whereNull('return_due_at')
            ->exists();
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
