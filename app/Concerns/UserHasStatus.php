<?php

namespace App\Concerns;

use App\Enums\UserStatus;

use Illuminate\Contracts\Database\Eloquent\Builder as BuilderInterface;
use Illuminate\Database\Eloquent\Casts\Attribute;

trait UserHasStatus
{
    /**
     * Scope a query to only include popular users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWhereStatus(BuilderInterface $query, string|UserStatus $status)
    {
        $status = is_string($status) ? UserStatus::tryFrom($status) : $status;
        $query->where('user_status', $status);
    }

    /**
     * User Status Accessor/Mutator
     *
     * @return Attribute
     */
    protected function status(): Attribute
    {
        return new Attribute(
            get: fn () => $this->user_status,
            set: fn (UserStatus $status) => ['user_status'=>$status],
        );
    }

    /**
     * Get User Status
     *
     * @return string
     */
    public function getUserStatus()
    {
        if ($this->user_status instanceof UserStatus) {
            return __('user.STATUS.'.$this->user_status->value);
        }

        if ($this->user_status) {
            return __('user.STATUS.'.$this->user_status);
        }

        return __('actions.undefined');
    }

    /**
     * Set User Status => Active
     *
     * @return User
     */
    public function userActivate()
    {
        $this->user_status = UserStatus::ACTIVE;
        $this->activated_at = now();

        return $this;
    }

    /**
     * Set User Status => Banned
     *
     * @param  int|bool $days
     * @return User
     */
    public function userBan(int|bool $days = false)
    {
        //
        $this->user_status = UserStatus::BANNED;

        if ($days === false) {
            $this->activated_at = null;
        } else {
            $this->activated_at = now()->addDays($days);
        }

        return $this;
    }

    /**
     * Set User Status => Pending
     *
     * @param  int|bool $days
     * @return User
     */
    public function userPend(int|bool $days = false)
    {
        //
        $this->user_status = UserStatus::PENDING;

        if ($days === false) {
            $this->activated_at = null;
        } else {
            $this->activated_at = now()->addDays($days);
        }

        return $this;
    }

    /**
     * Set User Status => Supspending
     *
     * @param  int|bool $days
     * @return User
     */
    public function userSuspend(int|bool $days = false)
    {
        //
        $this->user_status = UserStatus::SUSPENDED;

        if ($days === false) {
            $this->activated_at = null;
        } else {
            $this->activated_at = now()->addDays($days);
        }

        return $this;
    }

    /**
     * Set User Status => Blocked
     *
     * @param  int|bool $days
     * @return User
     */
    public function userBlock(int|bool $days = false)
    {
        $this->user_status = UserStatus::BLOCKED;

        if ($days === false) {
            $this->activated_at = null;
        } else {
            $this->activated_at = now()->addDays($days);
        }

        return $this;
    }


    /**
     * Determine if user stats is matched
     *
     * @param  UserStatus $status //
     * @return bool
     */
    public function statusIs(UserStatus $status) : bool
    {
        return $this->user_status === $status;
    }

    /**
     * Check if user status is Active
     *
     * @return bool
     */
    public function isActive()
    {
        return $this->statusIs(UserStatus::ACTIVE) && ($this->activated_at  && $this->activated_at < (string) now());
    }

    /**
     * Check if user status is Pending
     *
     * @return bool
     */
    public function isPending()
    {
        return $this->statusIs(UserStatus::PENDING);
    }

    /**
     * Check if user status is Banned
     *
     * @return bool
     */
    public function isBanned()
    {
        return $this->statusIs(UserStatus::BANNED);
    }

    /**
     * Check if user status is Suspended
     *
     * @return bool
     */
    public function isSuspended()
    {
        return $this->statusIs(UserStatus::SUSPENDED);
    }

    /**
     * Check if user status is Blocked
     *
     * @return bool
     */
    public function isBlocked()
    {
        return $this->statusIs(UserStatus::BLOCKED);
    }
}
