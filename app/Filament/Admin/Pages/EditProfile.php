<?php

namespace App\Filament\Admin\Pages;

use Exception;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Get;
use Filament\Forms\Form;
use Filament\Forms\Components\Component;
use Filament\Notifications\Notification;
use Filament\Pages\Concerns;
use Filament\Pages\SimplePage;
use Filament\Panel;
use Filament\Support\Enums\Alignment;
use Filament\Support\Exceptions\Halt;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rules\Password;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use App\Models\User;

/**
 * @property Form $form
 */
class EditProfile extends SimplePage
{
    use Concerns\HasRoutes;
    use Concerns\InteractsWithFormActions;

    /**
     * @var view-string
     */
    protected static string $view = 'filament-panels::pages.auth.edit-profile';

    /**
     *
     */
    public ?EloquentCollection $profile_meta;

    /**
     * @var array<string, mixed> | null
     */
    public ?array $data = [];

    public static function getLabel(): string
    {
        return __('site/user.actions.edit-profile.label');
        return __('filament-panels::pages/auth/edit-profile.label');
    }

    public static function routes(Panel $panel): void
    {
        $slug = static::getSlug();

        Route::get("/{$slug}", static::class)
            ->middleware(static::getRouteMiddleware($panel))
            ->withoutMiddleware(static::getWithoutRouteMiddleware($panel))
            ->name('profile');
    }

    /**
     * @return string | array<string>
     */
    public static function getRouteMiddleware(Panel $panel): string | array
    {
        return [
            ...(static::isEmailVerificationRequired($panel) ? [static::getEmailVerifiedMiddleware($panel)] : []),
            ...Arr::wrap(static::$routeMiddleware),
        ];
    }

    public function mount(): void
    {
        $this->profile_meta = $this->getUser()
            ->metalist()
            ->where('group', 'profile')
            ->get();
        $this->fillForm();
    }

    public function getUser(): Authenticatable & Model
    {
        $user = Filament::auth()->user();

        if (!$user instanceof Model) {
            throw new Exception('The authenticated user object must be an Eloquent model to allow the profile page to update it.');
        }

        return $user;
    }

