<?php

namespace App\Models;


use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasAvatar;
use Filament\Panel;

use App\Concerns\UserModel;
use App\Enums\UserStatus;
use App\Enums\UserRole;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements FilamentUser, HasAvatar
{
    use HasFactory;
    use Notifiable;
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
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_info'             => AsCollection::class,
        'user_role'             => UserRole::class,
        'user_status'           => UserStatus::class,
        'activated_at'          => 'datetime',
        'email_verified_at'     => 'datetime',
    ];

    /**
     * Name/Username
     *
     * @return Attribute
     */
    public function name(): Attribute
    {
        return Attribute::make(
            get: function () {
                if (isset($this->attributes['username'])) {
                    return $this->attributes['username'];
                }

                return $this->username ?: '';
            },
            set: function (string $value) {
                return [
                    'username' => str($value)->trim()->slug('_')
                ];
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
        // return in_array($this->role, [
        //     UserRole::ADMIN,
        //     UserRole::MASTER,
        // ]);

        $ID = $panel->getId();

        if ('admin' == $ID) {
            return in_array($this->role, [
                UserRole::ADMIN,
                UserRole::MASTER,
            ]);
        }

        if ('dash' == $ID) {
            return in_array($this->role, [
                UserRole::ADMIN,
                UserRole::MASTER,
                UserRole::EDITOR,
            ]);
        }

        return false;
    }

    /**
     * Check user access level
     *
     * @return bool
     */
    public function canManageSettings(): bool
    {
        return in_array($this->role, [
            UserRole::ADMIN,
            UserRole::MASTER,
        ]);
    }

    /**
     * Return avatar url
     *
     * @return ?string
     */
    public function getFilamentAvatarUrl(): ?string
    {
        return asset('uploads/'.$this->getMeta('avatar'));
    }
}
