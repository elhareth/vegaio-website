<?php

namespace App\Filament\Admin\Resources;

use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use App\Enums\ArticleStatus;
use App\Filament\Admin\Resources\ArticleResource\Pages;
use App\Filament\Admin\Resources\ArticleResource\RelationManagers;
use App\Models\Article;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\{
    TextColumn,
};
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static ?string $slug = 'resources/articles';
    protected static ?string $navigationGroup = 'Resources';

    protected static ?int $navigationSort = 5;
    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    protected static ?string $activeNavigationIcon = 'heroicon-s-newspaper';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery();
        // return parent::getEloquentQuery()->with(['metalist', 'media']);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'username')
                    ->nullable()
                    ->label(__('models/user.label.Model')),

                Forms\Components\Select::make('category_id')
                    ->relationship('category', 'title')
                    ->nullable()
                    ->label(__('models/category.label.Model')),

                Forms\Components\TextInput::make('slug')
                    ->label(__('models/model.attribute.slug.label'))
                    ->unique(static::$model, 'slug', null, true)
                    ->minLength(4)
                    ->maxLength(255),

                Forms\Components\TextInput::make('title')
                    ->label(__('models/model.attribute.title.label'))
                    ->minLength(4)
                    ->nullable()
                    ->required(),

                Forms\Components\Select::make('status')
                    ->options(ArticleStatus::class)
                    ->default(ArticleStatus::DRAFT)
                    ->label(__('models/model.attribute.status.label'))
                    ->required(),

                Forms\Components\DateTimePicker::make('published_at')
                    ->label(__('models/model.attribute.published_at.label'))
                    ->nullable(),

                Forms\Components\RichEditor::make('content')
                    ->label(__('models/model.attribute.content.label'))
                    ->columnSpanFull(),

                Forms\Components\FileUpload::make('thumbnail')
                    ->label(__('models/model.attribute.thumbnail.label'))
                    ->image()
                    ->imageEditor()
                    ->imageResizeMode('cover')
                    ->imagePreviewHeight('400')
                    // ->imageCropAspectRatio('16:9')
                    // ->imageResizeTargetWidth('800')
                    // ->imageResizeTargetHeight('600')
                    // ->imageEditorViewportWidth('800')
                    // ->imageEditorViewportHeight('600')
                    ->disk('uploads')
                    ->directory('images')
                    ->optimize('webp')
                    ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file, Article $article): string {
                        return uniqid() . '_' . time() . '.webp';
                    })
                    ->moveFiles()
                    ->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('author.username')
                    ->label(__('models/model.attribute.author.label'))
                    ->sortable(),

                TextColumn::make('category.title')
                    ->label(__('models/category.label.Model'))
                    ->sortable(),

                TextColumn::make('slug')
                    ->label(__('models/model.attribute.slug.label'))
                    ->searchable(),

                TextColumn::make('title')
                    ->label(__('models/model.attribute.title.label'))
                    ->searchable(),

                TextColumn::make('status')
                    ->label(__('models/model.attribute.status.label'))
                    ->sortable(),

                TextColumn::make('published_at')
                    ->label(__('models/model.attribute.published_at.label'))
                    ->date('Y-m-d h:i:s')
                    ->sortable(),

            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label(__('models/model.attribute.status.label'))
                    ->options(ArticleStatus::class)
            ])
            ->actions([
                Tables\Actions\Action::make('publish')
                    ->label(__('models/article.actions.publish.label'))
                    ->color('success')
                    ->button()
                    ->outlined()
                    ->action(function (Article $article) {
                        if ($article->publish()->isPublished()) {
                            \Filament\Notifications\Notification::make('article_publish_' . $article->id)
                                ->title(__('models/article.alerts.published.title'))
                                ->{__('models/article.alerts.published.type')}()
                                ->send();
                        }
                    }),
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
            // RelationManagers\CategoryRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }


    public static function getModelLabel(): string
    {
        return __('models/article.label.Model');
    }

    public static function getPluralModelLabel(): string
    {
        return __('models/article.label.Models');
    }

    public static function getNavigationLabel(): string
    {
        return __('models/article.label.Models');
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
