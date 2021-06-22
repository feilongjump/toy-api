<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy extends Policy
{
    public function view(User $user, User $model): bool
    {
        return $user->isAuthorOf($model);
    }

    public function update(User $user, User $model): bool
    {
        return $user->isAuthorOf($model);
    }
}
