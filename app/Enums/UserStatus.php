<?php

namespace App\Enums;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum UserStatus: string implements HasLabel, HasColor, HasIcon
{
    case ACTIVE     = 'active';
    case BANNED     = 'banned';
    case PENDING    = 'pending';
    case BLOCKED    = 'blocked';
    case SUSPENDED  = 'suspended';

    /**
     * Filament
     * Customize Label
     */
    public function getLabel(): ?string
    {
        return match ($this) {
            self::ACTIVE     => __('mods/enums.user-status.active'),
            self::BANNED     => __('mods/enums.user-status.banned'),
            self::PENDING    => __('mods/enums.user-status.pending'),
            self::BLOCKED    => __('mods/enums.user-status.blocked'),
            self::SUSPENDED  => __('mods/enums.user-status.suspended'),
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
            self::ACTIVE     => Color::Green,
            self::BANNED     => Color::Orange,
            self::PENDING    => Color::Yellow,
            self::BLOCKED    => Color::Red,
            self::SUSPENDED  => Color::Gray,
        };
    }

    /**
     * Filament
     * Cast values as Icons
     */
    public function getIcon(): ?string
    {
        return match ($this) {
            self::ACTIVE     => 'heroicon-s-check-badge',
            self::BANNED     => 'heroicon-s-eye-slash',
            self::PENDING    => 'heroicon-s-clock',
            self::BLOCKED    => 'heroicon-s-no-symbol',
            self::SUSPENDED  => 'heroicon-s-lock-closed',
        };
    }
}
