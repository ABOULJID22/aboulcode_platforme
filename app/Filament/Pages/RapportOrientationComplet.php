<?php

namespace App\Filament\Pages;

use App\Models\AcademicDiagnostic;
use App\Models\TestPersonnalise;
use App\Services\Orientation\AIOrientationService;
use Filament\Pages\Page;

class RapportOrientationComplet extends Page
{
    protected static string $view = 'filament.pages.rapport-orientation-complet';

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Rapport d\'orientation complet';

    protected static ?int $navigationSort = 8;

    public array $report = [];

    public ?AcademicDiagnostic $diagnostic = null;

    public ?TestPersonnalise $personality = null;

    public function mount(): void
    {
        $userId = auth()->id();

        $this->diagnostic = AcademicDiagnostic::query()
            ->where('user_id', $userId)
            ->latest('submitted_at')
            ->first();

        $this->personality = TestPersonnalise::query()
            ->where('user_id', $userId)
            ->latest('submitted_at')
            ->first();

        if (!$this->diagnostic || !$this->personality) {
            return;
        }

        if (!($this->diagnostic->isCompleted() && $this->personality->isCompleted())) {
            return;
        }

        // Utiliser le service d'IA pour générer le rapport
        $service = new AIOrientationService(
            $this->diagnostic,
            $this->personality,
            auth()->user()
        );

        $this->report = $service->generateFullReport();
    }

    public static function canAccess(): bool
    {
        $user = auth()->user();

        if (!$user) {
            return false;
        }

        if (method_exists($user, 'isSuperAdmin') && $user->isSuperAdmin()) {
            return true;
        }

        if (method_exists($user, 'isStudent') && $user->isStudent()) {
            $diagnostic = AcademicDiagnostic::where('user_id', $user->id)->first();
            $personality = TestPersonnalise::where('user_id', $user->id)->first();

            return $diagnostic && $personality && $diagnostic->isCompleted() && $personality->isCompleted();
        }

        return false;
    }

    public function getHeading(): string
    {
        return 'Rapport d\'Orientation Complet';
    }

    public function getSubheading(): ?string
    {
        return 'Analyse personnalisée basée sur vos tests de diagnostic et de personnalité';
    }
}
