<?php

namespace App\Policies;

use App\Enums\UserRole;

use App\Models\User;
use App\Models\Service;

use Illuminate\Auth\Access\Response;

class ServicePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): Response | bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Service $service): Response | bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response | bool
    {
        return in_array($user->role, [
            UserRole::ADMIN,
            UserRole::MASTER,
        ]);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Service $service): Response | bool
    {
        return in_array($user->role, [
            UserRole::ADMIN,
            UserRole::MASTER,
        ]);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Service $service): Response | bool
    {
        return in_array($user->role, [
            UserRole::ADMIN,
            UserRole::MASTER,
        ]);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Service $service): Response | bool
    {
        return in_array($user->role, [
            UserRole::ADMIN,
            UserRole::MASTER,
        ]);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Service $service): Response | bool
    {
        return in_array($user->role, [
            UserRole::ADMIN,
            UserRole::MASTER,
        ]);
    }
}
