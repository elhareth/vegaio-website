<?php

namespace App\Filament\Admin\Resources\SiteOptionResource\Pages;

use Illuminate\Database\Eloquent\Builder;

use App\Filament\Admin\Resources\SiteOptionResource;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;


class ListSiteOptions extends ListRecords
{
    protected static string $resource = SiteOptionResource::class;

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
            'all' => Tab::make(),
            'auto' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->autoloaded()),
            'lazy' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->autoloaded(false)),
        ];
    }
}
