<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'rental_product_id', 'rented_at', 'return_due_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rentalProduct()
    {
        return $this->belongsTo(RentalProduct::class);
    }
}
