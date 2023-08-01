<?php

namespace App\Policies;

use App\Models\DeliveryAddress;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DeliveryAddressPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, DeliveryAddress $deliveryAddress): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, DeliveryAddress $deliveryAddress): bool
    {
        return $user->id == $deliveryAddress->user_id;
    }

    public function delete(User $user, DeliveryAddress $deliveryAddress): bool
    {
        return $user->id == $deliveryAddress->user_id;
    }

    public function restore(User $user, DeliveryAddress $deliveryAddress): bool
    {
        return true;
    }

    public function forceDelete(User $user, DeliveryAddress $deliveryAddress): bool
    {
        return true;
    }
}
