<?php

namespace App\Filament\Admin\Resources\ServiceResource\Pages;

use App\Filament\Admin\Resources\ServiceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Models\Service;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Plank\Mediable\Facades\MediaUploader;

class EditService extends EditRecord
{
    protected static string $resource = ServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['thumbnail'] = $this->record->firstMedia('thumbnail')?->getDiskPath();

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        return $data;
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        // dd($data);
        $thumbnail = Arr::pull($data, 'thumbnail');

        $record->update($data);

        if ($thumbnail !== $record->firstMedia('thumbnail')?->getDiskPath()) {

            if (!$thumbnail) {
                $record->firstMedia('thumbnail')->delete();
            } else {
                $thumbnail = MediaUploader::importPath('media', $thumbnail);

                $record->syncMedia($thumbnail, 'thumbnail');
            }
        }

        return $record;
    }

    protected function beforeFill(): void
    {
        // Runs before the form fields are populated from the database.
        $this->record->load(['media', 'metalist']);
    }

    protected function afterFill(): void
    {
        // Runs after the form fields are populated from the database.
    }

    protected function beforeValidate(): void
    {
        // Runs before the form fields are validated when the form is saved.
    }

    protected function afterValidate(): void
    {
        // Runs after the form fields are validated when the form is saved.
    }

    protected function beforeSave(): void
    {
        // Runs before the form fields are saved to the database.
    }

    protected function afterSave(): void
    {
        // Runs after the form fields are saved to the database.
    }
}
