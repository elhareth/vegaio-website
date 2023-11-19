<?php

namespace App\Filament\Admin\Pages\Settings;

use ArrayAccess;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Illuminate\Http\File;

use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\View;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

use App\Support\Facades\SiteOptions as SiteOptionsFacade;

use App\Models\SiteOption;
// use App\Filament\Widgets\StatsOverviewWidget;

use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Pages\Concerns\InteractsWithFormActions;

use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Arr;

class SiteMeta extends Page implements HasForms
{
    use InteractsWithForms;
    use InteractsWithActions;
    use InteractsWithFormActions;

    protected static string $view = 'filament.admin.pages.settings.site-meta';

    protected static ?string $slug = 'settings/meta';

    // protected static ?string $title = 'Custom Page Title';

    // protected static ?string $navigationGroup = 'settings';

    protected static ?int $navigationSort = 1;
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $activeNavigationIcon = 'heroicon-s-cog-6-tooth';

    public ?EloquentCollection $records;
    public ?array $data = [];

    /**
     *
     */
    public $stats = [];

    /**
     *
     *
     */
    public static $options_list = [
        'site_status' => [
            'type' => 'text',
            'tree' => 'solo',
            'field' => 'Select',
            'options' => [
                'producation' => 'TR::site/settings.typo.site_status_producation',
                'development' => 'TR::site/settings.typo.site_status_development',
                'maintenance' => 'TR::site/settings.typo.site_status_maintenance',
            ],
        ],
        'site_language' => [
            'type' => 'text',
            'tree' => 'solo',
            'field' => 'Select',
            'options' => [
                'ar' => 'TR::site/lang.sets.ar.label',
                'en' => 'TR::site/lang.sets.en.label',
            ],
        ],
        'site_icon' => [
            'type' => 'text',
            'tree' => 'solo',
            'field' => 'FileUpload',
        ],
        'site_logo' => [
            'type' => 'text',
            'tree' => 'solo',
            'field' => 'FileUpload',
        ],
        'site_name' => [
            'type' => 'text',
            'tree' => 'solo',
            'field' => 'TextInput',
        ],
        'site_label' => [
            'type' => 'text',
            'tree' => 'solo',
            'field' => 'TextInput',
        ],
        'site_title' => [
            'type' => 'text',
            'tree' => 'solo',
            'field' => 'TextInput',
        ],
        'site_tagline' => [
            'type' => 'text',
            'tree' => 'solo',
            'field' => 'TextInput',
        ],
        'site_description' => [
            'type' => 'text',
            'tree' => 'solo',
            'field' => 'Textarea',
        ],
        'site_keywords' => [
            'type' => 'array',
            'tree' => 'list',
            'field' => 'TagsInput',
        ],
    ];

    /**
     *
     */
    public function mount(): void
    {
        abort_unless(auth()->user()->canManageSettings(), 403);
        $this->records = SiteOptionsFacade::getQuery()
            ->whereIn('name', array_keys(static::$options_list))
            ->orWhere('name', 'contact_info')
            ->get()
            ->mapWithKeys(function ($item, $index) {
                return [$item->name => $item];
            });
        $this->data = $this->records->toArray();

        $this->form->fill();
    }

    /**
     *
     */
    public function getTitle(): string | Htmlable
    {
        return __('site/settings.term.site-meta.label');
    }

    /**
     *
     */
    public static function getNavigationLabel(): string
    {
        return __('site/settings.term.site-meta.label');
    }

    public static function getNavigationGroup(): ?string
    {
        if (isset(static::$navigationGroup)) {
            // return static::$navigationGroup;
        }

        return __('site/settings.Settings');
    }

    /**
     *
     */
    public function getHeading(): string
    {
        return __('site/settings.term.site-meta.label');
    }

    /**
     *
     */
    public function getSubheading(): ?string
    {
        return __('site/settings.term.site-meta.line');
    }

