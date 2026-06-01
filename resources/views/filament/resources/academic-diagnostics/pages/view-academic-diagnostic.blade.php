<x-filament-panels::page>
    @php
        $record = $this->getRecord();
        $metadata = $this->getMetadata();
        $domainSeries = $this->getDomainSeries();
        $stats = $this->getRecommendationStats();
        $summary = $this->getSummary();
        $chartIdSuffix = 'ad-view-' . $record->getKey();

        $domainLabels = collect($domainSeries)->pluck('label')->all();
        $domainValues = collect($domainSeries)->pluck('score')->all();
    @endphp

    <div class="mx-auto max-w-6xl space-y-6 px-4 py-4 sm:px-6 lg:px-8">
        <style>
            .ad-result-shell {
                border: 1px solid rgba(148, 163, 184, 0.16);
                background:
                    radial-gradient(circle at top left, rgba(37, 99, 235, 0.08), transparent 32%),
                    radial-gradient(circle at top right, rgba(16, 185, 129, 0.08), transparent 28%),
                    #ffffff;
                border-radius: 24px;
                box-shadow: 0 20px 60px rgba(15, 23, 42, 0.08);
            }

            .ad-section {
                border-top: 1px solid rgba(148, 163, 184, 0.16);
            }

            .ad-card {
                border: 1px solid rgba(148, 163, 184, 0.18);
                background: rgba(248, 250, 252, 0.9);
                border-radius: 18px;
                padding: 16px;
            }

            .ad-chip {
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

            .ad-chart {
                border: 1px solid rgba(148, 163, 184, 0.16);
                background: #fff;
                border-radius: 20px;
                padding: 18px;
                box-shadow: 0 10px 30px rgba(15, 23, 42, 0.04);
            }

            .ad-soft-label {
                font-size: 0.75rem;
                font-weight: 700;
                letter-spacing: 0.14em;
                text-transform: uppercase;
                color: #64748b;
            }
        </style>

        <div class="ad-result-shell space-y-6 p-5 sm:p-6 lg:p-8">
            <header class="space-y-4">
                <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
                    <div class="max-w-3xl space-y-3">
                        <p class="ad-soft-label">Résultat du diagnostic académique</p>
                        <div>
                            <h1 class="text-3xl font-semibold tracking-tight text-slate-950 sm:text-4xl">
                                {{ $metadata['result_label'] }}
                            </h1>
                            <p class="mt-2 text-sm leading-6 text-slate-600 sm:text-base">
                                Synthèse professionnelle du diagnostic avec domaines recommandés, indicateurs clés et métadonnées du dossier.
                            </p>
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-2 lg:justify-end">
                        <span class="ad-chip">Code: {{ $metadata['result_code'] }}</span>
                        <span class="ad-chip">Cycle: {{ $metadata['macro_cycle'] }}</span>
                        <span class="ad-chip">Statut: {{ $metadata['status'] }}</span>
                    </div>
                </div>

                <div class="grid gap-3 sm:grid-cols-2 xl:grid-cols-4">
                    <div class="ad-card">
                        <p class="ad-soft-label">Niveau académique</p>
                        <p class="mt-2 text-base font-semibold text-slate-950">{{ $metadata['academic_level'] }}</p>
                    </div>
                    <div class="ad-card">
                        <p class="ad-soft-label">Centre d’intérêt</p>
                        <p class="mt-2 text-base font-semibold text-slate-950">{{ $metadata['interest_theme'] }}</p>
                    </div>
                    <div class="ad-card">
                        <p class="ad-soft-label">Branche / orientation</p>
                        <p class="mt-2 text-base font-semibold text-slate-950">{{ $metadata['track_branch'] }}</p>
                    </div>
                    <div class="ad-card">
                        <p class="ad-soft-label">Spécialité</p>
                        <p class="mt-2 text-base font-semibold text-slate-950">{{ $metadata['specialty_label'] }}</p>
                    </div>
                </div>
            </header>

            <section class="ad-section pt-6 space-y-4">
                <div>
                    <p class="ad-soft-label">Résultat personnalisé</p>
                    <h2 class="mt-1 text-xl font-semibold text-slate-950">Vue rapide du diagnostic</h2>
                </div>

                <div class="grid gap-3 sm:grid-cols-2 xl:grid-cols-4">
                    <div class="ad-card">
                        <p class="ad-soft-label">Type d’établissement</p>
                        <p class="mt-2 text-sm font-semibold text-slate-950">{{ $metadata['institution_type'] }}</p>
                    </div>
                    <div class="ad-card">
                        <p class="ad-soft-label">Famille de spécialité</p>
                        <p class="mt-2 text-sm font-semibold text-slate-950">{{ $metadata['specialty_family'] }}</p>
                    </div>
                    <div class="ad-card">
                        <p class="ad-soft-label">Langue</p>
                        <p class="mt-2 text-sm font-semibold text-slate-950">{{ $metadata['biof_language'] }}</p>
                    </div>
                    <div class="ad-card">
                        <p class="ad-soft-label">Orientation détectée</p>
                        <p class="mt-2 text-sm font-semibold text-slate-950">{{ $metadata['result_label'] }}</p>
                    </div>
                </div>
            </section>

            <section class="ad-section pt-6 space-y-4">
                <div>
                    <p class="ad-soft-label">Scores visuels</p>
                    <h2 class="mt-1 text-xl font-semibold text-slate-950">Domaines et statistiques clés</h2>
                </div>

                <div class="grid gap-4 lg:grid-cols-2">
                    <div class="ad-chart">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <h3 class="text-base font-semibold text-slate-950">Domaines recommandés</h3>
                                <p class="text-sm text-slate-600">Répartition des domaines d’orientation suggérés.</p>
                            </div>
                        </div>

                        <div class="mt-4 h-[300px]">
                            <canvas id="domain-chart-{{ $chartIdSuffix }}"></canvas>
                        </div>
                    </div>

                    <div class="ad-chart">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <h3 class="text-base font-semibold text-slate-950">Indicateurs du dossier</h3>
                                <p class="text-sm text-slate-600">Résumé statistique des recommandations disponibles.</p>
                            </div>
                        </div>

                        <div class="mt-4 grid gap-3 sm:grid-cols-2">
                            <div class="ad-card">
                                <p class="ad-soft-label">Domaines</p>
                                <p class="mt-2 text-3xl font-semibold text-slate-950">{{ $stats['domains_count'] }}</p>
                            </div>
                            <div class="ad-card">
                                <p class="ad-soft-label">Groupes d’écoles</p>
                                <p class="mt-2 text-3xl font-semibold text-slate-950">{{ $stats['school_groups_count'] }}</p>
                            </div>
                            <div class="ad-card">
                                <p class="ad-soft-label">Écoles / universités</p>
                                <p class="mt-2 text-3xl font-semibold text-slate-950">{{ $stats['schools_count'] }}</p>
                            </div>
                            <div class="ad-card">
                                <p class="ad-soft-label">Compétences matchées</p>
                                <p class="mt-2 text-3xl font-semibold text-slate-950">{{ $stats['skills_count'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="ad-section pt-6 space-y-3">
                <div>
                    <p class="ad-soft-label">Résumé</p>
                    <h2 class="mt-1 text-xl font-semibold text-slate-950">Interprétation du résultat</h2>
                </div>

                <div class="rounded-2xl border border-slate-200 bg-slate-50/80 p-5 text-sm leading-7 text-slate-700">
                    {{ $summary }}
                </div>
            </section>

            <section class="ad-section pt-6 space-y-3">
                <div>
                    <p class="ad-soft-label">Métadonnées</p>
                    <h2 class="mt-1 text-xl font-semibold text-slate-950">Informations techniques</h2>
                </div>

                <div class="grid gap-3 sm:grid-cols-2 xl:grid-cols-4">
                    <div class="ad-card">
                        <p class="ad-soft-label">Soumis le</p>
                        <p class="mt-2 text-sm font-semibold text-slate-950">{{ optional($metadata['submitted_at'])->format('d/m/Y H:i') ?? '—' }}</p>
                    </div>
                    <div class="ad-card">
                        <p class="ad-soft-label">Créé le</p>
                        <p class="mt-2 text-sm font-semibold text-slate-950">{{ optional($metadata['created_at'])->format('d/m/Y H:i') ?? '—' }}</p>
                    </div>
                    <div class="ad-card">
                        <p class="ad-soft-label">Mis à jour le</p>
                        <p class="mt-2 text-sm font-semibold text-slate-950">{{ optional($metadata['updated_at'])->format('d/m/Y H:i') ?? '—' }}</p>
                    </div>
                    <div class="ad-card">
                        <p class="ad-soft-label">Code de résultat</p>
                        <p class="mt-2 text-sm font-semibold text-slate-950">{{ $metadata['result_code'] }}</p>
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
                const domainCanvas = document.getElementById('domain-chart-{{ $chartIdSuffix }}');

                if (!domainCanvas || typeof Chart === 'undefined') {
                    return;
                }

                new Chart(domainCanvas, {
                    type: 'doughnut',
                    data: {
                        labels: @json($domainLabels),
                        datasets: [{
                            data: @json($domainValues),
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
            })();
        </script>
    @endpush
</x-filament-panels::page>