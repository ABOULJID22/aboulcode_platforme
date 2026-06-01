<?php

namespace App\Filament\Widgets;

use App\Models\AcademicDiagnostic;
use Filament\Widgets\Widget;

class AcademicDiagnosticProgress extends Widget
{
    protected static string $view = 'filament.widgets.academic-diagnostic-progress';

    public ?AcademicDiagnostic $record = null;

    public function getProgressData(): array
    {
        $userId = auth()->id();

        $totalTests = AcademicDiagnostic::where('user_id', $userId)->count();
        $completedTests = AcademicDiagnostic::where('user_id', $userId)
            ->where('status', 'completed')
            ->count();
        $progressPercent = $totalTests > 0 ? round(($completedTests / $totalTests) * 100) : 0;

        $latestTest = AcademicDiagnostic::where('user_id', $userId)
            ->latest('submitted_at')
            ->first();

        return [
            'total_tests' => $totalTests,
            'completed_tests' => $completedTests,
            'progress_percent' => $progressPercent,
            'latest_test_date' => $latestTest?->submitted_at?->format('d/m/Y H:i') ?? 'Aucun test',
            'latest_test_cycle' => $latestTest?->macro_cycle ?? 'N/A',
        ];
    }
}
