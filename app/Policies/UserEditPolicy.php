<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserEditPolicy
{
    use HandlesAuthorization;


    public function update(User $user)
    {
        return $user->id === Auth::id();
    }
}
