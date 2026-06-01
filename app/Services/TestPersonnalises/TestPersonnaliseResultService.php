<?php

namespace App\Services\TestPersonnalises;

use Illuminate\Support\Arr;

class TestPersonnaliseResultService
{
    private const IT_DOMAINS = [
        'development_web' => 'Développement web',
        'data_ia' => 'Data / IA',
        'cybersecurite' => 'Cybersécurité',
        'cloud_infrastructure' => 'Cloud / Infrastructure',
        'ui_ux' => 'UI / UX',
        'qa_test' => 'QA / Test logiciel',
        'mobile' => 'Développement mobile',
        'systemes_reseaux' => 'Systèmes / Réseaux',
    ];

    public function calculate(array $answers): array
    {
        $axisScores = $this->calculateAxisScores($answers);
        $domainScores = $this->calculateDomainScores($answers);
        arsort($domainScores);

        $topDomains = array_slice(array_keys($domainScores), 0, 3);

        return [
            'axis_scores' => $axisScores,
            'domain_scores' => $domainScores,
            'primary_domain' => $topDomains[0] ?? null,
            'secondary_domain' => $topDomains[1] ?? null,
            'result_summary' => $this->buildSummary($axisScores, $domainScores),
            'result_payload' => [
                'top_domains' => $topDomains,
                'top_domain_labels' => array_map(
                    fn (string $key): string => self::IT_DOMAINS[$key] ?? $key,
                    $topDomains,
                ),
                'axis_scores' => $axisScores,
                'domain_scores' => $domainScores,
            ],
        ];
    }

    private function calculateAxisScores(array $answers): array
    {
        $definitions = TestPersonnaliseQuestionnaire::definition();
        $axisScores = [];

        foreach ($definitions['axes'] ?? [] as $axis) {
            $questionIds = array_map(fn (array $question): string => $question['id'], $axis['questions'] ?? []);
            $values = [];

            foreach ($questionIds as $questionId) {
                $value = (int) Arr::get($answers, $questionId, 0);
                if ($value > 0) {
                    $values[] = $value;
                }
            }

            $average = count($values) > 0 ? array_sum($values) / count($values) : 0;
            $axisScores[$axis['key']] = round(($average / 5) * 100, 2);
        }

        return $axisScores;
    }

    private function calculateDomainScores(array $answers): array
    {
        $scores = array_fill_keys(array_keys(self::IT_DOMAINS), 0.0);

        $add = function (array $domains, int $score, float $multiplier = 1.0) use (&$scores): void {
            foreach ($domains as $domain) {
                $scores[$domain] = ($scores[$domain] ?? 0) + ($score * $multiplier);
            }
        };

        foreach ($answers as $questionId => $score) {
            $score = (int) $score;

            match ($questionId) {
                'I1' => $add(['development_web', 'ui_ux', 'mobile'], $score, 2),
                'I2' => $add(['systemes_reseaux', 'cloud_infrastructure', 'cybersecurite'], $score, 2),
                'I3' => $add(['data_ia', 'qa_test', 'development_web'], $score, 2),
                'I4' => $add(['cybersecurite', 'cloud_infrastructure'], $score, 2.2),
                'I5' => $add(['qa_test', 'development_web'], $score, 2.2),
                'I6' => $add(['ui_ux', 'development_web'], $score, 2),
                'A1' => $add(['development_web', 'data_ia', 'qa_test'], $score, 1.6),
                'A2' => $add(['qa_test', 'development_web', 'cybersecurite'], $score, 1.8),
                'A3' => $add(['systemes_reseaux', 'cloud_infrastructure', 'qa_test'], $score, 1.4),
                'A4' => $add(['data_ia', 'development_web'], $score, 1.8),
                'A5' => $add(['systemes_reseaux', 'cloud_infrastructure', 'data_ia'], $score, 1.2),
                'A6' => $add(['data_ia', 'qa_test', 'cloud_infrastructure'], $score, 1.5),
                'P1', 'P3', 'P5' => $add(array_keys(self::IT_DOMAINS), $score, 0.2),
                'P2' => $add(['cybersecurite', 'qa_test', 'development_web'], $score, 0.15),
                'P4', 'P6' => $add(array_keys(self::IT_DOMAINS), $score, 0.18),
                'C1', 'C3', 'C4', 'C5', 'C6' => $add(array_keys(self::IT_DOMAINS), $score, 0.15),
                'L1', 'L2', 'L5', 'L6' => $add(['development_web', 'data_ia', 'qa_test'], $score, 0.12),
                'L3', 'L4' => $add(['data_ia', 'cybersecurite', 'cloud_infrastructure'], $score, 0.12),
                default => null,
            };
        }

        foreach ($scores as $domain => $score) {
            $scores[$domain] = round(min(100, $score), 2);
        }

        return $scores;
    }

    private function buildSummary(array $axisScores, array $domainScores): string
    {
        $topAxis = array_keys($axisScores, max($axisScores), true)[0] ?? null;
        $topDomain = array_keys($domainScores, max($domainScores), true)[0] ?? null;

        $axisLabel = $topAxis ? TestPersonnaliseQuestionnaire::axisLabel($topAxis) : 'profil global';
        $domainLabel = $topDomain ? (self::IT_DOMAINS[$topDomain] ?? $topDomain) : 'IT';

        return "Le profil met surtout en avant {$axisLabel} avec une affinité principale vers {$domainLabel}. Le test reste indicatif et sera fusionné plus tard avec le diagnostic.";
    }
}