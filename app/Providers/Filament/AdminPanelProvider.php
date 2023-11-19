<?php

namespace App\Providers\Filament;

use App\Support\Facades\SiteOptions as SiteOptionsFacade;
use App\Filament\Admin\Pages\EditProfile;
use Filament\FontProviders\LocalFontProvider;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('admin')
            ->path('manage')
            ->default()
            ->authGuard('web')
            ->login()
            ->profile(EditProfile::class)
            ->darkMode(true)
            ->favicon(fn() => SiteOptionsFacade::siteIcon())
            ->brandLogo(fn() => SiteOptionsFacade::siteLogo())
            ->darkModeBrandLogo(asset('assets/img/brand/svg/logo-land-white.svg'))
            ->colors([
                // 'primary' => Color::Amber,
                'primary' => Color::rgb('rgb(124, 0, 61)'),
                'secondary' => Color::hex('#2B3252'),
            ])
            ->font('DIN-NEXT-REGULAR', '/assets/css/fontiaOne.css', LocalFontProvider::class)
            ->discoverResources(in: app_path('Filament/Admin/Resources'), for: 'App\\Filament\\Admin\\Resources')
            ->discoverPages(in: app_path('Filament/Admin/Pages'), for: 'App\\Filament\\Admin\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->navigationGroups([
                NavigationGroup::make(fn (): string => __('site/settings.Settings'))
                    ->collapsed(),
                NavigationGroup::make(fn (): string => __('models/model.collection.label'))
                    ->collapsed(),
            ])
            ->discoverWidgets(in: app_path('Filament/Admin/Widgets'), for: 'App\\Filament\\Admin\\Widgets')
            ->widgets([
                // Widgets\AccountWidget::class,
                // Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
