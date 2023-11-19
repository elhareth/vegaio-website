<?php

namespace App\Filament\Admin\Resources\SiteOptionResource\Pages;

use App\Filament\Admin\Resources\SiteOptionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSiteOption extends EditRecord
{
    protected static string $resource = SiteOptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
