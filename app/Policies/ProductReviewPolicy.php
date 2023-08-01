<?php

namespace App\Policies;

use App\Models\ProductReview;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductReviewPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, ProductReview $productReview): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, ProductReview $productReview): bool
    {
        return $user->id == $productReview->user_id;
    }

    public function delete(User $user, ProductReview $productReview): bool
    {
        return $user->id == $productReview->user_id;
    }

    public function restore(User $user, ProductReview $productReview): bool
    {
        return true;
    }

    public function forceDelete(User $user, ProductReview $productReview): bool
    {
        return true;
    }
}
