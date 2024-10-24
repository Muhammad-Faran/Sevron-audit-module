<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update their profile.
     *
     * @param  \App\Models\User  $authUser
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function update(User $authUser, User $user)
    {
        // Allow if the authenticated user is the same as the user being updated
        return $authUser->id === $user->id;
    }

    // Other policy methods...
}
