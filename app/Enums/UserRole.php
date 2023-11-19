<?php

namespace App\Enums;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum UserRole: string implements HasLabel, HasColor, HasIcon
{
    case USER       = 'user';
    case ADMIN      = 'admin';
    case MASTER     = 'master';
    case AUTHOR     = 'author';
    case EDITOR     = 'editor';

    /**
     * Filament
     * Customize Label
     */
    public function getLabel(): ?string
    {
        return match ($this) {
            self::USER       => __('mods/enums.user-role.user'),
            self::ADMIN      => __('mods/enums.user-role.admin'),
            self::MASTER     => __('mods/enums.user-role.master'),
            self::AUTHOR     => __('mods/enums.user-role.author'),
            self::EDITOR     => __('mods/enums.user-role.editor'),
        };

        return $this->name;
    }

    /**
     * Filament
     * Cast values as Colors
     */
    public function getColor(): string | array | null
    {
        return match ($this) {
            self::USER       => 'gray',
            self::ADMIN      => 'danger',
            self::MASTER     => 'primary',
            self::AUTHOR     => 'info',
            self::EDITOR     => 'warning',
        };
    }

    /**
     * Filament
     * Cast values as Icons
     */
    public function getIcon(): ?string
    {
        return match ($this) {
            self::USER       => 'heroicon-s-user',
            self::ADMIN      => 'heroicon-s-fire',
            self::MASTER     => 'heroicon-s-lifebuoy',
            self::AUTHOR     => 'heroicon-s-trophy',
            self::EDITOR     => 'heroicon-s-pencil-square',
        };
    }
}
