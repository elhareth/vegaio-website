<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ContactMessageResource\Pages;
use App\Filament\Admin\Resources\ContactMessageResource\RelationManagers;
use App\Models\ContactMessage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Infolists;
use Filament\Infolists\Infolist;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContactMessageResource extends Resource
{
    protected static ?string $model = ContactMessage::class;

    protected static ?string $slug = 'resources/contact-messages';
    protected static ?string $navigationGroup = 'Resources';

    protected static ?int $navigationSort = 8;
    protected static ?string $navigationIcon = 'heroicon-o-envelope';
    protected static ?string $activeNavigationIcon = 'heroicon-s-envelope-open';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label(__('models/user.attribute.name.label'))
                    ->sortable(),

                Tables\Columns\TextColumn::make('email')
                    ->label(__('models/user.attribute.email.label'))
                    ->sortable(),

                Tables\Columns\TextColumn::make('subject')
                    ->label(__('models/model.attribute.subject.label'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\ToggleColumn::make('read')
                    ->label(__('models/contact-message.attribute.read.label'))
                    ->sortable(),

                Tables\Columns\TextColumn::make('added')
                    ->label(__('models/contact-message.attribute.added.label'))
                    ->date('d M, Y H:i A')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->model(ContactMessage::class)
                    ->infolist([
                        InfoLists\Components\TextEntry::make('message')
                        ->label(__('models/model.attribute.message.label')),
                    ]),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\ForceDeleteBulkAction::make()->color('danger'),
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
            'index' => Pages\ListContactMessages::route('/'),
        ];
    }




    public static function getModelLabel(): string
    {
        return __('models/contact-message.label.Model');
    }

    public static function getPluralModelLabel(): string
    {
        return __('models/contact-message.label.Models');
    }

    public static function getNavigationLabel(): string
    {
        return __('models/contact-message.label.Models');
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
