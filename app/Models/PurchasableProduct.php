<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchasableProduct extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'seller_id'];

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }
}