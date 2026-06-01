<?php

namespace App\Services\Orientation;

use App\Models\AcademicDiagnostic;
use App\Models\TestPersonnalise;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;

class OrientationCompleteResultService
{
    public function buildCached(AcademicDiagnostic $diagnostic, TestPersonnalise $personnalise): array
    {
        $cacheKey = $this->cacheKey($diagnostic, $personnalise);

        return Cache::remember($cacheKey, now()->addHours(6), function () use ($diagnostic, $personnalise) {
            return $this->build($diagnostic, $personnalise);
        });
    }

    public function forgetCached(AcademicDiagnostic $diagnostic, TestPersonnalise $personnalise): void
    {
        Cache::forget($this->cacheKey($diagnostic, $personnalise));
    }

    public function build(AcademicDiagnostic $diagnostic, TestPersonnalise $personnalise): array
    {
        $catalog = $this->loadDomainCatalog();
        $topTracks = $this->resolveTopTracks($catalog, $personnalise);

        $base = [
            'diagnostic' => [
                'label' => $diagnostic->result_label,
                'summary' => $diagnostic->result_summary,
                'domains' => $diagnostic->result_payload['orientation_domains'] ?? [],
            ],
            'personnalise' => [
                'axis_scores' => $personnalise->axis_scores ?? [],
                'domain_scores' => $personnalise->domain_scores ?? [],
                'primary_domain' => $personnalise->primary_domain,
                'secondary_domain' => $personnalise->secondary_domain,
            ],
            'top_tracks' => $topTracks,
        ];

        [$narrative, $narrativeSource, $aiMessage, $aiRecommendations] = $this->generateNarrative($base);

        $base['narrative'] = $narrative;
        $base['narrative_source'] = $narrativeSource;
        $base['ai_recommendations'] = $aiRecommendations;
        $base['ai_status'] = [
            'enabled' => $narrativeSource === 'ai',
            'message' => $aiMessage,
        ];

        return $base;
    }

    private function cacheKey(AcademicDiagnostic $diagnostic, TestPersonnalise $personnalise): string
    {
        return 'orientation_complete_result:' . $diagnostic->id . ':' . $diagnostic->updated_at?->timestamp . ':' . $personnalise->id . ':' . $personnalise->updated_at?->timestamp;
    }

    private function loadDomainCatalog(): array
    {
        $path = base_path('resources/domainesIT/domaines_informatique.json');

        if (! File::exists($path)) {
            return ['categories' => []];
        }

        return json_decode(File::get($path), true) ?: ['categories' => []];
    }

    private function resolveTopTracks(array $catalog, TestPersonnalise $personnalise): array
    {
        $domainScores = $personnalise->domain_scores ?? [];
        arsort($domainScores);

        $topKeys = array_slice(array_keys($domainScores), 0, 3);
        $matchedCategories = [];

        foreach ($topKeys as $key) {
            $category = $this->findCategoryByScoreKey($catalog['categories'] ?? [], $key);

            if (! $category) {
                continue;
            }

            $matchedCategories[] = [
                'score_key' => $key,
                'category' => $category['nom'] ?? 'Catégorie IT',
                'top_domaines' => array_slice($category['domaines'] ?? [], 0, 3),
            ];
        }

        return $matchedCategories;
    }

    private function findCategoryByScoreKey(array $categories, string $scoreKey): ?array
    {
        $map = [
            'development_web' => ['Développement Logiciel & Web', 'Langages & Paradigmes de Programmation'],
            'data_ia' => ['Intelligence Artificielle', 'Data & Big Data'],
            'cybersecurite' => ['Cybersécurité'],
            'cloud_infrastructure' => ['Cloud Computing', 'Systèmes & Administration'],
            'ui_ux' => ['UX/UI & Design Numérique'],
            'qa_test' => ['QA & Testing'],
            'mobile' => ['Développement Logiciel & Web'],
            'systemes_reseaux' => ['Réseaux & Télécommunications', 'Systèmes & Administration'],
        ];

        $targets = $map[$scoreKey] ?? [];

        foreach ($targets as $target) {
            foreach ($categories as $category) {
                if (($category['nom'] ?? null) === $target) {
                    return $category;
                }
            }
        }

        return null;
    }

    private function generateNarrative(array $base): array
    {
        $prompt = $this->buildPrompt($base);

        [$aiRecommendations, $aiMessage] = $this->tryGenerateNarrativeWithAi($prompt);
        $aiNarrative = is_array($aiRecommendations) ? ($aiRecommendations['summary'] ?? null) : null;

        if ($aiNarrative !== null && trim($aiNarrative) !== '') {
            return [$aiNarrative, 'ai', $aiMessage, $aiRecommendations];
        }

        $fallbackRecommendations = $this->buildFallbackRecommendations($base);
        $fallbackSummary = $fallbackRecommendations['summary'] ?? 'Votre profil présente des pistes numériques cohérentes avec vos résultats.';

        return [$fallbackSummary, 'fallback', $aiMessage, $fallbackRecommendations];
    }

