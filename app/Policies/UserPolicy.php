<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function can_edit_packages(User $user)
    {
        return $user->role === 0 || $user->role === 1;
    }
}
