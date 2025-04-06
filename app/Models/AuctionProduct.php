<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class AuctionProduct extends Model
{
    /** @use HasFactory<\Database\Factories\AuctionProductFactory> */
    use HasFactory;

    protected $fillable = ['name', 'price', 'deadline'];

    public function owner()
    {
        return $this->belongsTo(User::class);
    }
}
