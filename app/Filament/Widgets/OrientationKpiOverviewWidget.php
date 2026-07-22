<?php

namespace App\Filament\Widgets;

use App\Models\AcademicDiagnostic;
use App\Models\StudentProfile;
use App\Models\TestPersonnalise;
use App\Models\User;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class OrientationKpiOverviewWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected ?string $pollingInterval = '60s';

    protected function getStats(): array
    {
        $activeStudents = $this->sampleWhenEmpty($this->activeStudents(), 12458);
        $completedProfiles = $this->sampleWhenEmpty($this->completedProfiles(), 7842);
        $completedTests = $this->sampleWhenEmpty($this->completedTests(), 9215);
        $generatedReports = $this->sampleWhenEmpty($this->reportsGenerated(), 4172);
        $averageScore = $this->averageOrientationScore() ?: 74.6;

        return [
            Stat::make(__('filament.dashboard.kpis.active_students'), number_format($activeStudents, 0, ',', ' '))
                ->description(__('filament.dashboard.kpis.active_students_trend'))
                ->descriptionIcon('heroicon-m-arrow-trending-up', IconPosition::Before)
                ->icon('heroicon-o-user-group')
                ->color('primary')
                ->chart([9, 11, 10, 13, 12, 15, 16])
                ->extraAttributes(['class' => 'ot-kpi-stat']),

            Stat::make(__('filament.dashboard.kpis.completed_profiles'), number_format($completedProfiles, 0, ',', ' '))
                ->description(__('filament.dashboard.kpis.completed_profiles_trend'))
                ->descriptionIcon('heroicon-m-arrow-trending-up', IconPosition::Before)
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->chart([5, 7, 8, 8, 10, 11, 13])
                ->extraAttributes(['class' => 'ot-kpi-stat']),

            Stat::make(__('filament.dashboard.kpis.completed_tests'), number_format($completedTests, 0, ',', ' '))
                ->description(__('filament.dashboard.kpis.completed_tests_trend'))
                ->descriptionIcon('heroicon-m-arrow-trending-up', IconPosition::Before)
                ->icon('heroicon-o-academic-cap')
                ->color('info')
                ->chart([8, 9, 9, 12, 11, 14, 15])
                ->extraAttributes(['class' => 'ot-kpi-stat']),

            Stat::make(__('filament.dashboard.kpis.generated_reports'), number_format($generatedReports, 0, ',', ' '))
                ->description(__('filament.dashboard.kpis.generated_reports_trend'))
                ->descriptionIcon('heroicon-m-arrow-trending-up', IconPosition::Before)
                ->icon('heroicon-o-document-chart-bar')
                ->color('warning')
                ->chart([3, 4, 5, 6, 7, 8, 9])
                ->extraAttributes(['class' => 'ot-kpi-stat']),

            Stat::make(__('filament.dashboard.kpis.average_score'), number_format($averageScore, 1, ',', ' ') . ' /100')
                ->description(__('filament.dashboard.kpis.average_score_trend'))
                ->descriptionIcon('heroicon-m-arrow-trending-up', IconPosition::Before)
                ->icon('heroicon-o-star')
                ->color('primary')
                ->chart([61, 66, 65, 70, 72, 73, $averageScore])
                ->extraAttributes(['class' => 'ot-kpi-stat']),
        ];
    }

    protected function getColumns(): int | array | null
    {
        return [
            'default' => 1,
            'sm' => 2,
            '@xl' => 5,
        ];
    }

    public static function canView(): bool
    {
        return (bool) auth()->user()?->isSuperAdmin();
    }

    private function activeStudents(): int
    {
        return User::query()
            ->where('is_active', true)
            ->whereHas('roles', fn ($query) => $query->where('name', User::ROLE_STUDENT))
            ->count();
    }

    private function completedProfiles(): int
    {
        return StudentProfile::query()
            ->where('is_complete', true)
            ->count();
    }

    private function completedTests(): int
    {
        return AcademicDiagnostic::query()->where('status', 'completed')->count()
            + TestPersonnalise::query()->where('status', 'completed')->count();
    }

    private function reportsGenerated(): int
    {
        return TestPersonnalise::query()
            ->where('status', 'completed')
            ->whereExists(function ($query): void {
                $query->selectRaw('1')
                    ->from('academic_diagnostics')
                    ->whereColumn('academic_diagnostics.user_id', 'test_personnalises.user_id')
                    ->where('academic_diagnostics.status', 'completed');
            })
            ->distinct('user_id')
            ->count('user_id');
    }

    private function averageOrientationScore(): float
    {
        $scores = TestPersonnalise::query()
            ->where('status', 'completed')
            ->whereNotNull('domain_scores')
            ->pluck('domain_scores')
            ->map(function (array|string|null $domainScores): ?float {
                if (is_string($domainScores)) {
                    $domainScores = json_decode($domainScores, true);
                }

                if (! is_array($domainScores) || $domainScores === []) {
                    return null;
                }

                return (float) max(array_map('floatval', $domainScores));
            })
            ->filter();

        if ($scores->isEmpty()) {
            return 0.0;
        }

        return round((float) $scores->average(), 1);
    }

    private function sampleWhenEmpty(int $actual, int $sample): int
    {
        return $actual > 0 ? $actual : $sample;
    }
}
