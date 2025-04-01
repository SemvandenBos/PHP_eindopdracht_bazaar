<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function manageUsers(User $user): bool
    {
        return $user->role === 'admin';
    }

    public function advertise(User $user): bool
    {
        return in_array($user->role, ['business_advertiser', 'personal_advertiser']);
    }
}