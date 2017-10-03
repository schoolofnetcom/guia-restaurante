<?php

namespace App\Policies;

use App\User;
use App\Restaurant;

class RestaurantPolicy
{
    public function create(User $user)
    {
        return $user->group === 'restaurant' || $user->group === 'admin' ;
    }

    public function update(User $user, Restaurant $restaurant)
    {
        return $user->id === $restaurant->user_id;
    }

    public function delete(User $user, Restaurant $restaurant)
    {
        return $user->id === $restaurant->user_id;
    }
}
