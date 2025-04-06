<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    const ROLE_USER = 'user';
    const ROLE_ADMIN = 'admin';
    const ROLE_BUSINESS_ADVERTISER = 'business_advertiser';
    const ROLE_PERSONAL_ADVERTISER = 'personal_advertiser';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isAdmin()
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isBusinessAdvertiser()
    {
        return $this->role === self::ROLE_BUSINESS_ADVERTISER;
    }

    public function isPersonalAdviser()
    {
        return $this->role === self::ROLE_PERSONAL_ADVERTISER;
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

    public function favourites(): BelongsToMany
    {
        return $this->belongsToMany(RentalProduct::class, 'favourite');
    }

    public function toggleFavourite(RentalProduct $product): void
    {
        $this->favourites()->toggle($product->id);
    }

    public function hasFavourite(RentalProduct $product): bool
    {
        return $this->favourites()->where('rental_product_id', $product->id)->exists();
    }
}
