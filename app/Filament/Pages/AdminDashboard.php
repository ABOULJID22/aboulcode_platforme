<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\AdminDashboardFooterWidget;
use App\Filament\Widgets\BlogStats;
use App\Filament\Widgets\ContentGuidanceOverviewWidget;
use App\Filament\Widgets\OrientationInsightsWidget;
use App\Filament\Widgets\OrientationKpiOverviewWidget;
use App\Filament\Widgets\QuickActionsWidget;
use App\Filament\Widgets\RecentAdminActivityWidget;
use App\Filament\Widgets\RecommendedDomainsWidget;
use App\Filament\Widgets\RegistrationsOverviewChart;
use App\Filament\Widgets\StudentDashboardStats;
use App\Filament\Widgets\StudentDomainCompatibilityChart;
use App\Filament\Widgets\StudentOrientationSummaryWidget;
use App\Filament\Widgets\StudentPersonalityRadarChart;
use Filament\Actions\Action;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Support\Enums\Width;
use Illuminate\Contracts\Support\Htmlable;
use UnitEnum;

class AdminDashboard extends BaseDashboard
{
    protected static bool $isDiscovered = false;

    protected static ?int $navigationSort = -10;

    protected Width | string | null $maxContentWidth = Width::Full;

    public static function getNavigationLabel(): string
    {
        return __('filament.nav.dashboard');
    }

    public static function getNavigationGroup(): string | UnitEnum | null
    {
        return __('filament.nav.groups.principal');
    }

    public function getTitle(): string | Htmlable
    {
        return __('filament.dashboard.heading', [
            'name' => auth()->user()?->first_name ?: auth()->user()?->name ?: 'Admin',
        ]);
    }

    public function getSubheading(): string | Htmlable | null
    {
        return __('filament.dashboard.subheading');
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('period')
                ->label(__('filament.dashboard.period'))
                ->icon('heroicon-o-calendar-days')
                ->color('gray')
                ->outlined()
                ->disabled(),
        ];
    }

    public function getColumns(): int | array
    {
        return 12;
    }

    public function getWidgets(): array
    {
        $user = auth()->user();

        if ($user?->isSuperAdmin()) {
            return [
                OrientationKpiOverviewWidget::class,
                RegistrationsOverviewChart::class,
                RecommendedDomainsWidget::class,
                OrientationInsightsWidget::class,
                RecentAdminActivityWidget::class,
                QuickActionsWidget::class,
                AdminDashboardFooterWidget::class,
            ];
        }

        if ($user?->isTeacher()) {
            return [
                BlogStats::class,
                ContentGuidanceOverviewWidget::class,
                AdminDashboardFooterWidget::class,
            ];
        }

        if ($user?->isStudent()) {
            return [
                StudentDashboardStats::class,
                StudentPersonalityRadarChart::class,
                StudentDomainCompatibilityChart::class,
                StudentOrientationSummaryWidget::class,
            ];
        }

        return [];
    }
}
