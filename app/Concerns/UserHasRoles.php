<?php

namespace App\Concerns;

use App\Enums\UserRole;

use Illuminate\Contracts\Database\Eloquent\Builder as BuilderInterface;
use Illuminate\Database\Eloquent\Casts\Attribute;

trait UserHasRoles
{
    /**
     * Scope a query to only include popular users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWhereRole(BuilderInterface $query, string|UserRole $role)
    {
        $role = is_string($role) ? UserRole::tryFrom($role) : $role;
        $query->where('user_role', $role);
    }

    /**
     *
     *
     */
    protected function role() : Attribute
    {
        return new Attribute(
            get: fn() => $this->user_role,
            set: fn(UserRole $role) => ['user_role' => $role]
        );
    }

    /**
     * Get User Role Text | Translated
     *
     * @return string
     */
    public function getUserRole()
    {
        if ($this->role instanceof UserRole) {
            return __('user.ROLE.' . $this->role->value);
        }

        if ($this->role) {
            return __('user.ROLE.' . $this->role);
        }

        return __('general.undefined');
    }

    /**
     *
     *
     */
    public function setAsUser()
    {
        $this->role = UserRole::USER;

        return $this;
    }

    /**
     *
     *
     */
    public function setAsAdmin()
    {
        $this->role = UserRole::ADMIN;
        return $this;
    }

    /**
     *
     *
     */
    public function setAsMaster()
    {
        $this->role = UserRole::MASTER;
        return $this;
    }

    /**
     *
     *
     */
    public function setAsAuthor()
    {
        $this->role = UserRole::AUTHOR;
        return $this;
    }

    /**
     *
     *
     */
    public function setAsEditor()
    {
        $this->role = UserRole::EDITOR;
        return $this;
    }



    /**
     * Determine if user role matched
     *
     * @param UserRole $role
     * @return bool
     */
    public function roleIs(UserRole $role) : bool
    {
        return $this->role === $role;
    }

    /**
     * Check if user role is user
     *
     * @return bool
     */
    public function isUser()
    {
        return $this->roleIs(UserRole::USER);
    }

    /**
     * Check if user role is Admin
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->roleIs(UserRole::ADMIN);
    }

    /**
     * Check if user role is master
     *
     * @return bool
     */
    public function isMaster()
    {
        return $this->roleIs(UserRole::MASTER);
    }

    /**
     * Check if user role is author
     *
     * @return bool
     */
    public function isAuthor()
    {
        return $this->roleIs(UserRole::AUTHOR);
    }

    /**
     * Check if user role is editor
     *
     * @return bool
     */
    public function isEditor()
    {
        return $this->roleIs(UserRole::EDITOR);
    }
}
