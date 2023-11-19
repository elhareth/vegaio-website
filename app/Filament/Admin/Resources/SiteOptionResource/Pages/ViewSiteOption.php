<?php

namespace App\Filament\Admin\Resources\SiteOptionResource\Pages;

use App\Filament\Admin\Resources\SiteOptionResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSiteOption extends ViewRecord
{
    protected static string $resource = SiteOptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
