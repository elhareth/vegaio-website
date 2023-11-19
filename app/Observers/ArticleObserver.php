<?php

namespace App\Observers;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

use App\Models\Article;

class ArticleObserver
{
    /**
     * Handle the Article "replicating" event.
     */
    public function replicating(Article $article): void
    {
        // ...
    }

    /**
     * Handle the Article "retrieved" event.
     */
    public function retrieved(Article $article): void
    {
        // ...
    }

    /**
     * Handle the Article "creating" event.
     */
    public function creating(Article $article): void
    {
        //
    }

    /**
     * Handle the Article "created" event.
     */
    public function created(Article $article): void
    {
        // ...
    }

    /**
     * Handle the Article "updating" event.
     */
    public function updating(Article $article): void
    {
        // ...
    }

    /**
     * Handle the Article "updated" event.
     */
    public function updated(Article $article): void
    {
        // ...
    }

    /**
     * Handle the Article "saving" event.
     */
    public function saving(Article $article): void
    {
        // ...
    }

    /**
     * Handle the Article "saved" event.
     */
    public function saved(Article $article): void
    {
        // ...
    }

    /**
     * Handle the Article "deleting" event.
     */
    public function deleting(Article $article): void
    {
        // ...
    }

    /**
     * Handle the Article "deleted" event.
     */
    public function deleted(Article $article): void
    {
        // ...
    }

    /**
     * Handle the Article "trashed" event.
     */
    public function trashed(Article $article): void
    {
        // ...
    }

    /**
     * Handle the Article "restoring" event.
     */
    public function restoring(Article $article): void
    {
        // ...
    }

    /**
     * Handle the Article "restored" event.
     */
    public function restored(Article $article): void
    {
        // ...
    }

    /**
     * Handle the Article "forceDeleting" event.
     */
    public function forceDeleting(Article $article): void
    {
        // ...
    }

    /**
     * Handle the Article "forceDeleted" event.
     */
    public function forceDeleted(Article $article): void
    {
        // ...
    }
}
