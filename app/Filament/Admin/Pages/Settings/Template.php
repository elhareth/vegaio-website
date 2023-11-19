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

class Template extends Page implements HasForms
{
    use InteractsWithForms;
    use InteractsWithActions;
    use InteractsWithFormActions;

    protected static string $view = 'filament.admin.pages.settings.template';

    protected static ?string $slug = 'settings/template';

    // protected static ?string $title = 'Custom Page Title';

    // protected static ?string $navigationGroup = 'settings';

    protected static ?int $navigationSort = 2;
    protected static ?string $navigationIcon = 'heroicon-o-adjustments-horizontal';
    protected static ?string $activeNavigationIcon = 'heroicon-s-adjustments-horizontal';

    public ?array $records = [
        'template_settings' => null,
        'index_hero_section' => null,
        'index_about_section' => null,
        'index_contact_section' => null,
        'index_services_section' => null,
    ];

    public ?array $templateSettings = [];
    public ?array $indexHeroSection = [];
    public ?array $indexAboutSection = [];
    public ?array $indexContactSection = [];
    public ?array $indexServicesSection = [];

    /**
     *
     */
    public function mount(): void
    {
        abort_unless(auth()->user()->canManageSettings(), 403);
        $records = SiteOptionsFacade::getQuery()
            ->whereIn('name', [
                'template_settings',
                'index_hero_section',
                'index_about_section',
                'index_contact_section',
                'index_services_section',
            ])
            ->get()
            ->mapWithKeys(function ($item, $index) {
                return [$item->name => $item];
            })->all();

        foreach ($records as $key => $val) {
            $this->records[$key] = $val;
        }

        $this->templateSettings = $this->records['template_settings']?->value->toArray();
        $this->indexHeroSection = $this->records['index_hero_section']?->value->toArray();
        $this->indexAboutSection = $this->records['index_about_section']?->value->toArray();
        $this->indexContactSection = $this->records['index_contact_section']?->value->toArray();
        $this->indexServicesSection = $this->records['index_services_section']?->value->toArray();

        // $this->heroSectionForm->fill();
    }

    /**
     *
     */
    public function getTitle(): string | Htmlable
    {
        return __('site/settings.term.template-settings.label');
    }

    /**
     *
     */
    public static function getNavigationLabel(): string
    {
        return __('site/settings.term.template-settings.label');
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
        return __('site/settings.term.template-settings.label');
    }