    private function buildPrompt(array $base): string
    {
        return "Tu es un conseiller d'orientation spécialisé au Maroc pour les parcours IT et numériques. "
            . "Analyse la fusion de deux tests d'orientation et réponds STRICTEMENT en JSON valide sans texte hors JSON. "
            . "Le JSON doit respecter exactement cette structure: "
            . '{"summary":"...","recommended_schools":[{"name":"...","city":"...","why_fit":"...","admission_path":"..."}],'
            . '"program_choices":[{"title":"...","fit_percent":0,"morocco_demand_percent":0,"importance":"élevée|moyenne|faible","notes":"..."}],'
            . '"job_roles":[{"title":"...","fit_percent":0,"morocco_demand_percent":0,"importance":"élevée|moyenne|faible","skills":["..."],"salary_range_mad_month":"..."}],'
            . '"market_insights":["..."],"next_actions":["..."]}'
            . "Contraintes: fit_percent et morocco_demand_percent sont des entiers 0..100, "
            . "minimum 4 écoles au Maroc, minimum 4 choix de filières, minimum 4 métiers. "
            . "Contexte JSON: " . json_encode($base, JSON_UNESCAPED_UNICODE);
    }

    private function tryGenerateNarrativeWithAi(string $prompt): array
    {
        try {
            $apiKey = config('services.gemini.api_key');

            if (! is_string($apiKey) || trim($apiKey) === '') {
                return [null, 'Clé Gemini absente dans la configuration.'];
            }

            $primaryModel = $this->normalizeModelName((string) config('services.gemini.model', 'gemini-1.5-flash'));
            $fallbackModels = config('services.gemini.fallback_models', ['gemini-1.5-flash']);
            $retryableStatuses = [429, 500, 502, 503, 504];
            $maxAttempts = max(1, (int) config('services.gemini.max_attempts', 3));
            $retryDelayMs = max(0, (int) config('services.gemini.retry_delay_ms', 700));

            $modelsToTry = [$primaryModel];

            if (is_array($fallbackModels)) {
                foreach ($fallbackModels as $fallbackModel) {
                    $normalized = $this->normalizeModelName((string) $fallbackModel);

                    if ($normalized !== '' && ! in_array($normalized, $modelsToTry, true)) {
                        $modelsToTry[] = $normalized;
                    }
                }
            }

            $lastErrorMessage = 'Aucune réponse exploitable retournée par Gemini.';

            foreach ($modelsToTry as $model) {
                $endpoint = sprintf(
                    'https://generativelanguage.googleapis.com/v1beta/models/%s:generateContent',
                    $model
                );

                for ($attempt = 1; $attempt <= $maxAttempts; $attempt++) {
                    $response = Http::timeout(30)
                        ->acceptJson()
                        ->asJson()
                        ->withQueryParameters(['key' => $apiKey])
                        ->post($endpoint, [
                            'contents' => [[
                                'role' => 'user',
                                'parts' => [[
                                    'text' => $prompt,
                                ]],
                            ]],
                            'generationConfig' => [
                                'temperature' => 0.7,
                                'topP' => 0.9,
                                'maxOutputTokens' => 700,
                            ],
                        ]);

                    if ($response->successful()) {
                        $text = data_get($response->json(), 'candidates.0.content.parts.0.text');

                        if (is_string($text) && trim($text) !== '') {
                            $parsed = $this->extractJsonPayload($text);

                            if (is_array($parsed)) {
                                return [$parsed, 'Analyse détaillée générée via Gemini (' . $model . ').'];
                            }

                            return [[
                                'summary' => trim($text),
                                'recommended_schools' => [],
                                'program_choices' => [],
                                'job_roles' => [],
                                'market_insights' => [],
                                'next_actions' => [],
                            ], 'Gemini a répondu en texte libre (' . $model . ').'];
                        }

                        $finishReason = data_get($response->json(), 'candidates.0.finishReason');

                        if (is_string($finishReason) && trim($finishReason) !== '') {
                            $lastErrorMessage = 'Gemini a répondu sans contenu exploitable (' . $finishReason . ') avec le modèle ' . $model . '.';
                        }

                        break;
                    }

                    $status = $response->status();
                    $errorMessage = data_get($response->json(), 'error.message');
                    $apiMessage = is_string($errorMessage) && trim($errorMessage) !== ''
                        ? ' Détail: ' . trim($errorMessage)
                        : '';

                    $lastErrorMessage = 'Gemini a répondu avec un statut HTTP ' . $status
                        . ' (modèle: ' . $model . ', tentative ' . $attempt . '/' . $maxAttempts . ').'
                        . $apiMessage;

                    $isRetryable = in_array($status, $retryableStatuses, true);

                    if (! $isRetryable || $attempt >= $maxAttempts) {
                        break;
                    }

                    if ($retryDelayMs > 0) {
                        usleep($retryDelayMs * 1000);
                    }
                }
            }

            return [null, $lastErrorMessage];
        } catch (\Throwable $exception) {
            return [null, 'Echec de generation Gemini: ' . $exception->getMessage()];
        }

        return [null, 'Aucune réponse exploitable retournée par Gemini.'];
    }

