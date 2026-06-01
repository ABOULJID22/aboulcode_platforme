<x-filament::page>
    @php
        $diagnosticDone = $this->diagnosticCompleted();
        $personnaliseDone = $this->personnaliseCompleted();
        $bothDone = $this->hasBothTestsCompleted();
        $recommendations = $this->mergedResult['ai_recommendations'] ?? [];
        $programChoices = $recommendations['program_choices'] ?? [];
        $summary = $this->mergedResult['narrative'] ?? 'Aucun résumé disponible pour le moment.';
        $aiMessage = $this->mergedResult['ai_status']['message'] ?? 'Analyse locale';

        $axisScores = collect($this->personnalise?->axis_scores ?? [])->sortDesc()->take(6);
        $itScores = collect($this->personnalise?->domain_scores ?? [])->sortDesc()->take(6);
        $axisLabels = $axisScores->keys()->values()->all();
        $axisValues = $axisScores->values()->map(fn ($value) => (float) $value)->all();
        $itLabels = $itScores->keys()->values()->all();
        $itValues = $itScores->values()->map(fn ($value) => (float) $value)->all();
        $chartIdSuffix = 'tp-' . ($this->personnalise?->id ?? 'new');
    @endphp

    <div class="mx-auto max-w-4xl space-y-6 px-4 py-4 sm:px-6 lg:px-8">
        <style>
            .tp-page {
                color: #0f172a;
            }
            .tp-shell {
                border: 1px solid rgba(148, 163, 184, 0.18);
                background: #fff;
                border-radius: 16px;
                box-shadow: 0 6px 18px rgba(15, 23, 42, 0.04);
            }
            .tp-divider {
                border-top: 1px solid rgba(148, 163, 184, 0.16);
            }
            .tp-metric {
                border: 1px solid rgba(148, 163, 184, 0.16);
                background: #f8fafc;
                border-radius: 14px;
                padding: 12px 14px;
            }
            .tp-chip {
                display: inline-flex;
                align-items: center;
                border-radius: 999px;
                border: 1px solid rgba(148, 163, 184, 0.16);
                background: #f8fafc;
                padding: 6px 10px;
                font-size: 12px;
                color: #334155;
                white-space: nowrap;
            }
            .tp-chart {
                border: 1px solid rgba(148, 163, 184, 0.16);
                background: #fff;
                border-radius: 16px;
                padding: 14px;
            }
        </style>

        <div class="tp-page tp-shell space-y-5 p-5 sm:p-6 lg:p-7">
            <header class="space-y-3">
                <div class="flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.18em] text-slate-500">Résultat du test personnalisé</p>
                        <h1 class="mt-2 text-2xl font-semibold tracking-tight text-slate-900">Vue simple et lisible</h1>
                        <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-600">Une page sobre, centrée, avec les statistiques essentielles et les graphiques statiques demandés.</p>
                    </div>

                    @if($bothDone)
                        <button
                            type="button"
                            wire:click="reconnectGemini"
                            wire:loading.attr="disabled"
                            class="inline-flex items-center justify-center rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-medium text-slate-700 shadow-sm transition hover:bg-slate-50 disabled:cursor-wait disabled:opacity-70"
                        >
                            <span wire:loading.remove wire:target="reconnectGemini">Reconnecter</span>
                            <span wire:loading wire:target="reconnectGemini">...</span>
                        </button>
                    @endif
                </div>
            </header>

            <section class="tp-divider pt-5 space-y-3">
                <h2 class="text-sm font-semibold uppercase tracking-[0.18em] text-slate-500">Résumé d'orientation</h2>
                <p class="max-w-3xl text-sm leading-7 text-slate-700">{{ $summary }}</p>
                <p class="text-xs text-slate-500">{{ $aiMessage }}</p>
            </section>

            <section class="tp-divider pt-5 space-y-3">
                <h2 class="text-sm font-semibold uppercase tracking-[0.18em] text-slate-500">Résultat personnalisé</h2>
                <div class="grid gap-2 sm:grid-cols-2 lg:grid-cols-4">
                    <div class="tp-metric">
                        <p class="text-xs font-semibold uppercase tracking-[0.16em] text-slate-500">Statut</p>
                        <p class="mt-1 text-sm font-medium text-slate-900">{{ $diagnosticDone ? 'Test diagnostique fait' : 'À compléter' }}</p>
                    </div>
                    <div class="tp-metric">
                        <p class="text-xs font-semibold uppercase tracking-[0.16em] text-slate-500">Test personnalisé</p>
                        <p class="mt-1 text-sm font-medium text-slate-900">{{ $personnaliseDone ? 'Terminé' : 'À compléter' }}</p>
                    </div>
                    <div class="tp-metric">
                        <p class="text-xs font-semibold uppercase tracking-[0.16em] text-slate-500">Domaine principal</p>
                        <p class="mt-1 text-sm font-medium text-slate-900">{{ $this->personnalise?->primary_domain ?? '—' }}</p>
                    </div>
                    <div class="tp-metric">
                        <p class="text-xs font-semibold uppercase tracking-[0.16em] text-slate-500">Domaine secondaire</p>
                        <p class="mt-1 text-sm font-medium text-slate-900">{{ $this->personnalise?->secondary_domain ?? '—' }}</p>
                    </div>
                </div>
            </section>

            <section class="tp-divider pt-5 space-y-3">
                <h2 class="text-sm font-semibold uppercase tracking-[0.18em] text-slate-500">Scores mis en avant</h2>
                <div class="grid gap-3 sm:grid-cols-2">
                    <div>
                        <p class="text-sm font-medium text-slate-900">Scores par axe</p>
                        <div class="mt-2 flex flex-wrap gap-2">
                            @forelse($axisScores as $axis => $score)
                                <span class="tp-chip">{{ $axis }}: {{ $score }}%</span>
                            @empty
                                <span class="text-sm text-slate-500">Aucune donnée disponible.</span>
                            @endforelse
                        </div>
                    </div>

                    <div>
                        <p class="text-sm font-medium text-slate-900">Scores IT</p>
                        <div class="mt-2 flex flex-wrap gap-2">
                            @forelse($itScores as $domain => $score)
                                <span class="tp-chip">{{ $domain }}: {{ $score }}%</span>
                            @empty
                                <span class="text-sm text-slate-500">Aucune donnée disponible.</span>
                            @endforelse
                        </div>
                    </div>
                </div>
            </section>

            <section class="tp-divider pt-5 space-y-3">
                <h2 class="text-sm font-semibold uppercase tracking-[0.18em] text-slate-500">Visualisation statistique</h2>
                <div class="grid gap-4 lg:grid-cols-2">
                    <div class="tp-chart">
                        <div class="flex items-center justify-between gap-3">
                            <div>
                                <h3 class="text-base font-semibold text-slate-900">Scores par axe</h3>
                                <p class="text-sm text-slate-600">Cercle chart statique</p>
                            </div>
                        </div>
                        <div class="mt-4 h-[240px]">
                            <canvas id="axis-chart-{{ $chartIdSuffix }}"></canvas>
                        </div>
                    </div>

                    <div class="tp-chart">
                        <div class="flex items-center justify-between gap-3">
                            <div>
                                <h3 class="text-base font-semibold text-slate-900">Scores IT</h3>
                                <p class="text-sm text-slate-600">Combo chart statique</p>
                            </div>
                        </div>
                        <div class="mt-4 h-[240px]">
                            <canvas id="it-chart-{{ $chartIdSuffix }}"></canvas>
                        </div>
                    </div>
                </div>
            </section>

            <section class="tp-divider pt-5 space-y-3">
                <h2 class="text-sm font-semibold uppercase tracking-[0.18em] text-slate-500">Recommandations</h2>
                @if(!empty($programChoices))
                    <div class="space-y-2">
                        @foreach($programChoices as $choice)
                            <div class="flex items-center justify-between gap-3 border-b border-slate-100 py-2 text-sm">
                                <span class="font-medium text-slate-800">{{ $choice['title'] ?? '-' }}</span>
                                <span class="text-slate-500">{{ $choice['fit_percent'] ?? 0 }}% | Maroc {{ $choice['morocco_demand_percent'] ?? 0 }}%</span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-sm text-slate-500">Aucune recommandation disponible.</p>
                @endif
            </section>

            <section class="tp-divider pt-5 flex justify-start">
                <a href="{{ $this->personnaliseLink() }}" class="inline-flex items-center rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-medium text-slate-700 shadow-sm transition hover:bg-slate-50">
                    Modifier le test
                </a>
            </section>
        </div>
    </div>

    @once
        @push('scripts')
            <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
        @endpush
    @endonce

    @push('scripts')
        <script>
            (function () {
                const axisCanvas = document.getElementById('axis-chart-{{ $chartIdSuffix }}');
                const itCanvas = document.getElementById('it-chart-{{ $chartIdSuffix }}');

                if (!axisCanvas || !itCanvas || typeof Chart === 'undefined') {
                    return;
                }

                new Chart(axisCanvas, {
                    type: 'doughnut',
                    data: {
                        labels: @json($axisLabels),
                        datasets: [{
                            data: @json($axisValues),
                            backgroundColor: ['#2563eb', '#10b981', '#f59e0b', '#8b5cf6', '#ef4444', '#14b8a6'],
                            borderColor: '#ffffff',
                            borderWidth: 2,
                        }],
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        cutout: '64%',
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    usePointStyle: true,
                                    pointStyle: 'circle',
                                },
                            },
                        },
                    },
                });

                new Chart(itCanvas, {
                    data: {
                        labels: @json($itLabels),
                        datasets: [
                            {
                                type: 'bar',
                                label: 'Score IT',
                                data: @json($itValues),
                                backgroundColor: 'rgba(37, 99, 235, 0.75)',
                                borderRadius: 8,
                                borderSkipped: false,
                            },
                            {
                                type: 'line',
                                label: 'Tendance',
                                data: @json($itValues),
                                borderColor: '#ef4444',
                                tension: 0.3,
                                pointRadius: 4,
                                borderWidth: 2,
                            },
                        ],
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                suggestedMax: 100,
                                ticks: {
                                    callback(value) {
                                        return value + '%';
                                    },
                                },
                            },
                        },
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    usePointStyle: true,
                                    pointStyle: 'circle',
                                },
                            },
                        },
                    },
                });
            })();
        </script>
    @endpush
</x-filament::page>
