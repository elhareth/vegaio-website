<?php

namespace App\Filament\Admin\Resources;

use App\Enums\UserRole;
use App\Enums\UserStatus;
use Illuminate\Contracts\Support\Htmlable;

use App\Filament\Admin\Resources\UserResource\Pages;
use App\Filament\Admin\Resources\UserResource\RelationManagers;
use App\Models\User;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $slug = 'resources/users';
    protected static ?string $navigationGroup = 'Resources';

    protected static ?int $navigationSort = 2;
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $activeNavigationIcon = 'heroicon-s-user-group';


    /**
     * Customize page title
     *
     * @return string|Htmlable
     */
    public function getTitle(): string | Htmlable
    {
        return __('Users List');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->unique(User::class, 'email', null, true)
                    ->label(__('models/user.attribute.email.label'))
                    ->required(),

                Forms\Components\TextInput::make('username')
                    ->unique(User::class, 'username', null, true)
                    ->minLength(4)
                    ->maxLength(15)
                    ->label(__('models/user.attribute.username.label'))
                    ->required(),

                Forms\Components\TextInput::make('password')
                    ->label(__('models/user.attribute.password.label'))
                    ->password()
                    ->required()
                    ->hiddenOn(['view']),

                Forms\Components\Select::make('user_status')
                    ->options(UserStatus::class)
                    ->label(__('models/user.attribute.status.label'))
                    ->required(),

                Forms\Components\Select::make('user_role')
                    ->options(UserRole::class)
                    ->label(__('models/user.attribute.role.label'))
                    ->required(),

                Forms\Components\DateTimePicker::make('email_verified_at')
                    ->label(__('models/model.attribute.email_verified_at.label'))
                    ->nullable(),

                Forms\Components\DateTimePicker::make('activated_at')
                    ->label(__('models/model.attribute.activated_at.label'))
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('email')
                    ->label(__('models/user.attribute.email.label'))
                    ->searchable(),

                Tables\Columns\TextColumn::make('username')
                    ->label(__('models/user.attribute.username.label'))
                    ->sortable()
                    ->searchable(),

                Tables\Columns\ImageColumn::make('avatar')
                    ->label(__('site/user.field.avatar.label'))
                    ->circular()
                    ->getStateUsing(function (User $user) {
                        return $user->getFilamentAvatarUrl();
                    }),

                Tables\Columns\TextColumn::make('status')
                    ->label(__('models/user.attribute.status.label'))
                    ->sortable(),

                Tables\Columns\TextColumn::make('role')
                    ->label(__('models/user.attribute.role.label'))
                    ->sortable(),

                Tables\Columns\TextColumn::make('email_verified_at')
                    ->dateTime()
                    ->label(__('models/model.attribute.email_verified_at.label'))
                    ->sortable(),

                Tables\Columns\TextColumn::make('activated_at')
                    ->dateTime()
                    ->label(__('models/model.attribute.activated_at.label'))
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->label(__('models/model.attribute.created_at.label'))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->label(__('models/model.attribute.updated_at.label'))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('role')->options(UserRole::class),
                Tables\Filters\SelectFilter::make('status')->options(UserStatus::class),
            ])
            ->actions([
                Tables\Actions\Action::make('Show')
                    ->color('primary')
                    ->button()
                    ->model(User::class)
                    ->infolist([
                        Grid::make()->columns([])->schema([
                            TextEntry::make('id')->label(__('models/user.attribute.id.label')),
                            TextEntry::make('email')->label(__('models/user.attribute.email.label')),
                            TextEntry::make('username')->label(__('models/user.attribute.username.label')),
                            TextEntry::make('role')->label(__('models/user.attribute.role.label')),
                            TextEntry::make('status')->label(__('models/user.attribute.status.label')),
                            TextEntry::make('activated_at')->date('Y-m-d')->label(__('models/model.attribute.activated_at.label')),
                        ]),
                    ]),
                Tables\Actions\ViewAction::make()->color('secondary'),
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
            RelationManagers\MetalistRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function getWidgets(): array
    {
        return [
            UserResource\Widgets\UserOverview::class,
        ];
    }


    public static function getModelLabel(): string
    {
        return __('models/user.label.Model');
    }

    public static function getPluralModelLabel(): string
    {
        return __('models/user.label.Models');
    }

    public static function getNavigationLabel(): string
    {
        return __('models/user.label.Models');
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
