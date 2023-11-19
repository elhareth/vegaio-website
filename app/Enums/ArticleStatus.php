<?php

namespace App\Enums;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum ArticleStatus: string implements HasLabel, HasColor, HasIcon
{
    case CAST       = 'cast';
    case DRAFT      = 'draft';
    case BANNED     = 'banned';
    case CLOSED     = 'closed';
    case PRIVATE    = 'private';
    case PENDING    = 'pending';
    case APPROVE    = 'approve';
    case PUBLISH    = 'publish';
    case DELETED    = 'deleted';
    case RESTRICT   = 'restrict';

    /**
     * Filament
     * Customize Label
     */
    public function getLabel(): ?string
    {
        return match ($this) {
            self::CAST       => __('mods/enums.article-status.cast'),
            self::DRAFT      => __('mods/enums.article-status.draft'),
            self::BANNED     => __('mods/enums.article-status.banned'),
            self::CLOSED     => __('mods/enums.article-status.closed'),
            self::PRIVATE    => __('mods/enums.article-status.private'),
            self::PENDING    => __('mods/enums.article-status.pending'),
            self::APPROVE    => __('mods/enums.article-status.approve'),
            self::PUBLISH    => __('mods/enums.article-status.publish'),
            self::DELETED    => __('mods/enums.article-status.deleted'),
            self::RESTRICT   => __('mods/enums.article-status.restrict'),
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
            self::CAST       => Color::Amber,
            self::DRAFT      => Color::Gray,
            self::BANNED     => Color::Red,
            self::CLOSED     => 'secondary',
            self::PRIVATE    => 'primary',
            self::PENDING    => Color::Yellow,
            self::APPROVE    => Color::Green,
            self::PUBLISH    => Color::Blue,
            self::DELETED    => Color::Zinc,
            self::RESTRICT   => Color::Orange,
        };
    }

    /**
     * Filament
     * Cast values as Icons
     */
    public function getIcon(): ?string
    {
        return match ($this) {
            self::CAST       => 'heroicon-s-megaphone',
            self::DRAFT      => 'heroicon-s-information-circle',
            self::BANNED     => 'heroicon-s-no-symbol',
            self::CLOSED     => 'heroicon-s-lock-closed',
            self::PRIVATE    => 'heroicon-s-shield-exclamation',
            self::PENDING    => 'heroicon-s-clock',
            self::APPROVE    => 'heroicon-s-check-badge',
            self::PUBLISH    => 'heroicon-s-newspaper',
            self::DELETED    => 'heroicon-s-trash',
            self::RESTRICT   => 'heroicon-s-exclamation-triangle',
        };
    }
}
