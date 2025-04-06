<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bid extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'auction_product_id', 'price'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function auctionProduct()
    {
        return $this->belongsTo(AuctionProduct::class);
    }
}
