<?php

namespace Forum\Policies;

use Forum\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @param User $user
     * @param User $signedInUser
     * @return bool
     */
    public function update(User $user, User $signedInUser)
    {
        return $signedInUser->id === $user->id;
    }
}
