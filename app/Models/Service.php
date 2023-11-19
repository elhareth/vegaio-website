<?php

namespace App\Models;

use Illuminate\Support\Enumerable;

use App\Concerns\HasCategory;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Elhareth\LaravelEloquentMetable\IsMetable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Plank\Mediable\Mediable;

class Service extends Model
{
    use HasFactory;
    use SoftDeletes;

    use Mediable;
    use IsMetable;
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
        'slug',
        'name',
        'label',
        'description',
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
    protected $casts = [];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = [
        'category',
        'metalist',
    ];

    /**
     * Default Metables
     *
     * @return array
     */
    public function defaultMetables(): array
    {
        return [
            'projects' => [
                'value' => collect([]),
                'group' => null,
            ],
        ];
    }

    /**
     *
     *
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['name'],
            ],
        ];
    }

    /**
     * Get projects collection
     *
     * @return Enumerable
     */
    public function getProjects(): Enumerable
    {
        return collect();
    }

    /**
     * Get service title
     *
     * @param  string $default
     * @return string
     */
    public function getTitle(string $default = ''): string
    {
        return $this->label ?? $default;
    }

    /**
     * Get service description
     *
     * @param  string $default
     * @return string
     */
    public function getDescription(string $default = ''): string
    {
        return $this->description ?? $default;
    }
}
