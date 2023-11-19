<?php

namespace App\Observers;

use App\Models\Comment;

class CommentObserver
{
    /**
     * Handle the Comment "replicating" event.
     */
    public function replicating(Comment $comment): void
    {
        // ...
    }

    /**
     * Handle the Comment "retrieved" event.
     */
    public function retrieved(Comment $comment): void
    {
        // ...
    }

    /**
     * Handle the Comment "creating" event.
     */
    public function creating(Comment $comment): void
    {
        // ...
    }

    /**
     * Handle the Comment "created" event.
     */
    public function created(Comment $comment): void
    {
        // ...
    }

    /**
     * Handle the Comment "updating" event.
     */
    public function updating(Comment $comment): void
    {
        // ...
    }

    /**
     * Handle the Comment "updated" event.
     */
    public function updated(Comment $comment): void
    {
        // ...
    }

    /**
     * Handle the Comment "saving" event.
     */
    public function saving(Comment $comment): void
    {
        // ...
    }

    /**
     * Handle the Comment "saved" event.
     */
    public function saved(Comment $comment): void
    {
        // ...
    }

    /**
     * Handle the Comment "deleting" event.
     */
    public function deleting(Comment $comment): void
    {
        // ...
    }

    /**
     * Handle the Comment "deleted" event.
     */
    public function deleted(Comment $comment): void
    {
        // ...
    }

    /**
     * Handle the Comment "trashed" event.
     */
    public function trashed(Comment $comment): void
    {
        // ...
    }

    /**
     * Handle the Comment "restoring" event.
     */
    public function restoring(Comment $comment): void
    {
        // ...
    }

    /**
     * Handle the Comment "restored" event.
     */
    public function restored(Comment $comment): void
    {
        // ...
    }

    /**
     * Handle the Comment "forceDeleting" event.
     */
    public function forceDeleting(Comment $comment): void
    {
        // ...
    }

    /**
     * Handle the Comment "forceDeleted" event.
     */
    public function forceDeleted(Comment $comment): void
    {
        // ...
    }
}
