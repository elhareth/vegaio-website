<?php

namespace App\Filament\Admin\Resources\ArticleResource\Pages;

use Illuminate\Database\Eloquent\Builder;

use App\Filament\Admin\Resources\ArticleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;

class ListArticles extends ListRecords
{
    protected static string $resource = ArticleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [];
        return [
            __('platform.all') => Tab::make(),
            __('mods/enums.article-status.draft') => Tab::make()->modifyQueryUsing(fn (Builder $query) => $query->statusDraft()),
            __('mods/enums.article-status.banned') => Tab::make()->modifyQueryUsing(fn (Builder $query) => $query->statusBanned()),
            __('mods/enums.article-status.closed') => Tab::make()->modifyQueryUsing(fn (Builder $query) => $query->statusClosed()),
            __('mods/enums.article-status.private') => Tab::make()->modifyQueryUsing(fn (Builder $query) => $query->statusPrivate()),
            __('mods/enums.article-status.pending') => Tab::make()->modifyQueryUsing(fn (Builder $query) => $query->statusPending()),
            __('mods/enums.article-status.approve') => Tab::make()->modifyQueryUsing(fn (Builder $query) => $query->statusApprove()),
            __('mods/enums.article-status.publish') => Tab::make()->modifyQueryUsing(fn (Builder $query) => $query->statusPublish()),
            __('mods/enums.article-status.deleted') => Tab::make()->modifyQueryUsing(fn (Builder $query) => $query->statusDeleted()),
        ];
    }
}
