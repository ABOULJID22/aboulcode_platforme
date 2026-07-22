<?php

namespace App\Filament\Widgets;

use App\Models\TestPersonnalise;
use App\Filament\Resources\Domains\DomainResource;
use App\Services\TestPersonnalises\TestPersonnaliseResultService;
use Filament\Widgets\Widget;

class RecommendedDomainsWidget extends Widget
{
    protected static ?int $sort = 3;

    protected string $view = 'filament.widgets.recommended-domains-widget';

    protected int | string | array $columnSpan = [
        'default' => 12,
        'lg' => 5,
    ];

    protected function getViewData(): array
    {
        return [
            'domains' => $this->domains(),
            'viewAllUrl' => DomainResource::getUrl('index'),
        ];
    }

    public static function canView(): bool
    {
        return (bool) auth()->user()?->isSuperAdmin();
    }

    private function domains(): array
    {
        $counts = [];

        TestPersonnalise::query()
            ->where('status', 'completed')
            ->whereNotNull('primary_domain')
            ->pluck('primary_domain')
            ->each(function (string $domain) use (&$counts): void {
                $counts[$domain] = ($counts[$domain] ?? 0) + 1;
            });

        if ($counts === []) {
            return [
                ['label' => __('filament.dashboard.domains.science_tech'), 'value' => 26.5, 'color' => 'primary', 'icon' => 'heroicon-o-cpu-chip'],
                ['label' => __('filament.dashboard.domains.health'), 'value' => 21.3, 'color' => 'success', 'icon' => 'heroicon-o-heart'],
                ['label' => __('filament.dashboard.domains.business'), 'value' => 17.8, 'color' => 'warning', 'icon' => 'heroicon-o-briefcase'],
                ['label' => __('filament.dashboard.domains.engineering'), 'value' => 14.2, 'color' => 'info', 'icon' => 'heroicon-o-wrench-screwdriver'],
                ['label' => __('filament.dashboard.domains.arts'), 'value' => 8.7, 'color' => 'danger', 'icon' => 'heroicon-o-paint-brush'],
                ['label' => __('filament.dashboard.domains.social'), 'value' => 7.5, 'color' => 'gray', 'icon' => 'heroicon-o-users'],
            ];
        }

        arsort($counts);
        $total = max(1, array_sum($counts));
        $colors = ['primary', 'success', 'warning', 'info', 'danger', 'gray'];
        $icons = ['heroicon-o-cpu-chip', 'heroicon-o-heart', 'heroicon-o-briefcase', 'heroicon-o-wrench-screwdriver', 'heroicon-o-paint-brush', 'heroicon-o-users'];

        return collect($counts)
            ->take(6)
            ->map(fn (int $count, string $domain): array => [
                'label' => TestPersonnaliseResultService::domainLabel($domain),
                'count' => $count,
            ])
            ->values()
            ->map(function (array $domain, int $index) use ($total, $colors, $icons): array {
                return [
                    'label' => $domain['label'],
                    'value' => round(($domain['count'] / $total) * 100, 1),
                    'color' => $colors[$index] ?? 'gray',
                    'icon' => $icons[$index] ?? 'heroicon-o-squares-2x2',
                ];
            })
            ->all();
    }
}
