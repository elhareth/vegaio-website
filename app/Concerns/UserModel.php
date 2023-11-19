<?php

namespace App\Concerns;

use App\Models\Article;
use App\Models\Comment;

use Elhareth\LaravelEloquentMetable\IsMetable;
use Plank\Mediable\Mediable;

use App\Models\User;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait UserModel
{
    use UserHasRoles;
    use UserHasStatus;
    use IsMetable;
    use Mediable;

    /**
     * {@inheritDoc}
     */
    protected function defaultMetables(): array
    {
        return [
            'first_name' => [
                'value' => null,
                'group' => 'profile',
            ],
            'last_name' => [
                'value' => null,
                'group' => 'profile',
            ],
            'display_name' => [
                'value' => null,
                'group' => 'profile',
            ],
            'gender' => [
                'value' => null,
                'group' => 'profile',
            ],
            'birthdate' => [
                'value' => null,
                'group' => 'profile',
            ],
            'bio' => [
                'value' => null,
                'group' => 'profile',
            ],
        ];
    }

    /**
     *
     *
     */
    public function getDisplayName()
    {
        return $this->getMeta('display_name', str($this->username)->title());
    }

    /**
     *
     *
     */
    public function getInfoAvatar()
    {
        return $this->user_info?->get('avatar');
    }

    /**
     *
     *
     */
    public function articles()
    {
        return $this->HasMany(Article::class);
    }

    /**
     *
     *
     */
    public function comments()
    {
        return $this->HasMany(Comment::class);
    }
}
