<?php

namespace App\Filament\Resources\TestPersonnalises\Pages;

use App\Filament\Pages\MesResultatsDePersonnalites;
use App\Filament\Resources\TestPersonnalises\TestPersonnaliseResource;
use App\Services\TestPersonnalises\TestPersonnaliseResultService;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditTestPersonnalise extends EditRecord
{
    protected static string $resource = TestPersonnaliseResource::class;

    protected function getHeaderActions(): array
    {
        $actions = [ViewAction::make()];

        $actions[0] = $actions[0]->url(fn (): string => TestPersonnaliseResource::getUrl('view', ['record' => $this->getRecord()]));

        if (! auth()->user()?->isStudent()) {
            $actions[] = DeleteAction::make();
        }

        return $actions;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['status'] = 'completed';
        $data['submitted_at'] = $data['submitted_at'] ?? now();

        return array_merge(
            $data,
            app(TestPersonnaliseResultService::class)->calculate($data['answers'] ?? []),
        );
    }

    protected function getRedirectUrl(): ?string
    {
        if (auth()->user()?->isStudent()) {
            return MesResultatsDePersonnalites::getUrl();
        }

        return parent::getRedirectUrl();
    }
}