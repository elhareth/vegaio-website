<?php

namespace App\Observers;

use App\Models\Service;

class ServiceObserver
{
    /**
     * Handle the Service "replicating" event.
     */
    public function replicating(Service $service): void
    {
        // ...
    }

    /**
     * Handle the Service "retrieved" event.
     */
    public function retrieved(Service $service): void
    {
        // ...
    }

    /**
     * Handle the Service "creating" event.
     */
    public function creating(Service $service): void
    {
        // ...
    }

    /**
     * Handle the Service "created" event.
     */
    public function created(Service $service): void
    {
        // ...
    }

    /**
     * Handle the Service "updating" event.
     */
    public function updating(Service $service): void
    {
        // ...
    }

    /**
     * Handle the Service "updated" event.
     */
    public function updated(Service $service): void
    {
        // ...
    }

    /**
     * Handle the Service "saving" event.
     */
    public function saving(Service $service): void
    {
        // ...
    }

    /**
     * Handle the Service "saved" event.
     */
    public function saved(Service $service): void
    {
        // ...
    }

    /**
     * Handle the Service "deleting" event.
     */
    public function deleting(Service $service): void
    {
        // ...
    }

    /**
     * Handle the Service "deleted" event.
     */
    public function deleted(Service $service): void
    {
        // ...
    }

    /**
     * Handle the Service "trashed" event.
     */
    public function trashed(Service $service): void
    {
        // ...
    }

    /**
     * Handle the Service "restoring" event.
     */
    public function restoring(Service $service): void
    {
        // ...
    }

    /**
     * Handle the Service "restored" event.
     */
    public function restored(Service $service): void
    {
        // ...
    }

    /**
     * Handle the Service "forceDeleting" event.
     */
    public function forceDeleting(Service $service): void
    {
        // ...
    }

    /**
     * Handle the Service "forceDeleted" event.
     */
    public function forceDeleted(Service $service): void
    {
        // ...
    }
}
