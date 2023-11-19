<?php

namespace App\Models;

use Elhareth\LaravelEloquentMetable\IsMetable;

use Mews\Purifier\Casts\CleanHtml;
use Mews\Purifier\Casts\CleanHtmlInput;
use Mews\Purifier\Casts\CleanHtmlOutput;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasUuids;
    use HasFactory;
    use SoftDeletes;

    use IsMetable;

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'commetable_id',
        'commetable_type',
        'comment',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'comment' => CleanHtml::class,
    ];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = [
        'user',
        'commentable',
    ];

    /**
     * Default Metables
     *
     * @return array
     */
    protected function defaultMetables(): array
    {
        return [
            'name' => [
                'value' => null,
                'group' => 'user',
            ],
            'email' => [
                'value' => null,
                'group' => 'user',
            ],
            'attachments' => [
                'value' => [],
                'group' => null,
            ],
            'user_data' => [
                'value' => [],
                'group' => null,
            ],
        ];
    }

    /**
     * Relate to user
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relate to commentables
     *
     * @return MorphTo
     */
    public function commentable()
    {
        return $this->morphTo();
    }

    /**
     *
     *
     */
    public function getUserName()
    {
        $name = $this->user ? $this->user->getDisplayName() : null;

        return $this->getMeta('name', $name) ?? $name;
    }

    /**
     *
     *
     */
    public function getUserEmail()
    {
        $email = $this->user ? $this->user->email : null;

        return $this->getMeta('email', $email) ?? $email;
    }
}
