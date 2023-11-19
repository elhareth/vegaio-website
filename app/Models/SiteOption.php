<?php

namespace App\Models;

use App\Casts\MassValAttr;
use Elhareth\LaravelEloquentMetable\IsMetable;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SiteOption extends Model
{
    use HasFactory;
    use IsMetable;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

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
        'name',
        'label',
        'value',
        'group',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'is_auto',
    ];

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
        'value' => MassValAttr::class,
        'autoload' => 'boolean',
    ];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = [];

    /**
     * Scope a query to specific group
     *
     * @param  ?string $group
     * @return void
     */
    public function scopeWhereGroup(Builder $query, string $group = null): void
    {
        $query->where('group', $group);
    }

    /**
     * Scope a query to specific group
     *
     * @param  bool $autoload
     * @return void
     */
    public function scopeAutoloaded(Builder $query, bool $autoload = true): void
    {
        $query->where('autoload', $autoload);
    }

    /**
     * Autoload Attribute
     *
     * @return Attribute
     */
    public function isAuto(): Attribute
    {
        return Attribute::make(
            get: fn() => (bool) $this->autoload ? __('platform.switches.yes') : __('platform.switches.no'),
            set: fn(bool $value) => [
                'autoload' => $value,
            ],
        );
    }
}
