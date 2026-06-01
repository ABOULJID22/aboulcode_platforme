<?php

namespace App\Services\Orientation;

use App\Models\AcademicDiagnostic;
use App\Models\TestPersonnalise;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AIOrientationService
{
    private AcademicDiagnostic $diagnostic;
    private TestPersonnalise $personality;
    private User $user;
    private string $apiKey;
    private string $apiEndpoint;

    private function __construct(AcademicDiagnostic $diagnostic, TestPersonnalise $personality, User $user)
    {
        $this->diagnostic = $diagnostic;
        $this->personality = $personality;
        $this->user = $user;
        $this->apiKey = config('services.gemini.api_key') ?? env('GEMINI_API_KEY');
        $this->apiEndpoint = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent';
    }

    public function generateFullReport(): array
    {
        try {
            $prompt = $this->buildPrompt();
            $response = $this->callAI($prompt);
            
            return $this->parseAIResponse($response);
        } catch (\Exception $e) {
            Log::error('AI Orientation Report Error: ' . $e->getMessage());
            return $this->getFallbackReport();
        }
    }

    private function buildPrompt(): string
    {
        $studentData = $this->formatStudentData();
        $diagnosticData = $this->formatDiagnosticData();
        $personalityData = $this->formatPersonalityData();

        return <<<PROMPT
Tu es un conseiller d'orientation scolaire expert du système éducatif marocain.

DONNÉES ÉTUDIANT:
{$studentData}

RÉSULTATS TEST DIAGNOSTIQUE:
{$diagnosticData}

RÉSULTATS TEST DE PERSONNALITÉ:
{$personalityData}

TÂCHE: Génère un rapport d'orientation complet basé sur les données ci-dessus.

IMPORTANT: Retourne la réponse UNIQUEMENT en JSON valide, sans aucun texte avant ou après.

Voici la structure JSON exacte requise:
{
  "global_summary": {
    "score": 75,
    "profile": "Scientifique-Technologue",
    "strengths": ["Mathématiques", "Résolution de problèmes", "Informatique"],
    "improvements": ["Communication", "Leadership"],
    "potential": "Excellent potentiel"
  },
  "competences": {
    "math": 80,
    "physics": 75,
    "it": 85,
    "french": 70,
    "english": 72,
    "arabic": 65,
    "communication": 78,
    "problem_solving": 85,
    "creativity": 76,
    "leadership": 68
  },
  "personality": {
    "profile": "Analyste",
    "learning_style": "Apprentissage théorique et analytique",
    "teamwork": "Collaboratif avec leadership naturel",
    "decision_making": "Basée sur l'analyse et la logique",
    "motivations": ["Réussite académique", "Innovation", "Impact technologique"]
  },
  "strengths": {
    "major": ["Mathématiques appliquées", "Programmation logique", "Résolution analytique"],
    "to_develop": ["Communication interpersonnelle", "Gestion du temps"]
  },
  "filieres": [
    {"name": "Informatique", "compatibility": 90},
    {"name": "Sciences Mathématiques", "compatibility": 87},
    {"name": "Technologie", "compatibility": 85}
  ],
  "orientation": [
    {
      "filiere": "Informatique",
      "compatibility": 90,
      "justification": "Excellente correspondance avec compétences IT dominantes"
    },
    {
      "filiere": "Sciences Mathématiques", 
      "compatibility": 87,
      "justification": "Très bon potentiel mathématique"
    },
    {
      "filiere": "Technologie",
      "compatibility": 85,
      "justification": "Application pratique des sciences"
    }
  ],
  "schools": [
    {
      "school": "ENSIAS",
      "domain": "Informatique",
      "access_level": "Excellence",
      "conditions": "Concours très compétitif",
      "strengths": "Leader en informatique"
    },
    {
      "school": "ENSA",
      "domain": "Informatique",
      "access_level": "Très bon",
      "conditions": "Concours d'accès",
      "strengths": "Ingénierie généraliste"
    }
  ],
  "careers": [
    {
      "title": "Ingénieur Logiciel",
      "compatibility": 92,
      "education": "Bac+5",
      "outlook": "Excellent"
    },
    {
      "title": "Data Analyst",
      "compatibility": 88,
      "education": "Bac+5",
      "outlook": "Excellent"
    }
  ],
  "success": {
    "probability": 85,
    "confidence": "Très Élevée",
    "risks": ["Dépassement sans soutien", "Manque de soft skills"],
    "factors": ["Engagement soutenu", "Mentorat régulier"],
    "stars": 5
  },
  "action_plan": {
    "short_term": ["Consolider mathématiques", "Apprendre Python", "Rejoindre club informatique"],
    "medium_term": ["Certifications cloud", "Hackathons", "Projets personnels"],
    "long_term": ["Intégrer école d'ingénierie", "Construire portfolio", "Définir spécialisation"]
  },
  "motivation": {
    "message": "Félicitations pour votre potentiel remarquable! Vos compétences techniques exceptionnelles vous ouvrent des portes infinies..."
  }
}

RÈGLES ESSENTIELLES:
1. Adapte AU SYSTÈME ÉDUCATIF MAROCAIN
2. Utilise des écoles réelles marocaines (ENSIAS, ENSA, EMI, ENCG, ISCAE, etc.)
3. Utilise les 11 filières marocaines
4. Recommande des métiers compatibles avec le marché marocain
5. Ton bienveillant et motivant, JAMAIS décourageant
6. Scores entre 0 et 100
7. Justifications précises et détaillées

RETOUR: JSON UNIQUEMENT, valide et parsable.
PROMPT;
    }

    private function formatStudentData(): string
    {
        $name = $this->user->name ?? 'Non spécifié';
        $level = $this->diagnostic->academic_level ?? 'Non spécifié';
        $age = $this->calculateAge() ?? 'Non spécifié';
        $city = $this->user->city ?? 'Non spécifié';

        return <<<DATA
Nom: {$name}
Niveau: {$level}
Âge: {$age}
Ville: {$city}
DATA;
    }

    private function formatDiagnosticData(): string
    {
        $payload = $this->diagnostic->result_payload ?? [];
        $domains = $payload['orientation_domains'] ?? [];
        $schools = $payload['recommended_schools'] ?? [];
        $code = $this->diagnostic->result_code ?? 'Non spécifié';
        $label = $this->diagnostic->result_label ?? 'Non spécifié';
        $summary = $this->diagnostic->result_summary ?? 'Non disponible';
        $domainsStr = implode(', ', $domains);
        $schoolsStr = implode(', ', $schools);

        return <<<DATA
Code Résultat: {$code}
Libellé: {$label}
Résumé: {$summary}
Domaines d'Orientation: {$domainsStr}
Écoles Recommandées: {$schoolsStr}
DATA;
    }

    private function formatPersonalityData(): string
    {
        $axiScores = $this->personality->axis_scores ?? [];
        $domainScores = $this->personality->domain_scores ?? [];
        $summary = $this->personality->result_summary ?? 'Non disponible';
        $primaryDomain = $this->personality->primary_domain ?? 'Non déterminé';

        $axisFormatted = collect($axiScores)->map(fn ($score, $axis) => "$axis: $score")->join(", ");
        $domainFormatted = collect($domainScores)->map(fn ($score, $domain) => "$domain: $score")->join(", ");

        return <<<DATA
Résumé: {$summary}
Domaine Principal: {$primaryDomain}
Scores Axes: {$axisFormatted}
Scores Domaines: {$domainFormatted}
DATA;
    }

    private function callAI(string $prompt): string
    {
        if (!$this->apiKey) {
            throw new \Exception('Gemini API Key not configured');
        }

        $url = $this->apiEndpoint . '?key=' . $this->apiKey;

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post($url, [
            'contents' => [
                [
                    'parts' => [
                        [
                            'text' => $prompt,
                        ],
                    ],
                ],
            ],
            'generationConfig' => [
                'temperature' => 0.7,
                'maxOutputTokens' => 4000,
            ],
            'safetySettings' => [
                [
                    'category' => 'HARM_CATEGORY_UNSPECIFIED',
                    'threshold' => 'BLOCK_NONE',
                ],
            ],
        ]);

        if ($response->failed()) {
            Log::error('Gemini API Error: ' . $response->status() . ' - ' . $response->body());
            throw new \Exception('API Error: ' . $response->status());
        }

        $data = $response->json();
        
        if (isset($data['candidates'][0]['content']['parts'][0]['text'])) {
            return $data['candidates'][0]['content']['parts'][0]['text'];
        }

        throw new \Exception('Invalid response structure from Gemini API');
    }

    private function parseAIResponse(string $response): array
    {
        // Extraire le JSON de la réponse
        $jsonMatch = preg_match('/\{[\s\S]*\}/', $response, $matches);
        
        if (!$jsonMatch) {
            throw new \Exception('Invalid JSON response from AI');
        }

        $data = json_decode($matches[0], true);

        if (!$data) {
            throw new \Exception('Failed to parse AI response');
        }

        return $this->formatResponse($data);
    }

    private function formatResponse(array $aiData): array
    {
        return [
            'global_summary' => [
                'global_score' => $aiData['global_summary']['score'] ?? 75,
                'dominant_profile' => $aiData['global_summary']['profile'] ?? 'Profil Équilibré',
                'main_strengths' => $aiData['global_summary']['strengths'] ?? [],
                'improvement_axes' => $aiData['global_summary']['improvements'] ?? [],
                'overall_potential' => $aiData['global_summary']['potential'] ?? 'Bon potentiel',
                'summary_text' => $this->buildSummaryText($aiData['global_summary'] ?? []),
            ],
            'competences_analysis' => $this->formatCompetences($aiData['competences'] ?? []),
            'personality_analysis' => [
                'dominant_profile' => $aiData['personality']['profile'] ?? 'Non déterminé',
                'learning_style' => $aiData['personality']['learning_style'] ?? 'Apprentissage équilibré',
                'teamwork_style' => $aiData['personality']['teamwork'] ?? 'Collaboratif',
                'decision_making' => $aiData['personality']['decision_making'] ?? 'Réfléchie',
                'main_motivations' => $aiData['personality']['motivations'] ?? [],
                'axis_scores' => [],
            ],
            'strengths_radar' => [
                'major_strengths' => $aiData['strengths']['major'] ?? [],
                'skills_to_develop' => $aiData['strengths']['to_develop'] ?? [],
                'quick_wins' => $this->generateQuickWins(),
            ],
            'compatibility_filiales' => $this->formatFilieres($aiData['filieres'] ?? []),
            'orientation_recommended' => $this->formatOrientation($aiData['orientation'] ?? []),
            'schools_recommended' => $this->formatSchools($aiData['schools'] ?? []),
            'compatible_careers' => $this->formatCareers($aiData['careers'] ?? []),
            'success_predictions' => [
                'success_probability' => $aiData['success']['probability'] ?? 75,
                'confidence_level' => $aiData['success']['confidence'] ?? 'Élevée',
                'potential_risks' => $aiData['success']['risks'] ?? [],
                'success_factors' => $aiData['success']['factors'] ?? [],
                'star_rating' => $aiData['success']['stars'] ?? 4,
            ],
            'action_plan' => [
                'short_term' => $aiData['action_plan']['short_term'] ?? [],
                'medium_term' => $aiData['action_plan']['medium_term'] ?? [],
                'long_term' => $aiData['action_plan']['long_term'] ?? [],
            ],
            'motivation_message' => $aiData['motivation']['message'] ?? $this->getDefaultMotivation(),
        ];
    }

    private function formatCompetences(array $data): array
    {
        return [
            'mathematics' => $data['math'] ?? 75,
            'physics' => $data['physics'] ?? 72,
            'informatics' => $data['it'] ?? 80,
            'french' => $data['french'] ?? 68,
            'english' => $data['english'] ?? 70,
            'arabic' => $data['arabic'] ?? 65,
            'communication' => $data['communication'] ?? 78,
            'problem_solving' => $data['problem_solving'] ?? 82,
            'creativity' => $data['creativity'] ?? 76,
            'leadership' => $data['leadership'] ?? 71,
        ];
    }

    private function formatFilieres(array $data): array
    {
        return array_map(fn ($item) => [
            'filiere' => $item['name'] ?? 'Non spécifié',
            'compatibility' => (int) ($item['compatibility'] ?? 50),
        ], $data);
    }

    private function formatOrientation(array $data): array
    {
        $orientations = [];
        foreach ($data as $item) {
            $orientations[] = [
                'filiere' => $item['filiere'] ?? 'Non spécifié',
                'compatibility' => (int) ($item['compatibility'] ?? 70),
                'justification' => $item['justification'] ?? 'Recommandé selon le profil.',
            ];
        }
        return array_slice($orientations, 0, 3);
    }

    private function formatSchools(array $data): array
    {
        $grouped = [];
        foreach ($data as $school) {
            $domain = $school['domain'] ?? 'Général';
            if (!isset($grouped[$domain])) {
                $grouped[$domain] = [];
            }
            $grouped[$domain][] = [
                'school' => $school['school'] ?? 'Non spécifié',
                'access_level' => $school['access_level'] ?? 'À déterminer',
                'conditions' => $school['conditions'] ?? 'À vérifier',
                'strengths' => $school['strengths'] ?? 'Établissement réputé',
            ];
        }
        return $grouped;
    }

    private function formatCareers(array $data): array
    {
        return array_map(fn ($career) => [
            'career' => $career['title'] ?? 'Non spécifié',
            'compatibility' => (int) ($career['compatibility'] ?? 50),
            'education_level' => $career['education'] ?? 'Variable',
            'job_outlook' => $career['outlook'] ?? 'Bon',
        ], array_slice($data, 0, 10));
    }

    private function buildSummaryText(array $summary): string
    {
        $profile = $summary['profile'] ?? 'équilibré';
        $level = $this->diagnostic->academic_level ?? 'non spécifié';

        return "L'élève présente un profil {$profile} avec un niveau académique de {$level}. " .
               "Les analyses montrent des aptitudes solides et un potentiel certain pour la réussite.";
    }

    private function generateQuickWins(): array
    {
        return [
            'Approfondir les domaines forts avec des projets personnels',
            'Créer un portfolio de réalisations et projets',
            'Participer aux clubs et activités extrascolaires',
            'Chercher un mentor dans le domaine visé',
            'Suivre des cours en ligne dans les domaines d\'intérêt',
        ];
    }

    private function getDefaultMotivation(): string
    {
        return "Félicitations pour vos efforts ! Ce rapport montre que vous avez un réel potentiel. " .
               "Continuez à croire en vous et à travailler dur. Votre succès est à votre portée. " .
               "N'abandonnez jamais et cherchez toujours à vous améliorer.";
    }

    private function calculateAge(): ?int
    {
        if (!$this->user->birth_date) {
            return null;
        }

        return now()->diffInYears($this->user->birth_date);
    }

    private function getFallbackReport(): array
    {
        // Rapport de secours en cas d'erreur API
        return [
            'global_summary' => [
                'global_score' => 70,
                'dominant_profile' => 'Profil à déterminer',
                'main_strengths' => [],
                'improvement_axes' => [],
                'overall_potential' => 'Bon potentiel',
                'summary_text' => 'Rapport temporairement indisponible. Veuillez réessayer.',
            ],
            'competences_analysis' => [],
            'personality_analysis' => [],
            'strengths_radar' => ['major_strengths' => [], 'skills_to_develop' => []],
            'compatibility_filiales' => [],
            'orientation_recommended' => [],
            'schools_recommended' => [],
            'compatible_careers' => [],
            'success_predictions' => [],
            'action_plan' => [],
            'motivation_message' => 'Le système est actuellement en maintenance. Veuillez réessayer ultérieurement.',
        ];
    }
}
