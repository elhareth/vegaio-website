<?php

namespace App\Policies;

use App\Enums\UserRole;
use App\Models\ContactMessage;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ContactMessagePolicy
{
    /**
     *
     *
     */
    public function before(User $user)
    {
        return in_array($user->role, [
            UserRole::ADMIN,
            UserRole::MASTER,
        ]);
    }

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
    public function view(User $user, ContactMessage $contactMessage): Response | bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response | bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ContactMessage $contactMessage): Response | bool
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ContactMessage $contactMessage): Response | bool
    {
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ContactMessage $contactMessage): Response | bool
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ContactMessage $contactMessage): Response | bool
    {
        return true;
    }
}
