<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

use App\Concerns\UserModel;
use App\Enums\UserRole;
use App\Enums\UserStatus;
use Orchid\Filters\Types\Like;
use Orchid\Filters\Types\Where;
use Orchid\Filters\Types\WhereDateStartEnd;
use Orchid\Platform\Models\User as Authenticatable;

class UserOrchid extends Authenticatable implements FilamentUser
{
    use UserModel;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'permissions',
        'user_info',
        'user_role',
        'user_status',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'permissions',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_info'             => 'collection',
        'user_role'             => UserRole::class,
        'user_status'           => UserStatus::class,
        'permissions'           => 'array',
        'activated_at'          => 'datetime',
        'email_verified_at'     => 'datetime',
    ];

    /**
     * The attributes for which you can use filters in url.
     *
     * @var array
     */
    protected $allowedFilters = [
        'id'         => Where::class,
        'name'       => Like::class,
        'email'      => Like::class,
        'username'   => Like::class,
        'updated_at' => WhereDateStartEnd::class,
        'created_at' => WhereDateStartEnd::class,
    ];

    /**
     * The attributes for which can use sort in url.
     *
     * @var array
     */
    protected $allowedSorts = [
        'id',
        'name',
        'email',
        'updated_at',
        'created_at',
    ];

    /**
     * Name/Username
     *
     * @return Attribute
     */
    public function name(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->username ?: '',
            set: function ($value): string {
                return str($value)->slug('_');
            }
        );
    }

    /**
     * Check user access level
     *
     * @return bool
     */
    public function canAccessPanel(Panel $panel): bool
    {
        return in_array($this->role, [
            UserRole::ADMIN,
            UserRole::MASTER,
        ]);
    }
}
