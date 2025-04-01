<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentalProduct extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price_per_day'];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
}
