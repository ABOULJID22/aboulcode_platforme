<?php

namespace App\Filament\Resources\AcademicDiagnostics\Pages;

use App\Filament\Resources\AcademicDiagnostics\AcademicDiagnosticResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewAcademicDiagnostic extends ViewRecord
{
    protected static string $resource = AcademicDiagnosticResource::class;

    protected string $view = 'filament.resources.academic-diagnostics.pages.view-academic-diagnostic';

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }

    public function getDomainSeries(): array
    {
        return collect($this->getRecord()->result_payload['orientation_domains'] ?? [])
            ->values()
            ->map(fn (string $domain): array => [
                'label' => $domain,
                'score' => 100,
            ])
            ->all();
    }

    public function getRecommendationStats(): array
    {
        $payload = $this->getRecord()->result_payload ?? [];
        $recommendedSchools = $payload['recommended_schools'] ?? [];
        $skillsMatch = $payload['skills_match'] ?? [];

        return [
            'domains_count' => count($payload['orientation_domains'] ?? []),
            'school_groups_count' => count($recommendedSchools),
            'schools_count' => collect($recommendedSchools)->flatten()->count(),
            'skills_count' => count($skillsMatch),
        ];
    }

    public function getMetadata(): array
    {
        $record = $this->getRecord();

        return [
            'result_label' => $record->result_label ?: '—',
            'result_code' => $record->result_code ?: '—',
            'macro_cycle' => $record->macro_cycle ?: '—',
            'academic_level' => $record->academic_level ?: '—',
            'interest_theme' => $record->interest_theme ?: '—',
            'track_branch' => $record->track_branch ?: '—',
            'institution_type' => $record->institution_type ?: '—',
            'specialty_family' => $record->specialty_family ?: '—',
            'specialty_label' => $record->specialty_label ?: '—',
            'biof_language' => $record->biof_language ?: '—',
            'status' => $record->status ?: '—',
            'submitted_at' => $record->submitted_at,
            'created_at' => $record->created_at,
            'updated_at' => $record->updated_at,
        ];
    }

    public function getSummary(): string
    {
        return $this->getRecord()->result_summary ?: 'Aucun résumé disponible.';
    }
}
