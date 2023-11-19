<?php

namespace App\Filament\Admin\Widgets;

use Filament\Support\Colors\Color;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?string $pollingInterval = '10s';
    protected static bool $isLazy = true;
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('users', \App\Models\User::count())
                ->label(__('models/user.label.Models'))
                ->icon('heroicon-s-users'),

            Stat::make('categories', \App\Models\Category::count())
                ->label(__('models/category.label.Models'))
                ->icon('heroicon-s-folder'),

            Stat::make('services', \App\Models\Service::count())
                ->label(__('models/service.label.Models'))
                ->icon('heroicon-s-lifebuoy'),

            Stat::make('articles', \App\Models\Article::count())
                ->label(__('models/article.label.Models'))
                ->icon('heroicon-s-newspaper'),

            Stat::make('contact-messages', \App\Models\ContactMessage::count())
                ->label(__('models/contact-message.label.Models'))
                ->icon('heroicon-s-inbox'),

            Stat::make('comments', \App\Models\Comment::count())
                ->label(__('models/comment.label.Models'))
                ->icon('heroicon-s-chat-bubble-bottom-center-text'),
        ];
    }
}
