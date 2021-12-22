<?php

namespace App\Policies;

use App\Models\Todo;
use App\Models\User;

class TodoPolicy extends Policy
{
    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Todo $todo
     * @return bool
     */
    public function view(User $user, Todo $todo)
    {
        return $todo->user_id == $user->id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Todo $todo
     * @return bool
     */
    public function update(User $user, Todo $todo)
    {
        return $todo->user_id == $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Todo $todo
     * @return bool
     */
    public function delete(User $user, Todo $todo)
    {
        return $todo->user_id == $user->id;
    }
}
