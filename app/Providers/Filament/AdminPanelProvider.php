<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Tenancy\EditTeamProfile;
use App\Filament\Pages\Tenancy\RegisterTeam;
use App\Filament\Resources\AdminResource\Widgets\AdminOverview;
use App\Filament\Resources\AdminResource\Widgets\EmployeeChart;
use App\Filament\Resources\AdminResource\Widgets\EmployeeTable;
use App\Filament\Resources\AdminResource\Widgets\UserChart;
use App\Http\Middleware\SetLocale;
use App\Http\Middleware\VerifyIsAdmin;
use App\Models\Team;
use Filament\Facades\Filament;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\MenuItem;
use Filament\Navigation\NavigationItem;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentView;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Session;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()

            ->userMenuItems(
                [
                    MenuItem::make()->label('Dashboard')
                        ->url('/app')
                        ->icon('heroicon-s-home'),
                ]
            )->navigationItems([
                  NavigationItem::make('language')
                    ->label(Session::get('locale') == 'ar' ? '🇸🇦 العربية' : '🇺🇸 English')
                    ->url('/switch-language')
                    ->icon('heroicon-m-language'),
            ])
            ->colors([
                'danger' => Color::Red,
                'gray' => Color::Gray,
                'info' => Color::Blue,
                'primary' => Color::Indigo,
                'success' => Color::Emerald,
                'warning' => Color::Orange,
            ])
            ->font('figtree')
            ->brandLogo(
                asset('images/logo.jpg')
            )
            ->navigationGroups([
                'Dashboard',
                'Users',
                'Human Resources',
                'Location'
            ])
            ->brandName('Admin Panel')
            ->favicon(asset('images/logo.jpg'))
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
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
                VerifyIsAdmin::class,
                SetLocale::class
            ])
            // ->authMiddleware([
            //     Authenticate::class,
            // ])
        ;
    }

    public function boot(): void
    {
        Filament::registerWidgets([
            AdminOverview::class,
            EmployeeChart::class,
            UserChart::class,
            EmployeeTable::class
        ]);


        // Filament::serving(function () {
        //     Filament::registerTopNavigationItems([
        //         NavigationItem::make('language')
        //             ->label(app()->getLocale() === 'ar' ? '🇸🇦 العربية' : '🇺🇸 English')
        //             ->url(route('switch.language'))
        //             ->icon('heroicon-m-language'),
        //     ]);
        // });
        FilamentView::registerRenderHook(
            'topbar.start',
            fn () => view('components.language-switcher')
        );
        FilamentView::registerRenderHook(
            'head.start',
            fn() => app()->getLocale() === 'ar' ? '<html dir="rtl">' : '<html>'
        );
    }
}
