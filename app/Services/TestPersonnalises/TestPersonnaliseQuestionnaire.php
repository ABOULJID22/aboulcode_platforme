<?php

namespace App\Services\TestPersonnalises;

use Illuminate\Support\Facades\File;

class TestPersonnaliseQuestionnaire
{
    private const QUESTION_FILE = 'resources/question/test_personnalise_questions.json';

    public static function definition(): array
    {
        $path = base_path(self::QUESTION_FILE);

        return json_decode(File::get($path), true, 512, JSON_THROW_ON_ERROR);
    }

    public static function targetLevels(): array
    {
        return collect(self::definition()['target_levels'] ?? [])
            ->mapWithKeys(fn (string $level): array => [$level => $level])
            ->toArray();
    }

    public static function responseScale(): array
    {
        return collect(self::definition()['response_scale'] ?? [])
            ->mapWithKeys(fn (array $item): array => [$item['score'] => $item['label']])
            ->toArray();
    }

    public static function axes(): array
    {
        return self::definition()['axes'] ?? [];
    }

    public static function axisLabel(string $axisKey): ?string
    {
        foreach (self::axes() as $axis) {
            if (($axis['key'] ?? null) === $axisKey) {
                return $axis['label'] ?? null;
            }
        }

        return null;
    }

    public static function questionMap(): array
    {
        $map = [];

        foreach (self::axes() as $axis) {
            foreach ($axis['questions'] ?? [] as $question) {
                $map[$question['id']] = [
                    'axis' => $axis['key'],
                    'axis_label' => $axis['label'],
                    'text' => $question['text'],
                ];
            }
        }

        return $map;
    }
}