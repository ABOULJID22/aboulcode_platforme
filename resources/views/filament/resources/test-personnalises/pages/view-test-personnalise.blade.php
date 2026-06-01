<x-filament-panels::page>
    @php
        $record = $this->getRecord();
        $axisSeries = $this->axisScoreSeries();
        $domainSeries = $this->domainScoreSeries();
        $metadata = $this->getMetadata();
        $chartIdSuffix = 'tp-view-' . $record->getKey();

        $axisLabels = collect($axisSeries)->pluck('label')->all();
        $axisValues = collect($axisSeries)->pluck('score')->all();
        $domainLabels = collect($domainSeries)->pluck('label')->all();
        $domainValues = collect($domainSeries)->pluck('score')->all();
    @endphp

    <div class="mx-auto max-w-6xl space-y-6 px-4 py-4 sm:px-6 lg:px-8">
        <style>
            .tp-result-shell {
                border: 1px solid rgba(148, 163, 184, 0.16);
                background:
                    radial-gradient(circle at top left, rgba(37, 99, 235, 0.08), transparent 32%),
                    radial-gradient(circle at top right, rgba(16, 185, 129, 0.08), transparent 28%),
                    #ffffff;
                border-radius: 24px;
                box-shadow: 0 20px 60px rgba(15, 23, 42, 0.08);
            }

            .tp-section {
                border-top: 1px solid rgba(148, 163, 184, 0.16);
            }

            .tp-card {
                border: 1px solid rgba(148, 163, 184, 0.18);
                background: rgba(248, 250, 252, 0.9);
                border-radius: 18px;
                padding: 16px;
            }

            .tp-chip {
                display: inline-flex;
                align-items: center;
                gap: 0.35rem;
                border-radius: 999px;
                border: 1px solid rgba(148, 163, 184, 0.18);
                background: #fff;
                padding: 0.4rem 0.75rem;
                font-size: 0.75rem;
                font-weight: 600;
                color: #334155;
            }

            .tp-chart {
                border: 1px solid rgba(148, 163, 184, 0.16);
                background: #fff;
                border-radius: 20px;
                padding: 18px;
                box-shadow: 0 10px 30px rgba(15, 23, 42, 0.04);
            }

            .tp-soft-label {
                font-size: 0.75rem;
                font-weight: 700;
                letter-spacing: 0.14em;
                text-transform: uppercase;
                color: #64748b;
            }
        </style>

        <div class="tp-result-shell space-y-6 p-5 sm:p-6 lg:p-8">
            <header class="space-y-4">
                <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
                    <div class="max-w-3xl space-y-3">
                        <p class="tp-soft-label">Résultat personnalisé</p>
                        <div>
                            <h1 class="text-3xl font-semibold tracking-tight text-slate-950 sm:text-4xl">
                                {{ $metadata['primary_domain'] }}
                            </h1>
                            <p class="mt-2 text-sm leading-6 text-slate-600 sm:text-base">
                                Vue de synthèse du test personnalisé avec les indicateurs clés, les statistiques par axe et les scores IT.
                            </p>
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-2 lg:justify-end">
                        <span class="tp-chip">Niveau cible: {{ $metadata['target_level'] }}</span>
                        <span class="tp-chip">Statut: {{ $metadata['status'] }}</span>
                        <span class="tp-chip">Version: {{ $metadata['version'] }}</span>
                    </div>
                </div>

                <div class="grid gap-3 sm:grid-cols-2 xl:grid-cols-4">
                    <div class="tp-card">
                        <p class="tp-soft-label">Domaine principal</p>
                        <p class="mt-2 text-base font-semibold text-slate-950">{{ $metadata['primary_domain'] }}</p>
                    </div>
                    <div class="tp-card">
                        <p class="tp-soft-label">Domaine secondaire</p>
                        <p class="mt-2 text-base font-semibold text-slate-950">{{ $metadata['secondary_domain'] }}</p>
                    </div>
                    <div class="tp-card">
                        <p class="tp-soft-label">Nom du test</p>
                        <p class="mt-2 text-base font-semibold text-slate-950">{{ $metadata['test_name'] }}</p>
                    </div>
                    <div class="tp-card">
                        <p class="tp-soft-label">Dernière mise à jour</p>
                        <p class="mt-2 text-base font-semibold text-slate-950">
                            {{ optional($metadata['updated_at'])->format('d/m/Y H:i') ?? '—' }}
                        </p>
                    </div>
                </div>
            </header>

            <section class="tp-section pt-6 space-y-4">
                <div>
                    <p class="tp-soft-label">Scores mis en avant</p>
                    <h2 class="mt-1 text-xl font-semibold text-slate-950">Lecture rapide des meilleurs scores</h2>
                </div>

                <div class="grid gap-4 lg:grid-cols-2">
                    <div class="tp-chart">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <h3 class="text-base font-semibold text-slate-950">Scores par axe</h3>
                                <p class="text-sm text-slate-600">Répartition des axes les plus forts du test.</p>
                            </div>
                        </div>

                        <div class="mt-4 h-[300px]">
                            <canvas id="axis-chart-{{ $chartIdSuffix }}"></canvas>
                        </div>
                    </div>

                    <div class="tp-chart">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <h3 class="text-base font-semibold text-slate-950">Scores IT</h3>
                                <p class="text-sm text-slate-600">Profil des domaines IT prioritaires.</p>
                            </div>
                        </div>

                        <div class="mt-4 h-[300px]">
                            <canvas id="it-chart-{{ $chartIdSuffix }}"></canvas>
                        </div>
                    </div>
                </div>
            </section>

            <section class="tp-section pt-6 space-y-3">
                <div>
                    <p class="tp-soft-label">Résumé</p>
                    <h2 class="mt-1 text-xl font-semibold text-slate-950">Interprétation du résultat</h2>
                </div>

                <div class="rounded-2xl border border-slate-200 bg-slate-50/80 p-5 text-sm leading-7 text-slate-700">
                    {{ $this->getResultSummary() }}
                </div>
            </section>

            <section class="tp-section pt-6 space-y-3">
                <div>
                    <p class="tp-soft-label">Métadonnées</p>
                    <h2 class="mt-1 text-xl font-semibold text-slate-950">Informations techniques</h2>
                </div>

                <div class="grid gap-3 sm:grid-cols-2 xl:grid-cols-4">
                    <div class="tp-card">
                        <p class="tp-soft-label">Soumis le</p>
                        <p class="mt-2 text-sm font-semibold text-slate-950">{{ optional($metadata['submitted_at'])->format('d/m/Y H:i') ?? '—' }}</p>
                    </div>
                    <div class="tp-card">
                        <p class="tp-soft-label">Créé le</p>
                        <p class="mt-2 text-sm font-semibold text-slate-950">{{ optional($metadata['created_at'])->format('d/m/Y H:i') ?? '—' }}</p>
                    </div>
                    <div class="tp-card">
                        <p class="tp-soft-label">Mis à jour le</p>
                        <p class="mt-2 text-sm font-semibold text-slate-950">{{ optional($metadata['updated_at'])->format('d/m/Y H:i') ?? '—' }}</p>
                    </div>
                    <div class="tp-card">
                        <p class="tp-soft-label">Version test</p>
                        <p class="mt-2 text-sm font-semibold text-slate-950">{{ $metadata['version'] }}</p>
                    </div>
                </div>
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

                const axisLabels = @json($axisLabels);
                const axisValues = @json($axisValues);
                const itLabels = @json($domainLabels);
                const itValues = @json($domainValues);

                new Chart(axisCanvas, {
                    type: 'doughnut',
                    data: {
                        labels: axisLabels,
                        datasets: [{
                            data: axisValues,
                            backgroundColor: ['#2563eb', '#10b981', '#f59e0b', '#8b5cf6', '#ef4444', '#14b8a6', '#0f766e', '#6366f1'],
                            borderColor: '#ffffff',
                            borderWidth: 2,
                        }],
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        cutout: '66%',
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
                    type: 'bar',
                    data: {
                        labels: itLabels,
                        datasets: [{
                            label: 'Score IT',
                            data: itValues,
                            backgroundColor: 'rgba(37, 99, 235, 0.78)',
                            borderRadius: 10,
                            borderSkipped: false,
                        }],
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                max: 100,
                                ticks: {
                                    callback: value => value + '%',
                                },
                                grid: {
                                    color: 'rgba(148, 163, 184, 0.18)',
                                },
                            },
                            x: {
                                grid: {
                                    display: false,
                                },
                            },
                        },
                        plugins: {
                            legend: {
                                display: false,
                            },
                            tooltip: {
                                callbacks: {
                                    label: context => context.parsed.y + '%',
                                },
                            },
                        },
                    },
                });
            })();
        </script>
    @endpush
</x-filament-panels::page>