    /**
     *
     */
    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->canManageSettings();
    }

    /**
     *
     */
    public function getMaxContentWidth(): ?string
    {
        return 'full';
    }

    /**
     *
     */
    public function getHeader(): ?View
    {
        return null;
        return view('filament.settings.custom-header');
    }

    /**
     *
     */
    public function getFooter(): ?View
    {
        return null;
        return view('filament.settings.custom-footer');
    }

    /**
     *
     */
    protected function getHeaderActions(): array
    {
        return [
            // Action::make('edit')
            // ->url(route('posts.edit', ['post' => $this->post])),
            // Action::make('delete')
            // ->requiresConfirmation()
            //     ->action(fn () => $this->post->delete()),
        ];
    }

    /**
     *
     */
    protected function getHeaderWidgets(): array
    {
        return [
            // StatsOverviewWidget::class
        ];
    }

    /**
     *
     */
    public function getHeaderWidgetsColumns(): int | array
    {
        return [
            'md' => 4,
            'xl' => 5,
        ];
    }

    /**
     *
     */
    public function getWidgetData(): array
    {
        return [
            'stats' => [
                'total' => 100,
            ],
        ];
    }

    /**
     *
     *
     */
    public function form(Form $form): Form
    {
        $fields = [];

        foreach (static::$options_list as $key => $config) {
            if (!isset($this->data[$key])) continue;
            $_option = $this->data[$key];
            $_field = Forms\Components::class . '\\' . $config['field'];

            if ($key == 'site_icon') {
                $fields[] = $_field::make($key)
                    ->label(__('site/settings.entry.' . $key . '.label'))
                    ->disk('media')
                    ->image()
                    ->optimize('ico')
                    ->imagePreviewHeight(300)
                    ->default(fn() => $_option['value']);
                continue;
            }

            if ($key == 'site_logo') {
                $fields[] = $_field::make($key)
                    ->label(__('site/settings.entry.' . $key . '.label'))
                    ->disk('media')
                    ->image()
                    ->optimize('webp')
                    ->imagePreviewHeight(300)
                    ->default(fn() => $_option['value']);
                continue;
            }

            if (isset($config['options'])) {
                $fields[] = $_field::make($key)
                    ->label(__('site/settings.entry.' . $key . '.label'))
                    ->options(Arr::mapWithKeys($config['options'], function ($val, $key) {
                        if (is_string($val) && str($val)->startsWith('TR::')) {
                            $val = __(str($val)->replace('TR::', '')->toString());
                        } elseif (is_bool($val)) {
                            $val = $val ? __('platform.swtiches.on') : __('platform.swtiches.off');
                        } else {
                        }

                        return [$key => $val];
                    }))
                    ->default($_option['value'] ?? null);
                continue;
            }

            $fields[] = $_field::make($key)
                ->label(__('site/settings.entry.' . $key . '.label'))
                ->default($_option['value'] ?? null);
        }

        $contact = SiteOptionsFacade::queryBy('name', 'contact_info')->first();

        if ($contact && $Info = $contact->value) {

            /**
             * Address
             */
            if ($Info->has('address')) {
                $address = $Info->get('address');

                $fields[] = Forms\Components\Fieldset::make(function () {
                    return __('site/settings.entry.contact_address.label');
                })->schema(function () use ($address) {
                    return [
                        Forms\Components\TextInput::make('contact_info.address')
                            ->label(fn (): string => __('site/settings.entry.contact_address.title'))
                            ->nullable()
                            ->minLength(5)
                            ->maxLength(255)
                    ];
                });
            }

            /**
             * Emails
             */
            if ($Info->has('emails')) {
                $emails = $Info->get('emails');
                $fields[] = Forms\Components\Fieldset::make(function () {
                    return __('site/settings.sets.contact_emails.label');
                })->schema(function () use ($emails) {
                    $Emails = [];
                    if (!empty($emails) && is_array($emails) && !array_is_list($emails)) {
                        foreach ($emails as $key => $value) {
                            $Emails[] = Forms\Components\TextInput::make("contact_info.emails.{$key}")
                                ->label(__("site/settings.entry.contact_email_{$key}.label"))
                                ->email()
                                ->default($value);
                        }
                    }
                    return $Emails;
                })->columns(1)->columnSpan(null);
            }

            /**
             * Phones
             */
            if ($Info->has('phones')) {
                $phones = $Info->get('phones');
                $fields[] = Forms\Components\Fieldset::make(function () {
                    return __('site/settings.sets.contact_phones.label');
                })->schema(function () use ($phones) {
                    $Phones = [];
                    if (!empty($phones) && is_array($phones) && !array_is_list($phones)) {
                        foreach ($phones as $key => $value) {
                            $Phones[] = Forms\Components\TextInput::make("contact_info.phones.{$key}")
                                ->label(__("site/settings.entry.contact_phone_{$key}.label"))
                                ->tel()
                                ->extraAttributes([
                                    'dir' => 'ltr',
                                ])
                                ->default($value);
                        }
                    }
                    return $Phones;
                })->columns(1)->columnSpan(null);
            }

            /**
             * Social Links
             */
            if ($Info->has('social')) {
                $social = $Info->get('social');
                $fields[] = Forms\Components\Fieldset::make(function () {
                    return __('site/settings.sets.social_links.label');
                })->schema(function () use ($social) {
                    $SocialLinks = [];
                    if (!empty($social) && is_array($social) && !array_is_list($social)) {
                        foreach ($social as $key => $value) {
                            $SocialLinks[] = Forms\Components\TextInput::make("contact_info.social.{$key}")
                                ->label(__("site/settings.entry.contact_social_{$key}.label"))
                                ->url()
                                ->default($value);
                        }
                    }
                    return $SocialLinks;
                })->columns(1)->columnSpan(null);
            }
        }

        // Form Actions
        $fields[] = Forms\Components\Actions\ActionContainer::make(
            Forms\Components\Actions\Action::make('submit')
                ->label(__('platform.Save'))
                ->action('saveSettings')
        )->columnSpanFull();

        return $form->schema($fields)
            ->statePath('data')
            ->columns(2);
    }

    /**
     *
     *
     */
    public function saveSettings()
    {
        $formData = Arr::map($this->data, function ($value, $name) {
            return [
                'name' => $name,
                'value' => $value,
            ];
        });

        $passed = true;
        $updates = [];

        foreach ($formData as $data) {
            if ($option = $this->records->firstWhere('name', $data['name'])) {

                if ($option->name === 'site_icon') {
                    if (empty($data['value']) || is_string($data['value'])) continue;
                    $_file = Arr::first($data['value']);
                    $path = $_file->storeAs('media/brand/icons', "vegaio-". now()->timestamp .".ico");
                    $option->value = str($path)->ltrim('media/')->toString();
                    $updates[$data['name']] = $option->save();
                    continue;
                }

                if ($option->name === 'site_logo') {
                    if (empty($data['value']) || is_string($data['value'])) continue;
                    $_file = Arr::first($data['value']);
                    $path = $_file->storeAs('media/brand/logos', "vegaio-". now()->timestamp .".webp");
                    $option->value = str($path)->ltrim('media/')->toString();
                    $updates[$data['name']] = $option->save();
                    continue;
                }

                if ($option->name === 'contact_info') {
                    $value = $option->value;
                    $data['value'] = $value->merge($data['value'])->except([
                        'id',
                        'name',
                        'label',
                        'group',
                        'value',
                        'is_auto',
                        'autoload',
                    ]);
                }

                // $updates[$data['name']] = $option->update([
                //     'value' => is_array($data['value']) ? serialize(collect($data['value'])) : $data['value'],
                // ]);

                $option->value = $data['value'];

                $updates[$data['name']] = $option->save();
            }
        }

        foreach ($updates as $key => $val) {
            if ($val == false) {
                Notification::make()
                    ->title("Error saving {$key}!")
                    ->warning()
                    ->send();
                $passed = false;
            }
        }

        if ($passed) {
            Notification::make()
                ->title(__('platform.crud.saved'))
                ->success()
                ->send();

            // $this->redirect($this->getUrl());
        }
    }
}
