<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Determine if the user can view any models.
     */
    public function ViewAny(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine if the user can view the model.
     */
    public function View(User $user, User $model)
    {
        return $user->id === $model->id || $user->isAdmin();
    }

    /**
     * Determine if the user can create models.
     */
    public function Create(User $user)
    {
        return true; // Allow all registered users to create accounts for now
    }

    /**
     * Determine if the user can update the model.
     */
    public function Update(User $user, User $model)
    {
        return $user->id === $model->id || $user->isAdmin();
    }

    /**
     * Determine if the user can delete the model.
     */
    public function Delete(User $user, User $model)
    {
        return $user->isAdmin();
    }
}