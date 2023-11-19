<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\SiteOptionResource\Pages;
use App\Filament\Admin\Resources\SiteOptionResource\RelationManagers;

use App\Models\SiteOption;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SiteOptionResource extends Resource
{
    protected static ?string $model = SiteOption::class;

    protected static ?string $slug = 'resources/site-options';
    protected static ?string $navigationGroup = 'Resources';

    protected static ?int $navigationSort = 1;
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $activeNavigationIcon = 'heroicon-s-cog-8-tooth';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label(__('models/model.attribute.name.label'))
                    ->minLength(4)
                    ->maxLength(50)
                    ->required(),

                Forms\Components\Textarea::make('label')
                    ->label(__('models/model.attribute.label.label'))
                    ->required(),

                Forms\Components\TextInput::make('group')
                    ->label(__('models/model.attribute.group.label'))
                    ->nullable(),

                Forms\Components\Toggle::make('autoload')
                    ->label(__('models/model.attribute.autoload.label'))
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label(__('models/model.attribute.id.label'))
                    ->sortable(),

                Tables\Columns\TextColumn::make('name')
                    ->label(__('models/model.attribute.name.label'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('label')
                    ->label(__('models/model.attribute.label.label'))
                    ->searchable(),

                Tables\Columns\TextColumn::make('group')
                    ->label(__('models/model.attribute.group.label'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\ToggleColumn::make('autoload')
                    ->label(__('models/model.attribute.autoload.label'))
                    ->sortable(),
            ])
            ->filters([
                //
                Tables\Filters\TernaryFilter::make('autoload'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->button()
                    ->model(SiteOption::class)
                    ->infolist([
                        Infolists\Components\Section::make()
                            ->columns([
                                'sm' => 3,
                                'xl' => 6,
                                '2xl' => 8,
                            ])
                            ->schema([
                                Infolists\Components\TextEntry::make('name')->label(__('models/model.attribute.name.label')),
                                Infolists\Components\TextEntry::make('label')->label(__('models/model.attribute.label.label')),
                                Infolists\Components\TextEntry::make('group')->label(__('models/model.attribute.group.label')),
                                Infolists\Components\TextEntry::make('is_auto')->label(__('models/model.attribute.autoload.label')),
                            ])
                    ]),
                Tables\Actions\EditAction::make()->color('warning'),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->icon('heroicon-s-trash'),
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
            'index' => Pages\ListSiteOptions::route('/'),
            'create' => Pages\CreateSiteOption::route('/create'),
            // 'view' => Pages\ViewSiteOption::route('/{record}'),
            'edit' => Pages\EditSiteOption::route('/{record}/edit'),
        ];
    }



    public static function getModelLabel(): string
    {
        return __('models/site-option.label.Model');
    }

    public static function getPluralModelLabel(): string
    {
        return __('models/site-option.label.Models');
    }

    public static function getNavigationLabel(): string
    {
        return __('models/site-option.label.Models');
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'secondary';
    }

    public static function getNavigationGroup(): ?string
    {
        if (isset(static::$navigationGroup)) {
            // return static::$navigationGroup;
        }

        return __('models/model.collection.label');
    }
}