    /**
     *
     */
    public function getSubheading(): ?string
    {
        return __('site/settings.term.template-settings.line');
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
    protected function getForms(): array
    {
        return [
            'templateSettingsForm',
            'heroSectionForm',
            'aboutSectionForm',
            'contactSectionForm',
            'servicesSectionForm',
        ];
    }

    /**
     *
     *
     */
    public function templateSettingsForm(Form $form): Form
    {
        $fields = [];

        // Actions
        $fields[] = Forms\Components\Actions::make([
            Forms\Components\Actions\Action::make('submit')
                ->label(__('platform.Save'))
            // ->action('saveSettings')
        ])->columnSpanFull();

        return $form->schema([
            Forms\Components\Fieldset::make(function () {
                $label = __('site/settings.entry.template_settings');

                if (is_array($label) && array_key_exists('label', $label)) {
                    return $label['label'];
                }

                return $label;
            })
                ->schema($fields),
        ])->statePath('templateSettings');
    }

    /**
     * Hero Section
     */
    public function heroSectionForm(Form $form): Form
    {
        $fields = [];

        $fields[] = Forms\Components\TextInput::make('label')
            ->label(__('models/model.attribute.label.label'))
            ->maxLength(100);
        $fields[] = Forms\Components\Textarea::make('tagline')
            ->label(__('models/model.attribute.tagline.label'))
            ->maxLength(100);
        $fields[] = Forms\Components\RichEditor::make('description')
            ->label(__('models/model.attribute.description.label'))
            ->columnSpanFull();

        // Actions
        $fields[] = Forms\Components\Actions::make([
            Forms\Components\Actions\Action::make('submit')
                ->label(__('platform.Save'))
                ->action('saveHeroSectionForm')
        ])->columnSpanFull();

        return $form->schema([
            Forms\Components\Fieldset::make(function () {
                $label = __('site/settings.entry.index_hero_section');

                if (is_array($label) && array_key_exists('label', $label)) {
                    return $label['label'];
                }

                return $label;
            })
                ->schema($fields),
        ])->statePath('indexHeroSection');
    }

    public function saveHeroSectionForm()
    {
        $this->records['index_hero_section']->value = $this->indexHeroSection;

        if ($this->records['index_hero_section']->save()) {
            Notification::make()
                ->title(__('platform.crud.saved'))
                ->success()
                ->send();
        }

        $this->heroSectionForm->fill($this->records['index_hero_section']->value?->toArray());
    }

    /**
     * About Section
     */
    public function aboutSectionForm(Form $form): Form
    {
        $fields = [];

        $fields[] = Forms\Components\TextInput::make('label')
            ->label(__('models/model.attribute.label.label'))
            ->maxLength(100);

        $fields[] = Forms\Components\Textarea::make('tagline')
            ->label(__('models/model.attribute.tagline.label'))
            ->maxLength(100);

        $fields[] = Forms\Components\RichEditor::make('description')
            ->label(__('models/model.attribute.description.label'))
            ->columnSpanFull();

        $fields[] = Forms\Components\Section::make([
            Forms\Components\Repeater::make('tiles')
                ->label(__('models/model.attribute.tiles.label'))
                ->schema([
                    Forms\Components\TextInput::make('icon')
                    ->label(__('models/model.attribute.icon.label')),

                    Forms\Components\TextInput::make('label')
                    ->label(__('models/model.attribute.label.label')),

                    Forms\Components\TextInput::make('title')
                    ->label(__('models/model.attribute.title.label')),

                    Forms\Components\TextInput::make('description')
                    ->label(__('models/model.attribute.description.label')),

                ])
        ]);
        $fields[] = Forms\Components\Fieldset::make('action')
            ->schema([
                Forms\Components\TextInput::make('action.label'),
                Forms\Components\TextInput::make('action.route'),
            ]);

        // Actions
        $fields[] = Forms\Components\Actions::make([
            Forms\Components\Actions\Action::make('submit')
                ->label(__('platform.Save'))
                ->action('saveAboutSectionForm')
        ])->columnSpanFull();

        return $form->schema([
            Forms\Components\Fieldset::make(function () {
                $label = __('site/settings.entry.index_about_section');

                if (is_array($label) && array_key_exists('label', $label)) {
                    return $label['label'];
                }

                return $label;
            })->schema($fields),
        ])->statePath('indexAboutSection');
    }

    /**
     * Save About
     */
    public function saveAboutSectionForm()
    {
        $this->records['index_about_section']->value = $this->indexAboutSection;

        if ($this->records['index_about_section']->save()) {
            Notification::make()
                ->title(__('platform.crud.saved'))
                ->success()
                ->send();
        }

        $this->aboutSectionForm->fill($this->records['index_about_section']->value?->toArray());
    }

    /**
     * Contact Section
     */
    public function contactSectionForm(Form $form): Form
    {
        $fields = [];

        $fields[] = Forms\Components\TextInput::make('label')
            ->label(__('models/model.attribute.label.label'))
            ->maxLength(100);
        $fields[] = Forms\Components\Textarea::make('tagline')
            ->label(__('models/model.attribute.tagline.label'))
            ->maxLength(100);
        $fields[] = Forms\Components\RichEditor::make('description')
            ->label(__('models/model.attribute.description.label'))
            ->columnSpanFull();

        // Actions
        $fields[] = Forms\Components\Actions::make([
            Forms\Components\Actions\Action::make('submit')
                ->label(__('platform.Save'))
                ->action('saveContactSectionForm')
        ])->columnSpanFull();

        return $form->schema([
            Forms\Components\Fieldset::make(function () {
                $label = __('site/settings.entry.index_contact_section');

                if (is_array($label) && array_key_exists('label', $label)) {
                    return $label['label'];
                }

                return $label;
            })
                ->schema($fields),
        ])->statePath('indexContactSection');
    }

    /**
     * Save About
     */
    public function saveContactSectionForm()
    {
        $this->records['index_contact_section']->value = $this->indexContactSection;

        if ($this->records['index_contact_section']->save()) {
            Notification::make()
                ->title(__('platform.crud.saved'))
                ->success()
                ->send();
        }

        $this->contactSectionForm->fill($this->records['index_contact_section']->value?->toArray());
    }

    /**
     * Services Section
     */
    public function servicesSectionForm(Form $form): Form
    {
        $fields = [];

        $fields[] = Forms\Components\TextInput::make('label')
            ->label(__('models/model.attribute.label.label'))
            ->maxLength(100);
        $fields[] = Forms\Components\Textarea::make('tagline')
            ->label(__('models/model.attribute.tagline.label'))
            ->maxLength(100);
        $fields[] = Forms\Components\RichEditor::make('description')
            ->label(__('models/model.attribute.description.label'))
            ->columnSpanFull();

        // Actions
        $fields[] = Forms\Components\Actions::make([
            Forms\Components\Actions\Action::make('submit')
                ->label(__('platform.Save'))
                ->action('saveServicesSectionForm')
        ])->columnSpanFull();

        return $form->schema([
            Forms\Components\Fieldset::make(function () {
                $label = __('site/settings.entry.index_services_section');

                if (is_array($label) && array_key_exists('label', $label)) {
                    return $label['label'];
                }

                return $label;
            })
                ->schema($fields),
        ])->statePath('indexServicesSection');
    }

    /**
     * Save About
     */
    public function saveServicesSectionForm()
    {
        $this->records['index_services_section']->value = $this->indexServicesSection;

        if ($this->records['index_services_section']->save()) {
            Notification::make()
                ->title(__('platform.crud.saved'))
                ->success()
                ->send();
        }

        $this->servicesSectionForm->fill($this->records['index_services_section']->value?->toArray());
    }
}
