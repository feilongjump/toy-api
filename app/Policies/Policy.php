<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class Policy
{
    use HandlesAuthorization;

    public function before($user, $ability): ?bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        return null;
    }
}
