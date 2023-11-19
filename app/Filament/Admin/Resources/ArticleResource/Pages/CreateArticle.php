<?php

namespace App\Filament\Admin\Resources\ArticleResource\Pages;

use Mews\Purifier\Facades\Purifier;
use Plank\Mediable\Facades\MediaUploader;
use Illuminate\Support\Arr;
use App\Filament\Admin\Resources\ArticleResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateArticle extends CreateRecord
{
    protected static string $resource = ArticleResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        $thumbnail = Arr::pull($data, 'thumbnail');

        // $data['slug'] = str($data['slug'])->slug()->toString();
        $data['content'] = Purifier::clean($data['content']);

        $record = static::getModel()::create($data);

        if ($thumbnail) {
            $thumbnail = MediaUploader::importPath('uploads', $thumbnail);
            $record->syncMedia($thumbnail, 'thumbnail');
        }

        return $record;
    }
}
