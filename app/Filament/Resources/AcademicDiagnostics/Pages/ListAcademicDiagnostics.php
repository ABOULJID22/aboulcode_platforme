<?php

namespace App\Filament\Resources\AcademicDiagnostics\Pages;

use App\Filament\Resources\AcademicDiagnostics\AcademicDiagnosticResource;
use App\Models\AcademicDiagnostic;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAcademicDiagnostics extends ListRecords
{
    protected static string $resource = AcademicDiagnosticResource::class;

    public function mount(): void
    {
        if (auth()->user()?->isStudent()) {
            $existing = AcademicDiagnostic::query()
                ->where('user_id', auth()->id())
                ->latest('submitted_at')
                ->first();

            if ($existing) {
                $this->redirect($this->getResourceUrl('view', ['record' => $existing]), navigate: true);

                return;
            }

            $this->redirect($this->getResourceUrl('create'), navigate: true);

            return;
        }

        parent::mount();
    }

    protected function getHeaderActions(): array
    {
        if (! static::getResource()::canCreate()) {
            return [];
        }

        return [
            CreateAction::make(),
        ];
    }
}
