<?php

namespace App\Observers;

use App\Models\Category;

class CategoryObserver
{
    /**
     * Handle the Category "replicating" event.
     */
    public function replicating(Category $category): void
    {
        // ...
    }

    /**
     * Handle the Category "retrieved" event.
     */
    public function retrieved(Category $category): void
    {
        // ...
    }

    /**
     * Handle the Category "creating" event.
     */
    public function creating(Category $category): void
    {
        // ...
    }

    /**
     * Handle the Category "created" event.
     */
    public function created(Category $category): void
    {
        // ...
    }

    /**
     * Handle the Category "updating" event.
     */
    public function updating(Category $category): void
    {
        // ...
    }

    /**
     * Handle the Category "updated" event.
     */
    public function updated(Category $category): void
    {
        // ...
    }

    /**
     * Handle the Category "saving" event.
     */
    public function saving(Category $category): void
    {
        // ...
    }

    /**
     * Handle the Category "saved" event.
     */
    public function saved(Category $category): void
    {
        // ...
    }

    /**
     * Handle the Category "deleting" event.
     */
    public function deleting(Category $category): void
    {
        // ...
    }

    /**
     * Handle the Category "deleted" event.
     */
    public function deleted(Category $category): void
    {
        // ...
    }

    /**
     * Handle the Category "trashed" event.
     */
    public function trashed(Category $category): void
    {
        // ...
    }

    /**
     * Handle the Category "restoring" event.
     */
    public function restoring(Category $category): void
    {
        // ...
    }

    /**
     * Handle the Category "restored" event.
     */
    public function restored(Category $category): void
    {
        // ...
    }

    /**
     * Handle the Category "forceDeleting" event.
     */
    public function forceDeleting(Category $category): void
    {
        // ...
    }

    /**
     * Handle the Category "forceDeleted" event.
     */
    public function forceDeleted(Category $category): void
    {
        // ...
    }
}
