<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\CategoryResource\Pages;
use App\Filament\Admin\Resources\CategoryResource\RelationManagers;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $slug = 'resources/categories';
    protected static ?string $navigationGroup = 'Resources';

    protected static ?int $navigationSort = 3;
    protected static ?string $navigationIcon = 'heroicon-o-folder';
    protected static ?string $activeNavigationIcon = 'heroicon-s-folder';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('parent_id')
                    ->label(__('models/model.attribute.parent.label'))
                    ->relationship('parent', 'title')
                    ->nullable(),

                Forms\Components\TextInput::make('slug')
                    ->label(__('models/model.attribute.slug.label'))
                    ->unique('categories', 'slug', null, true)
                    ->minLength(4)
                    ->maxLength(255)
                    ->required()
                    ->live(),

                Forms\Components\TextInput::make('name')
                    ->label(__('models/model.attribute.name.label'))
                    ->minLength(4)
                    ->maxLength(25)
                    ->required()
                    ->afterStateUpdated(fn (Forms\Set $set, ?string $state) => $set('slug', str($state)->slug()->toString())),

                Forms\Components\TextInput::make('group')
                    ->label(__('models/model.attribute.group.label'))
                    ->minLength(3)
                    ->maxLength(25)
                    ->nullable(),

                Forms\Components\TextInput::make('title')
                    ->label(__('models/model.attribute.title.label'))
                    ->minLength(4)
                    ->maxLength(50),

                Forms\Components\Textarea::make('description')
                    ->label(__('models/model.attribute.description.label'))
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label(__('models/model.attribute.id.label'))
                    ->sortable(),

                Tables\Columns\TextColumn::make('parent.title')
                    ->label(__('models/model.attribute.parent.label'))
                    ->searchable(),

                Tables\Columns\TextColumn::make('slug')
                    ->label(__('models/model.attribute.label.label'))
                    ->searchable(),

                Tables\Columns\TextColumn::make('name')
                    ->label(__('models/model.attribute.name.label'))
                    ->searchable(),

                Tables\Columns\TextColumn::make('group')
                    ->label(__('models/model.attribute.group.label'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('title')
                    ->label(__('models/model.attribute.title.label'))
                    ->searchable(),

                Tables\Columns\TextColumn::make('description')
                    ->label(__('models/model.attribute.description.label')),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make()->color('warning'),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->color('warning')->icon('heroicon-s-trash'),
                    Tables\Actions\ForceDeleteBulkAction::make()->color('danger')->icon('heroicon-s-x-circle'),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\MetalistRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }


    public static function getModelLabel(): string
    {
        return __('models/category.label.Model');
    }

    public static function getPluralModelLabel(): string
    {
        return __('models/category.label.Models');
    }

    public static function getNavigationLabel(): string
    {
        return __('models/category.label.Models');
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
