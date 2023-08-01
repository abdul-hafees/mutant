<?php

namespace App\Policies;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CartPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Cart $cart): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Cart $cart): bool
    {
        return $user->id == $cart->user_id;
    }

    public function delete(User $user, Cart $cart): bool
    {
        return $user->id == $cart->user_id;
    }

    public function restore(User $user, Cart $cart): bool
    {
        return true;
    }

    public function forceDelete(User $user, Cart $cart): bool
    {
        return true;
    }
}
