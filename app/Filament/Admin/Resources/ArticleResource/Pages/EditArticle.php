<?php

namespace App\Filament\Admin\Resources\ArticleResource\Pages;

use Mews\Purifier\Facades\Purifier;
use Plank\Mediable\Facades\MediaUploader;
use Illuminate\Support\Arr;
use App\Filament\Admin\Resources\ArticleResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditArticle extends EditRecord
{
    protected static string $resource = ArticleResource::class;


    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function beforeFill(): void
    {
        // Runs before the form fields are populated from the database.
        // $this->record->load(['media', 'metalist']);
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

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['thumbnail'] = $this->record->firstMedia('thumbnail')?->getDiskPath();

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['content'] = Purifier::clean($data['content']);
        return $data;
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $thumbnail = Arr::pull($data, 'thumbnail');

        $record->update($data);

        if ($thumbnail !== $record->firstMedia('thumbnail')?->getDiskPath()) {

            if (!$thumbnail) {
                $record->firstMedia('thumbnail')->delete();
            } else {
                $thumbnail = MediaUploader::importPath('uploads', $thumbnail);

                $record->syncMedia($thumbnail, 'thumbnail');
            }
        }

        return $record;
    }
}