    private function extractJsonPayload(string $text): ?array
    {
        $cleaned = trim($text);

        if (preg_match('/```(?:json)?\s*(\{.*\})\s*```/is', $cleaned, $matches)) {
            $cleaned = trim($matches[1]);
        }

        $decoded = json_decode($cleaned, true);

        if (is_array($decoded)) {
            return $decoded;
        }

        $firstBrace = strpos($cleaned, '{');
        $lastBrace = strrpos($cleaned, '}');

        if ($firstBrace === false || $lastBrace === false || $lastBrace <= $firstBrace) {
            return null;
        }

        $jsonSlice = substr($cleaned, $firstBrace, $lastBrace - $firstBrace + 1);
        $decodedSlice = json_decode($jsonSlice, true);

        return is_array($decodedSlice) ? $decodedSlice : null;
    }

    private function buildFallbackRecommendations(array $base): array
    {
        $diagnostic = $base['diagnostic']['label'] ?? 'Orientation générale';
        $primary = $base['personnalise']['primary_domain'] ?? 'profil IT global';
        $secondary = $base['personnalise']['secondary_domain'] ?? 'piste complémentaire';

        $domainScores = $base['personnalise']['domain_scores'] ?? [];
        $topScoreKey = $base['top_tracks'][0]['score_key'] ?? null;
        $secondScoreKey = $base['top_tracks'][1]['score_key'] ?? null;

        $fitTop = $this->resolveFitPercent($domainScores, $topScoreKey, 78);
        $fitSecond = $this->resolveFitPercent($domainScores, $secondScoreKey, 72);

        $demandMap = [
            'development_web' => 78,
            'data_ia' => 88,
            'cybersecurite' => 84,
            'cloud_infrastructure' => 82,
            'ui_ux' => 68,
            'qa_test' => 70,
            'mobile' => 72,
            'systemes_reseaux' => 74,
        ];

        $topDemand = $demandMap[$topScoreKey] ?? 75;
        $secondDemand = $demandMap[$secondScoreKey] ?? 70;

        return [
            'summary' => "Votre profil combine {$diagnostic} avec une dominante {$primary}. "
                . "La piste secondaire {$secondary} confirme une cohérence de parcours. "
                . "Les recommandations ci-dessous donnent des écoles, filières et métiers à prioriser au Maroc.",
            'recommended_schools' => [
                [
                    'name' => 'ENSA (réseau national)',
                    'city' => 'Plusieurs villes',
                    'why_fit' => 'Bonne base ingénierie pour les parcours logiciels, data et systèmes.',
                    'admission_path' => 'Après bac scientifique via concours commun.',
                ],
                [
                    'name' => 'ENSIAS',
                    'city' => 'Rabat',
                    'why_fit' => 'Spécialisations solides en informatique, cybersécurité et data.',
                    'admission_path' => 'Concours passerelle (Bac+2) ou voies internes.',
                ],
                [
                    'name' => 'INPT',
                    'city' => 'Rabat',
                    'why_fit' => 'Fort positionnement en réseaux, cloud, sécurité et télécom.',
                    'admission_path' => 'Concours national après classes préparatoires ou équivalent.',
                ],
                [
                    'name' => 'EMI',
                    'city' => 'Rabat',
                    'why_fit' => 'Parcours ingénieur polyvalent avec débouchés numériques.',
                    'admission_path' => 'Concours national après classes préparatoires.',
                ],
                [
                    'name' => 'UM6P School of Computer Science',
                    'city' => 'Benguerir',
                    'why_fit' => 'Approche orientée innovation, IA et projets appliqués.',
                    'admission_path' => 'Sélection sur dossier et processus d’admission propre.',
                ],
            ],
            'program_choices' => [
                [
                    'title' => 'Ingénierie logicielle & web',
                    'fit_percent' => $fitTop,
                    'morocco_demand_percent' => $topDemand,
                    'importance' => $this->resolveImportance($fitTop, $topDemand),
                    'notes' => 'Parcours adaptable vers backend, frontend et architecture applicative.',
                ],
                [
                    'title' => 'Data, IA et analytique',
                    'fit_percent' => max($fitSecond, 70),
                    'morocco_demand_percent' => 88,
                    'importance' => $this->resolveImportance(max($fitSecond, 70), 88),
                    'notes' => 'Fort potentiel dans les secteurs finance, retail, industrie et services.',
                ],
                [
                    'title' => 'Cybersécurité & gouvernance SI',
                    'fit_percent' => max($fitSecond - 2, 68),
                    'morocco_demand_percent' => 84,
                    'importance' => $this->resolveImportance(max($fitSecond - 2, 68), 84),
                    'notes' => 'Demande régulière sur audit, SOC, conformité et sécurité applicative.',
                ],
                [
                    'title' => 'Cloud, DevOps & infrastructure',
                    'fit_percent' => max($fitSecond - 4, 66),
                    'morocco_demand_percent' => 82,
                    'importance' => $this->resolveImportance(max($fitSecond - 4, 66), 82),
                    'notes' => 'Compétences recherchées pour la transformation cloud des entreprises.',
                ],
            ],
            'job_roles' => [
                [
                    'title' => 'Développeur Full-Stack',
                    'fit_percent' => max($fitTop, 74),
                    'morocco_demand_percent' => 80,
                    'importance' => $this->resolveImportance(max($fitTop, 74), 80),
                    'skills' => ['PHP/Laravel', 'JavaScript/TypeScript', 'SQL', 'Git'],
                    'salary_range_mad_month' => '7000 - 16000 MAD (junior à intermédiaire)',
                ],
                [
                    'title' => 'Data Analyst / Junior Data Scientist',
                    'fit_percent' => max($fitSecond, 70),
                    'morocco_demand_percent' => 86,
                    'importance' => $this->resolveImportance(max($fitSecond, 70), 86),
                    'skills' => ['Python', 'SQL', 'Power BI/Tableau', 'Statistiques'],
                    'salary_range_mad_month' => '8000 - 18000 MAD',
                ],
                [
                    'title' => 'Ingénieur Sécurité Junior',
                    'fit_percent' => max($fitSecond - 3, 67),
                    'morocco_demand_percent' => 84,
                    'importance' => $this->resolveImportance(max($fitSecond - 3, 67), 84),
                    'skills' => ['Réseaux', 'SIEM', 'OWASP', 'Gestion des risques'],
                    'salary_range_mad_month' => '9000 - 20000 MAD',
                ],
                [
                    'title' => 'Ingénieur Cloud / DevOps Junior',
                    'fit_percent' => max($fitSecond - 4, 66),
                    'morocco_demand_percent' => 82,
                    'importance' => $this->resolveImportance(max($fitSecond - 4, 66), 82),
                    'skills' => ['Linux', 'Docker', 'CI/CD', 'AWS/Azure/GCP'],
                    'salary_range_mad_month' => '9000 - 19000 MAD',
                ],
            ],
            'market_insights' => [
                'Le marché marocain reste dynamique sur software, data, cybersécurité et cloud.',
                'Les profils combinant technique + communication projet sont les plus valorisés.',
                'Les stages et projets concrets augmentent fortement l’employabilité en sortie.',
            ],
            'next_actions' => [
                'Choisir 2 filières principales et 1 filière de secours selon vos scores.',
                'Préparer un plan de candidatures écoles (dossier, concours, calendrier).',
                'Construire 2 projets portfolio alignés avec votre piste principale.',
                'Passer une certification courte (cloud, data ou sécurité) avant la prochaine rentrée.',
            ],
        ];
    }

    private function resolveFitPercent(array $domainScores, ?string $scoreKey, int $default): int
    {
        if ($scoreKey === null || ! isset($domainScores[$scoreKey])) {
            return $default;
        }

        $value = (float) $domainScores[$scoreKey];

        if ($value <= 1.0) {
            $value *= 100;
        }

        return (int) max(0, min(100, round($value)));
    }

    private function resolveImportance(int $fitPercent, int $demandPercent): string
    {
        $score = ($fitPercent + $demandPercent) / 2;

        if ($score >= 78) {
            return 'élevée';
        }

        if ($score >= 62) {
            return 'moyenne';
        }

        return 'faible';
    }

    private function normalizeModelName(string $model): string
    {
        $normalized = trim($model);
        $normalized = preg_replace('/^models\//i', '', $normalized) ?: $normalized;
        $normalized = strtolower($normalized);

        if ($normalized === '') {
            return 'gemini-1.5-flash';
        }

        return $normalized;
    }
}