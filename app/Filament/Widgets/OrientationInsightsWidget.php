<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class OrientationInsightsWidget extends Widget
{
    protected static ?int $sort = 4;

    protected string $view = 'filament.widgets.orientation-insights-widget';

    protected int | string | array $columnSpan = [
        'default' => 12,
        'lg' => 6,
    ];

    protected function getViewData(): array
    {
        return [
            'metrics' => [
                ['value' => '+18%', 'label' => __('filament.dashboard.insights.metric_ai_interest'), 'color' => 'success'],
                ['value' => '63%', 'label' => __('filament.dashboard.insights.metric_new_domains'), 'color' => 'primary'],
                ['value' => '2.4x', 'label' => __('filament.dashboard.insights.metric_digital_jobs'), 'color' => 'info'],
            ],
        ];
    }

    public static function canView(): bool
    {
        return (bool) auth()->user()?->isSuperAdmin();
    }
}
