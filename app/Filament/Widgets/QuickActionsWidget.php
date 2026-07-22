<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\AcademicDiagnostics\AcademicDiagnosticResource;
use App\Filament\Resources\Domains\DomainResource;
use App\Filament\Resources\OrientationReportResource;
use App\Filament\Resources\TestPersonnalises\TestPersonnaliseResource;
use App\Filament\Resources\Users\UserResource;
use Filament\Widgets\Widget;
use Throwable;

class QuickActionsWidget extends Widget
{
    protected static ?int $sort = 6;

    protected string $view = 'filament.widgets.quick-actions-widget';

    protected int | string | array $columnSpan = [
        'default' => 12,
        'lg' => 3,
    ];

    protected function getViewData(): array
    {
        return [
            'actions' => [
                [
                    'label' => __('filament.dashboard.quick_actions.add_student'),
                    'icon' => 'heroicon-o-user-plus',
                    'url' => $this->safeUrl(fn (): string => UserResource::getUrl('create')),
                ],
                [
                    'label' => __('filament.dashboard.quick_actions.create_test'),
                    'icon' => 'heroicon-o-clipboard-document-check',
                    'url' => $this->safeUrl(fn (): string => TestPersonnaliseResource::getUrl('create')),
                ],
                [
                    'label' => __('filament.dashboard.quick_actions.generate_report'),
                    'icon' => 'heroicon-o-document-chart-bar',
                    'url' => $this->safeUrl(fn (): string => OrientationReportResource::getUrl('index')),
                ],
                [
                    'label' => __('filament.dashboard.quick_actions.import_students'),
                    'icon' => 'heroicon-o-arrow-up-tray',
                    'url' => $this->safeUrl(fn (): string => UserResource::getUrl('index')),
                ],
                [
                    'label' => __('filament.dashboard.quick_actions.add_school'),
                    'icon' => 'heroicon-o-building-library',
                    'url' => $this->safeUrl(fn (): string => AcademicDiagnosticResource::getUrl('index')),
                ],
                [
                    'label' => __('filament.dashboard.quick_actions.explore_domains'),
                    'icon' => 'heroicon-o-squares-2x2',
                    'url' => $this->safeUrl(fn (): string => DomainResource::getUrl('index')),
                ],
            ],
        ];
    }

    public static function canView(): bool
    {
        return (bool) auth()->user()?->isSuperAdmin();
    }

    private function safeUrl(callable $callback): string
    {
        try {
            return $callback();
        } catch (Throwable) {
            return url('/admin');
        }
    }
}
