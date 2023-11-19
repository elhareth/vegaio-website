<?php

namespace App\Policies;

use App\Enums\UserRole;

use App\Models\User;
use App\Models\Article;

use Illuminate\Auth\Access\Response;

class ArticlePolicy
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
    public function view(User $user, Article $article): Response | bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response | bool
    {
        return $user->isActive() || in_array($user->role, [
            UserRole::ADMIN,
            UserRole::AUTHOR,
            UserRole::MASTER,
            UserRole::EDITOR,
        ]);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Article $article): Response | bool
    {
        return ($user->is($article->author) && $user->isActive()) || in_array($user->role, [
            UserRole::ADMIN,
            UserRole::AUTHOR,
            UserRole::MASTER,
            UserRole::EDITOR,
        ]);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Article $article)
    {
        return ($user->is($article->author) && $user->isActive()) || in_array($user->role, [
            UserRole::ADMIN,
            UserRole::AUTHOR,
            UserRole::MASTER,
            UserRole::EDITOR,
        ]);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Article $article): Response | bool
    {
        return ($user->is($article->author) && $user->isActive()) || in_array($user->role, [
            UserRole::ADMIN,
            UserRole::AUTHOR,
            UserRole::MASTER,
        ]);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Article $article): Response | bool
    {
        return in_array($user->role, [
            UserRole::ADMIN,
            UserRole::AUTHOR,
            UserRole::MASTER,
        ]);
    }

    /**
     * Determine whether the user can publish the article model.
     */
    public function publish(User $user, Article $article)
    {
        return in_array($user->role, [
            UserRole::ADMIN,
            UserRole::AUTHOR,
            UserRole::MASTER,
        ]);
    }
}
