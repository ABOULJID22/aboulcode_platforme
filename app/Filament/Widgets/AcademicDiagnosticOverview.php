<?php

namespace App\Filament\Widgets;

use App\Models\AcademicDiagnostic;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AcademicDiagnosticOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $userId = auth()->id();
        $totalDiagnostics = AcademicDiagnostic::where('user_id', $userId)->count();
        $completedDiagnostics = AcademicDiagnostic::where('user_id', $userId)
            ->where('status', 'completed')
            ->count();
        $latestDiagnostic = AcademicDiagnostic::where('user_id', $userId)
            ->latest('submitted_at')
            ->first();

        return [
            Stat::make('Total de Diagnostics', $totalDiagnostics)
                ->description('Tests diagnostiques passés')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('primary'),

            Stat::make('Tests Complétés', $completedDiagnostics)
                ->description('Diagnostics finalisés')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),

            Stat::make('Dernier Test', $latestDiagnostic?->submitted_at?->format('d/m/Y') ?? 'Aucun')
                ->description('Date du dernier diagnostic')
                ->descriptionIcon('heroicon-m-calendar')
                ->color('info'),
        ];
    }
}
