<?php

namespace App\Filament\Pages;

use App\Filament\Resources\AcademicDiagnostics\AcademicDiagnosticResource;
use App\Filament\Resources\TestPersonnalises\TestPersonnaliseResource;
use App\Models\AcademicDiagnostic;
use App\Models\TestPersonnalise;
use App\Services\Orientation\OrientationCompleteResultService;
use BackedEnum;
use Filament\Pages\Page;
use Filament\Notifications\Notification;
use UnitEnum;

class MesResultatsDePersonnalites extends Page
{
    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-chart-bar-square';

    protected static ?string $navigationLabel = 'Mes résultats de personnalités';

    protected static ?int $navigationSort = 7;

    protected static UnitEnum|string|null $navigationGroup = null;

    protected string $view = 'filament.pages.mes-resultats-de-personnalites';

    public ?AcademicDiagnostic $diagnostic = null;

    public ?TestPersonnalise $personnalise = null;

    public array $mergedResult = [];

    public function mount(OrientationCompleteResultService $service): void
    {
        $userId = auth()->id();

        $this->diagnostic = AcademicDiagnostic::query()
            ->where('user_id', $userId)
            ->latest('submitted_at')
            ->first();

        $this->personnalise = TestPersonnalise::query()
            ->where('user_id', $userId)
            ->latest('submitted_at')
            ->first();

        if ($this->hasBothTestsCompleted()) {
            $this->mergedResult = $service->buildCached($this->diagnostic, $this->personnalise);
        }
    }

    public function reconnectGemini(OrientationCompleteResultService $service): void
    {
        if (! $this->hasBothTestsCompleted()) {
            Notification::make()
                ->title('Completez les deux tests avant de reconnecter Gemini.')
                ->warning()
                ->send();

            return;
        }

        $service->forgetCached($this->diagnostic, $this->personnalise);
        $this->mergedResult = $service->buildCached($this->diagnostic, $this->personnalise);

        Notification::make()
            ->title('Gemini a ete reconnecte et le resultat a ete rafraichi.')
            ->success()
            ->send();
    }

    public static function canAccess(): bool
    {
        $user = auth()->user();

        return $user && (
            (method_exists($user, 'isStudent') && $user->isStudent()) ||
            (method_exists($user, 'isSuperAdmin') && $user->isSuperAdmin())
        );
    }

    public function hasBothTestsCompleted(): bool
    {
        return (bool) ($this->diagnostic?->isCompleted() && $this->personnalise?->isCompleted());
    }

    public function diagnosticCompleted(): bool
    {
        return (bool) $this->diagnostic?->isCompleted();
    }

    public function personnaliseCompleted(): bool
    {
        return (bool) $this->personnalise?->isCompleted();
    }

    public function diagnosticLink(): string
    {
        if ($this->diagnostic) {
            return AcademicDiagnosticResource::getUrl('edit', ['record' => $this->diagnostic]);
        }

        return AcademicDiagnosticResource::getUrl('create');
    }

    public function personnaliseLink(): string
    {
        if ($this->personnalise) {
            return TestPersonnaliseResource::getUrl('edit', ['record' => $this->personnalise]);
        }

        return TestPersonnaliseResource::getUrl('create');
    }

    public function personnaliseLocked(): bool
    {
        return ! $this->diagnosticCompleted();
    }
}