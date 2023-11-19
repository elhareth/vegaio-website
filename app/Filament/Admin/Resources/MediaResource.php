<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\MediaResource\Pages;
use App\Filament\Admin\Resources\MediaResource\RelationManagers;
use App\Models\Media;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MediaResource extends Resource
{
    protected static ?string $model = Media::class;

    protected static ?string $slug = 'resources/media';
    protected static ?string $navigationGroup = 'Resources';

    protected static ?int $navigationSort = 6;
    protected static ?string $navigationIcon = 'heroicon-o-film';
    protected static ?string $activeNavigationIcon = 'heroicon-s-film';

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label(__('models/model.attribute.id.label'))
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('disk')
                    ->label(__('models/media.attribute.disk.label'))
                    ->sortable(),

                Tables\Columns\TextColumn::make('directory')
                    ->label(__('models/media.attribute.directory.label'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('filename')
                    ->label(__('models/media.attribute.filename.label'))
                    ->searchable(),

                Tables\Columns\TextColumn::make('aggregate_type')
                    ->label(__('models/media.attribute.aggregate_type.label'))
                    ->sortable(),

                Tables\Columns\TextColumn::make('extension')
                    ->label(__('models/media.attribute.extension.label'))
                    ->sortable(),

                Tables\Columns\TextColumn::make('mime_type')
                    ->label(__('models/media.attribute.mime_type.label'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('size')
                    ->label(__('models/media.attribute.size.label'))
                    ->numeric()
                    ->getStateUsing(function (Media $media) {
                        return $media->getFileSize();
                    })
                    ->sortable(),


                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('models/model.attribute.created_at.label'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('models/model.attribute.updated_at.label'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMedia::route('/'),
        ];
    }


    public static function getModelLabel(): string
    {
        return __('models/media.label.Model');
    }

    public static function getPluralModelLabel(): string
    {
        return __('models/media.label.Models');
    }

    public static function getNavigationLabel(): string
    {
        return __('models/media.label.Models');
    }

    public static function getNavigationGroup(): ?string
    {
        if (isset(static::$navigationGroup)) {
            // return static::$navigationGroup;
        }

        return __('models/model.collection.label');
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'secondary';
    }
}