    protected function fillForm(): void
    {
        $data = $this->getUser()->attributesToArray();
        $data['profile'] = $this->profile_meta->mapWithKeys(function ($meta, $index) {
            return [$meta->name => $meta->value];
        })->toArray();

        $this->callHook('beforeFill');

        $data = $this->mutateFormDataBeforeFill($data);

        $this->form->fill($data);

        $this->callHook('afterFill');
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    protected function mutateFormDataBeforeFill(array $data): array
    {
        // $data['name'] = Arr::pull($data, 'username');
        return $data;
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    protected function mutateFormDataBeforeSave(array $data): array
    {
        // $data['username'] = Arr::pull($data, 'name');
        return $data;
    }

    public function save(): void
    {
        try {
            $this->callHook('beforeValidate');

            $data = $this->form->getState();

            $this->callHook('afterValidate');

            $data = $this->mutateFormDataBeforeSave($data);

            $this->callHook('beforeSave');

            $this->handleRecordUpdate($this->getUser(), $data);

            $this->callHook('afterSave');
        } catch (Halt $exception) {
            return;
        }

        if (request()->hasSession() && array_key_exists('password', $data)) {
            request()->session()->put([
                'password_hash_' . Filament::getAuthGuard() => $data['password'],
            ]);
        }

        $this->data['password'] = null;
        $this->data['passwordConfirmation'] = null;

        $this->getSavedNotification()?->send();

        if ($redirectUrl = $this->getRedirectUrl()) {
            $this->redirect($redirectUrl);
        }
    }

    /**
     * @param  array<string, mixed>  $data
     */
    protected function handleRecordUpdate(User $record, array $data): Model
    {
        $profile = Arr::pull($data, 'profile');

        $record->update($data);

        $profile['display_name'] = "{$profile['first_name']} {$profile['last_name']}";

        if (empty($profile['display_name'])) {
            unset($profile['display_name']);
        }

        $record->setMeta($profile, 'profile');

        // foreach($profile as $key=>$val) {
        //     if ($meta = $this->profile_meta->firstWhere('name', $key)) {
        //         $meta->value = $val;
        //         $meta->save();
        //     }
        // }

        return $record;
    }

    protected function getSavedNotification(): ?Notification
    {
        $title = $this->getSavedNotificationTitle();

        if (blank($title)) {
            return null;
        }

        return Notification::make()
            ->success()
            ->title($this->getSavedNotificationTitle());
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return __('filament-panels::pages/auth/edit-profile.notifications.saved.title');
    }

    protected function getRedirectUrl(): ?string
    {
        return null;
    }

    protected function getUserNameFormComponent(): Component
    {
        return Forms\Components\TextInput::make('username')
            ->label(__('site/user.field.username.label'))
            ->unique(User::class, 'username', null, true)
            ->required()
            ->maxLength(255)
            ->autofocus();
    }

    protected function getEmailFormComponent(): Component
    {
        return Forms\Components\TextInput::make('email')
            ->label(__('filament-panels::pages/auth/edit-profile.form.email.label'))
            ->email()
            ->required()
            ->maxLength(255)
            ->unique(ignoreRecord: true);
    }

    protected function getPasswordFormComponent(): Component
    {
        return Forms\Components\TextInput::make('password')
            ->label(__('filament-panels::pages/auth/edit-profile.form.password.label'))
            ->password()
            ->rule(Password::default())
            ->autocomplete('new-password')
            ->dehydrated(fn ($state): bool => filled($state))
            ->dehydrateStateUsing(fn ($state): string => Hash::make($state))
            ->live(debounce: 500)
            ->same('passwordConfirmation');
    }

    protected function getPasswordConfirmationFormComponent(): Component
    {
        return Forms\Components\TextInput::make('passwordConfirmation')
            ->label(__('filament-panels::pages/auth/edit-profile.form.password_confirmation.label'))
            ->password()
            ->required()
            ->visible(fn (Get $get): bool => filled($get('password')))
            ->dehydrated(false);
    }

    /**
     * Avatar Component
     */
    protected function getAvatarFromComponent(): Component
    {
        return Forms\Components\FileUpload::make('avatar')
            ->label(__('site/user.field.avatar.label'))
            ->avatar()
            ->minSize(15)
            ->maxSize(3000)
            ->optimize('webp')
            ->getUploadedFileNameForStorageUsing(function (TemporaryUploadedFile $file, User $user): string {
                return $user->username . '_' . now()->timestamp . '.' . 'webp';
            })
            ->disk('uploads')
            ->directory('avatars')
            ->visibility('public');
    }

    public function form(Form $form): Form
    {
        return $form;
    }

    /**
     * @return array<int | string, string | Form>
     */
    protected function getForms(): array
    {
        return [
            'form' => $this->form(
                $this->makeForm()
                    ->schema([
                        Forms\Components\Section::make(__('site/user.sets.account_info.label'))
                            ->schema([
                                $this->getUserNameFormComponent(),
                                $this->getEmailFormComponent(),
                                $this->getPasswordFormComponent(),
                                $this->getPasswordConfirmationFormComponent(),
                            ]),
                        Forms\Components\Section::make(__('site/user.sets.profile_info.label'))
                            ->schema([
                                $this->getAvatarFromComponent(),

                                Forms\Components\TextInput::make('first_name')
                                    ->label(__('site/user.field.first_name.label')),

                                Forms\Components\TextInput::make('last_name')
                                    ->label(__('site/user.field.last_name.label')),

                                Forms\Components\Radio::make('gender')
                                    ->label(__('site/user.field.gender.label'))
                                    ->options([
                                        'male' => __('site/user.field.gender.options.male.label'),
                                        'female' => __('site/user.field.gender.options.female.label'),
                                        'other' => __('site/user.field.gender.options.other.label'),
                                    ]),

                                Forms\Components\DatePicker::make('birthdate')
                                    ->label(__('site/user.field.birthdate.label')),
                            ])->columns(1)->statePath('profile'),
                    ])
                    ->operation('edit')
                    ->model($this->getUser())
                    ->statePath('data'),
            ),
        ];
    }

    /**
     * @return array<Action | ActionGroup>
     */
    protected function getFormActions(): array
    {
        return [
            $this->getSaveFormAction(),
            $this->getCancelFormAction(),
        ];
    }

    protected function getCancelFormAction(): Action
    {
        return $this->backAction();
    }

    protected function getSaveFormAction(): Action
    {
        return Action::make('save')
            ->label(__('filament-panels::pages/auth/edit-profile.form.actions.save.label'))
            ->submit('save')
            ->keyBindings(['mod+s']);
    }

    protected function hasFullWidthFormActions(): bool
    {
        return false;
    }

    public function getFormActionsAlignment(): string | Alignment
    {
        return Alignment::Start;
    }

    public function getTitle(): string | Htmlable
    {
        return static::getLabel();
    }

    public static function getSlug(): string
    {
        return static::$slug ?? 'profile';
    }

    public function hasLogo(): bool
    {
        return true;
    }

    /**
     * @deprecated Use `getCancelFormAction()` instead.
     */
    public function backAction(): Action
    {
        return Action::make('back')
            ->label(__('filament-panels::pages/auth/edit-profile.actions.cancel.label'))
            ->url(filament()->getUrl())
            ->color('gray');
    }
}
