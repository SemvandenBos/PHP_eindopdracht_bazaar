<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;


class AuctionProduct extends Model
{
    /** @use HasFactory<\Database\Factories\AuctionProductFactory> */
    use HasFactory;

    protected $fillable = ['name', 'price', 'deadline'];

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function available()
    {
        return $this->timeLeft()->invert === 0;
    }

    public function bids()
    {
        return $this->hasMany(Bid::class);
    }

    public function highestBid()
    {
        $highestBid = $this->bids()->orderByDesc('price')->first();
        return ($highestBid == null) ? 0 : $highestBid->price;
    }

    public function timeLeft()
    {
        return Carbon::now()->diff($this->deadline, false);
    }
}
