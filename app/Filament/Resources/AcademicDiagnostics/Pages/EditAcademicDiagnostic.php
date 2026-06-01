<?php

namespace App\Filament\Resources\AcademicDiagnostics\Pages;

use App\Filament\Resources\AcademicDiagnostics\AcademicDiagnosticResource;
use App\Services\Diagnostics\AcademicDiagnosticResultService;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditAcademicDiagnostic extends EditRecord
{
    protected static string $resource = AcademicDiagnosticResource::class;

    protected function getHeaderActions(): array
    {
        if (auth()->user()?->isStudent()) {
            return [
                ViewAction::make(),
            ];
        }

        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['status'] = 'completed';
        $data['submitted_at'] = $data['submitted_at'] ?? now();

        return array_merge(
            $data,
            app(AcademicDiagnosticResultService::class)->calculate($data),
        );
    }

}
