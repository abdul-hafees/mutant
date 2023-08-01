<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;

    /**
     * Perform pre-authorization checks.
     *
     * @param  \App\Models\User|\App\Models\Admin  $user
     * @param  string  $ability
     * @return void|bool
     */
    public function before($user, $ability)
    {
        return true;
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User|\App\Models\Admin  $user
     * @return mixed
     */
    public function viewAny($user)
    {
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User|\App\Models\Admin  $user
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function view($user, Admin $admin)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User|\App\Models\Admin  $user
     * @return mixed
     */
    public function create($user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User|\App\Models\Admin  $user
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function update($user, Admin $admin)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User|\App\Models\Admin  $user
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function delete($user, Admin $admin)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User|\App\Models\Admin  $user
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function restore($user, Admin $admin)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User|\App\Models\Admin  $user
     * @param  \App\Models\Admin  $admin
     * @return mixed
     */
    public function forceDelete($user, Admin $admin)
    {
        //
    }
}
