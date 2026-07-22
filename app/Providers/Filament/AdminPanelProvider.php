<?php

namespace App\Providers\Filament;

use App\Filament\Pages\AdminDashboard;
use App\Filament\Pages\SupportConversations;
use App\Filament\Widgets\BlogStats;
use App\Filament\Widgets\ContentGuidanceOverviewWidget;
use App\Http\Middleware\CheckUserIsSuperAdmin;
use App\Http\Middleware\SetLocaleFromSession;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Filament\Actions\Action;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationGroup;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\View\PanelsRenderHook;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            /* ->login() */
            ->colors([
                'primary' => Color::hex('#2563eb'),
            ])
            ->darkMode()
            ->brandName('OrientationTech')
            ->brandLogo(fn () => view('filament.admin.logo'))
            ->favicon(asset('favicon.png'))
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                AdminDashboard::class,
            ])
            ->navigationGroups([
                NavigationGroup::make(fn (): string => __('filament.nav.groups.principal'))
                    ->collapsible(false),
                NavigationGroup::make(fn (): string => __('filament.nav.groups.administration'))
                    ->collapsible(false),
                NavigationGroup::make(fn (): string => __('filament.nav.groups.support'))
                    ->collapsible(false),
                NavigationGroup::make(fn (): string => __('filament.nav.groups.content'))
                    ->collapsible(false),
                NavigationGroup::make(fn (): string => __('filament.nav.groups.blog'))
                    ->collapsible(false),
                NavigationGroup::make(fn (): string => __('filament.nav.groups.my_orientation')),
            ])
            //->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                \App\Filament\Widgets\OrientationKpiOverviewWidget::class,
                \App\Filament\Widgets\RegistrationsOverviewChart::class,
                \App\Filament\Widgets\RecommendedDomainsWidget::class,
                \App\Filament\Widgets\OrientationInsightsWidget::class,
                \App\Filament\Widgets\RecentAdminActivityWidget::class,
                \App\Filament\Widgets\QuickActionsWidget::class,
                \App\Filament\Widgets\StudentDashboardStats::class,
                \App\Filament\Widgets\StudentPersonalityRadarChart::class,
                \App\Filament\Widgets\StudentDomainCompatibilityChart::class,
                \App\Filament\Widgets\StudentOrientationSummaryWidget::class,
                \App\Filament\Widgets\AdminDashboardStats::class,
                \App\Filament\Widgets\AdminRegistrationsChart::class,
                \App\Filament\Widgets\AdminDomainTrendsChart::class,
                \App\Filament\Widgets\AdminPlatformOverviewWidget::class,
                BlogStats::class,
                ContentGuidanceOverviewWidget::class,
                \App\Filament\Widgets\AdminDashboardFooterWidget::class,
            ])
            ->renderHook(
                PanelsRenderHook::GLOBAL_SEARCH_AFTER,
                fn (): string => view('filament.partials.lang-switch')->render(),
            )
            ->renderHook(
                PanelsRenderHook::SIDEBAR_FOOTER,
                fn (): string => view('filament.partials.sidebar-support-card')->render(),
            )
            ->renderHook(
                PanelsRenderHook::BODY_END,
                fn (): string => view('filament.partials.hide-header')->render(),
            )
            ->globalSearch()
            ->globalSearchKeyBindings(['command+k', 'ctrl+k'])
            ->globalSearchFieldKeyBindingSuffix()
            ->databaseNotificationsPolling('10s')
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
                SetLocaleFromSession::class,
            ])
            ->authMiddleware([
                Authenticate::class,
                CheckUserIsSuperAdmin::class,
            ])
            ->plugins([
                FilamentShieldPlugin::make(),
            ])
            ->viteTheme('resources/css/filament/admin/theme.css')
            ->homeUrl('/')
            ->userMenuItems([
                Action::make('home')
                    ->label(__('filament.user_menu.home'))
                    ->icon('heroicon-m-home')
                    ->url('/'),
                'profile' => Action::make('profile')
                    ->label('Profil')
                    ->icon('heroicon-m-user')
                    ->url('/profile'),
                Action::make('support')
                    ->label(__('filament.dashboard.footer.support'))
                    ->icon('heroicon-m-lifebuoy')
                    ->url(fn (): string => SupportConversations::getUrl()),
                Action::make('lang-fr')
                    ->label('Français')
                    ->icon('heroicon-m-language')
                    ->url('/locale/fr')
                    ->sort(-10),
                Action::make('lang-en')
                    ->label('English')
                    ->icon('heroicon-m-language')
                    ->url('/locale/en')
                    ->sort(-9),
            ])
            ->sidebarWidth('18rem')
            ->databaseNotifications();
    }

    public static function canAccess(): bool
    {
        $user = auth()->user();

        return $user && ($user->isSuperAdmin() || $user->isTeacher() || $user->isStudent());
    }
}
