<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\CommentResource\Pages;
use App\Filament\Admin\Resources\CommentResource\RelationManagers;
use App\Models\Comment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CommentResource extends Resource
{
    protected static ?string $model = Comment::class;

    protected static ?string $slug = 'resources/comments';
    protected static ?string $navigationGroup = 'Resources';

    protected static ?int $navigationSort = 7;
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-oval-left-ellipsis';
    protected static ?string $activeNavigationIcon = 'heroicon-s-chat-bubble-oval-left-ellipsis';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                ->label(__('models/model.attribute.user.label'))
                    ->relationship('user', 'username')
                    ->nullable(),

                Forms\Components\Textarea::make('comment')
                    ->label(__('models/model.attribute.comment.label'))
                    ->rows(5)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label(__('models/model.attribute.id.label'))
                    ->sortable(),

                Tables\Columns\TextColumn::make('user.username')
                    ->label(__('models/model.attribute.user.label'))
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('commentable_type')
                    ->label(__('models/comment.attribute.commentable_type.label'))
                    ->sortable(),

                Tables\Columns\TextColumn::make('commentable_id')
                    ->label(__('models/comment.attribute.commentable_id.label'))
                    ->numeric(),

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

                Tables\Columns\TextColumn::make('deleted_at')
                    ->label(__('models/model.attribute.deleted_at.label'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListComments::route('/'),
            'edit' => Pages\EditComment::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }


    public static function getModelLabel(): string
    {
        return __('models/comment.label.Model');
    }

    public static function getPluralModelLabel(): string
    {
        return __('models/comment.label.Models');
    }

    public static function getNavigationLabel(): string
    {
        return __('models/comment.label.Models');
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
