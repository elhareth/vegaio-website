<?php

namespace App\Filament\Admin\Resources\ServiceResource\Pages;

use Plank\Mediable\Facades\MediaUploader;
use Illuminate\Support\Arr;
use App\Filament\Admin\Resources\ServiceResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Mews\Purifier\Facades\Purifier;

class CreateService extends CreateRecord
{
    protected static string $resource = ServiceResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $thumbnail = Arr::pull($data, 'thumbnail');

        $data['slug'] = str($data['slug'])->slug()->toString();
        $data['description'] = Purifier::clean($data['description']);

        $record = static::getModel()::create($data);

        if ($thumbnail) {
            $thumbnail = MediaUploader::importPath('media', $thumbnail);
            $record->syncMedia($thumbnail, 'thumbnail');
        }

        return $record;
    }
}
