<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    /**
     * Handle the User "replicating" event.
     */
    public function replicating(User $user): void
    {
        // ...
    }

    /**
     * Handle the User "retrieved" event.
     */
    public function retrieved(User $user): void
    {
        // ...
    }

    /**
     * Handle the User "creating" event.
     */
    public function creating(User $user): void
    {
        // ...
    }

    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        // ...
    }

    /**
     * Handle the User "updating" event.
     */
    public function updating(User $user): void
    {
        // ...
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        // ...
    }

    /**
     * Handle the User "saving" event.
     */
    public function saving(User $user): void
    {
        // ...
    }

    /**
     * Handle the User "saved" event.
     */
    public function saved(User $user): void
    {
        // ...
    }

    /**
     * Handle the User "deleting" event.
     */
    public function deleting(User $user): void
    {
        // ...
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        // ...
    }

    /**
     * Handle the User "trashed" event.
     */
    public function trashed(User $user): void
    {
        // ...
    }

    /**
     * Handle the User "restoring" event.
     */
    public function restoring(User $user): void
    {
        // ...
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        // ...
    }

    /**
     * Handle the User "forceDeleting" event.
     */
    public function forceDeleting(User $user): void
    {
        // ...
    }

    /**
     * Handle the User "forceDeleted" event.
     */
    public function forceDeleted(User $user): void
    {
        // ...
    }
}
