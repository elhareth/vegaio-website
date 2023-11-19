<?php

namespace App\Filament\Admin\Resources\ServiceResource\RelationManagers;

use App\Models\Media;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MediaRelationManager extends RelationManager
{
    protected static string $relationship = 'media';

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('filename')
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label(__('models/model.attribute.id.label'))
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('filename')
                    ->label(__('models/media.attribute.filename.label')),

                Tables\Columns\TextColumn::make('aggregate_type')
                    ->label(__('models/media.attribute.aggregate_type.label'))
                    ->sortable(),

                Tables\Columns\TextColumn::make('pivot.tag')
                    ->label(__('models/model.attribute.tag.label'))
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
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
}
