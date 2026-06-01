<?php

namespace App\Filament\Widgets;

use App\Models\AcademicDiagnostic;
use Filament\Widgets\Widget;

class AcademicDiagnosticResult extends Widget
{
    protected static string $view = 'filament.widgets.academic-diagnostic-result';

    public ?AcademicDiagnostic $record = null;

    public function mount(): void
    {
        // Peut être appelé avec un record depuis la page View
    }

    public function getData(): array
    {
        if (!$this->record) {
            return [];
        }

        return [
            'result_code' => $this->record->result_code,
            'result_label' => $this->record->result_label,
            'domains' => $this->record->result_payload['orientation_domains'] ?? [],
            'domain_count' => count($this->record->result_payload['orientation_domains'] ?? []),
            'main_domain' => $this->record->result_payload['orientation_domains'][0] ?? 'Non disponible',
        ];
    }
}
