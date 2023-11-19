<?php

namespace App\Models;

use Exception;

use App\Concerns\HasCategory;
use App\Concerns\HasComments;
use App\Enums\ArticleStatus;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

use Elhareth\LaravelEloquentMetable\IsMetable;
use Mews\Purifier\Casts\CleanHtml;
use Mews\Purifier\Casts\CleanHtmlInput;
use Mews\Purifier\Casts\CleanHtmlOutput;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Plank\Mediable\Mediable;

class Article extends Model
{
    use HasFactory;
    use SoftDeletes;

    use Mediable;
    use IsMetable;
    use HasComments;
    use HasCategory;

    use Sluggable;
    use SluggableScopeHelpers;

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
        'slug',
        'title',
        'status',
        'content',
        'published_at',
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
        'status' => ArticleStatus::class,
        'content' => CleanHtml::class,
        'published_at' => 'datetime',
    ];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = [
        'author',
        'category',
    ];

    /**
     * Scope a query to only include articles with draft status.
     *
     * @return void
     */
    public function scopeStatusDraft(Builder $query): void
    {
        $query->where('status', ArticleStatus::DRAFT);
    }

    /**
     * Scope a query to only include articles with banned status.
     *
     * @return void
     */
    public function scopeStatusBanned(Builder $query): void
    {
        $query->where('status', ArticleStatus::BANNED);
    }

    /**
     * Scope a query to only include articles with closed status.
     *
     * @return void
     */
    public function scopeStatusClosed(Builder $query): void
    {
        $query->where('status', ArticleStatus::CLOSED);
    }

    /**
     * Scope a query to only include articles with closed status.
     *
     * @return void
     */
    public function scopeStatusPrivate(Builder $query): void
    {
        $query->where('status', ArticleStatus::PRIVATE);
    }

    /**
     * Scope a query to only include articles with pending status.
     *
     * @return void
     */
    public function scopeStatusPending(Builder $query): void
    {
        $query->where('status', ArticleStatus::PENDING);
    }

    /**
     * Scope a query to only include articles with approve status.
     *
     * @return void
     */
    public function scopeStatusApprove(Builder $query): void
    {
        $query->where('status', ArticleStatus::APPROVE);
    }

    /**
     * Scope a query to only include articles with publish status.
     *
     * @return void
     */
    public function scopeStatusPublish(Builder $query): void
    {
        $query->where('status', ArticleStatus::PUBLISH);
    }

    /**
     * Scope a query to only include articles with deleted status.
     *
     * @return void
     */
    public function scopeStatusDeleted(Builder $query): void
    {
        $query->where('status', ArticleStatus::DELETED);
    }

    /**
     * Scope a query to only include published articles.
     *
     * @return void
     */
    public function scopeBlogged(Builder $query): void
    {
        $blog = Category::with([])->firstWhere('slug', 'blog');
    }

    /**
     * Scope a query to only include published articles.
     *
     * @return void
     */
    public function scopePublished(Builder $query): void
    {
        $query->where('status', ArticleStatus::PUBLISH)
            ->where('published_at', '<', now());
    }

    /**
     *
     *
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['title'],
            ],
        ];
    }

    /**
     * Relate with user
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Author : Relate with user
     *
     * @return BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Check article status
     *
     * @param string|ArticeStatus $status
     * @return bool
     */
    public function statusIs(string|ArticleStatus $status)
    {
        if (is_string($status)) {
            $status = ArticleStatus::tryFrom($status);
        }

        throw_if(is_null($status), new Exception('Undefined status!'));

        if (isset($this->status)) {
            return $this->status === $status;
        }

        // Needs review && enhancement
        return false;
    }

    /**
     * Check whether the article os published or not
     *
     * @return bool
     */
    public function isPublished()
    {
        return $this->published_at <= now() && $this->statusIs(ArticleStatus::PUBLISH);
    }

    /**
     * Publish Article
     *
     * @return static
     */
    public function publish(): static
    {
        if ($this->isPublished()) {
            return $this;
        }

        if (!$this->statusIs(ArticleStatus::PUBLISH)) {
            $this->status = ArticleStatus::PUBLISH;
        }

        if (empty($this->published_at) || $this->published_at > now()) {
            $this->published_at = now();
        }

        $this->push();

        return $this;
    }
}
