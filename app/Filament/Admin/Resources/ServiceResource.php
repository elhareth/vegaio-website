<?php

namespace App\Filament\Admin\Resources;

use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use App\Models\Service;
use App\Filament\Admin\Resources\ServiceResource\Pages;
use App\Filament\Admin\Resources\ServiceResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Component;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\Resource;
use Plank\Mediable\Facades\MediaUploader;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static ?string $slug = 'resources/services';
    protected static ?string $navigationGroup = 'Resources';

    protected static ?int $navigationSort = 4;
    protected static ?string $navigationIcon = 'heroicon-o-lifebuoy';
    protected static ?string $activeNavigationIcon = 'heroicon-s-lifebuoy';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with(['metalist', 'media']);
    }

    protected static function getThumbnailComponent(): Component
    {
        return Forms\Components\FileUpload::make('thumbnail')
            ->label(__('models/model.attribute.thumbnail.label'))
            ->image()
            ->imageEditor()
            ->imageEditorMode(2)
            ->imageResizeMode('cover')
            ->imagePreviewHeight('400')
            // ->imageCropAspectRatio('16:9')
            ->imageResizeTargetWidth('800')
            ->imageResizeTargetHeight('600')
            ->imageEditorViewportWidth('800')
            ->imageEditorViewportHeight('600')
            ->disk('media')
            ->directory('services')
            ->optimize('webp')
            ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file, Service $service): string {
                return $service->slug . '_' . time() . '.webp';
            })
            ->moveFiles()
            ->columnSpanFull();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                static::getThumbnailComponent(),
                Forms\Components\Select::make('category_id')
                    ->label(__('models/category.label.Model'))
                    ->relationship('category', 'title')
                    ->required(),

                Forms\Components\TextInput::make('slug')
                    ->label(__('models/model.attribute.slug.label'))
                    ->unique('services', 'slug', null, true)
                    ->minLength(3)
                    ->maxLength(255)
                    ->required(),

                Forms\Components\TextInput::make('name')
                    ->label(__('models/model.attribute.name.label'))
                    ->minLength(4)
                    ->maxLength(50)
                    ->required(),

                Forms\Components\TextInput::make('label')
                    ->label(__('models/model.attribute.label.label'))
                    ->minLength(4)
                    ->maxLength(50),

                Forms\Components\RichEditor::make('description')
                    ->label(__('models/model.attribute.description.label'))
                    ->nullable()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('thumbnail')
                    ->label(__('models/model.attribute.thumbnail.label'))
                    ->square()
                    ->getStateUsing(function (Service $service) {
                        return $service->firstMedia('thumbnail')->getUrl();
                    }),

                Tables\Columns\TextColumn::make('slug')
                    ->label(__('models/model.attribute.slug.label')),

                Tables\Columns\TextColumn::make('name')
                    ->label(__('models/model.attribute.name.label'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('label')
                    ->label(__('models/model.attribute.label.label'))
                    ->searchable(),

                Tables\Columns\TextColumn::make('category.title')
                    ->label(__('models/category.label.Model'))
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('Show')
                    ->button()
                    ->model(Service::class)
                    ->infolist([]),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make()->color('warning'),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\ForceDeleteBulkAction::make()->color('danger')->icon('heroicon-s-trash'),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\MediaRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }




    public static function getModelLabel(): string
    {
        return __('models/service.label.Model');
    }

    public static function getPluralModelLabel(): string
    {
        return __('models/service.label.Models');
    }

    public static function getNavigationLabel(): string
    {
        return __('models/service.label.Models');
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
