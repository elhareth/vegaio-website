<?php

namespace App\Observers;

use App\Models\SiteOption;

class SiteOptionObserver
{
    /**
     * Handle the SiteOption "replicating" event.
     */
    public function replicating(SiteOption $option): void
    {
        // ...
    }

    /**
     * Handle the SiteOption "retrieved" event.
     */
    public function retrieved(SiteOption $option): void
    {
        // ...
    }

    /**
     * Handle the SiteOption "creating" event.
     */
    public function creating(SiteOption $option): void
    {
        // ...
    }

    /**
     * Handle the SiteOption "created" event.
     */
    public function created(SiteOption $option): void
    {
        // ...
    }

    /**
     * Handle the SiteOption "updating" event.
     */
    public function updating(SiteOption $option): void
    {
        // ...
    }

    /**
     * Handle the SiteOption "updated" event.
     */
    public function updated(SiteOption $option): void
    {
        // ...
    }

    /**
     * Handle the SiteOption "saving" event.
     */
    public function saving(SiteOption $option): void
    {
        // ...
    }

    /**
     * Handle the SiteOption "saved" event.
     */
    public function saved(SiteOption $option): void
    {
        // ...
    }

    /**
     * Handle the SiteOption "deleting" event.
     */
    public function deleting(SiteOption $option): void
    {
        // ...
    }

    /**
     * Handle the SiteOption "deleted" event.
     */
    public function deleted(SiteOption $option): void
    {
        // ...
    }

    /**
     * Handle the SiteOption "trashed" event.
     */
    public function trashed(SiteOption $option): void
    {
        // ...
    }

    /**
     * Handle the SiteOption "restoring" event.
     */
    public function restoring(SiteOption $option): void
    {
        // ...
    }

    /**
     * Handle the SiteOption "restored" event.
     */
    public function restored(SiteOption $option): void
    {
        // ...
    }

    /**
     * Handle the SiteOption "forceDeleting" event.
     */
    public function forceDeleting(SiteOption $option): void
    {
        // ...
    }

    /**
     * Handle the SiteOption "forceDeleted" event.
     */
    public function forceDeleted(SiteOption $option): void
    {
        // ...
    }
}
