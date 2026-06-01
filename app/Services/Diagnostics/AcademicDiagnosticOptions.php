<?php

namespace App\Services\Diagnostics;

use App\Enums\AcademicLevelEnum;
use App\Enums\InstitutionTypeEnum;
use App\Enums\MacroCycleEnum;
use App\Enums\SpecialtyFamilyEnum;
use App\Enums\TrackBranchEnum;

class AcademicDiagnosticOptions
{
    public static function macroCycles(): array
    {
        return collect(MacroCycleEnum::cases())
            ->mapWithKeys(fn ($case) => [$case->value => $case->label()])
            ->toArray();
    }

    public static function levelsByCycle(?string $cycle): array
    {
        return match (true) {
            self::isCollegeCycle($cycle) => self::options([
                AcademicLevelEnum::COLLEGE_ONE,
                AcademicLevelEnum::COLLEGE_TWO,
                AcademicLevelEnum::COLLEGE_THREE,
            ]),
            self::isBacCycle($cycle) => self::options([
                AcademicLevelEnum::SCIENCES_MATHS,
                AcademicLevelEnum::SCIENCES_PHYSICS,
                AcademicLevelEnum::SCIENCES_LIFE,
                AcademicLevelEnum::LETTERS_ARABIC,
                AcademicLevelEnum::LETTERS_FRENCH,
                AcademicLevelEnum::LETTERS_ENGLISH,
                AcademicLevelEnum::LETTERS_PHILOSOPHY,
                AcademicLevelEnum::ECONOMICS,
                AcademicLevelEnum::TECHNICAL,
            ]),
            self::isHigherCycle($cycle) => self::options([
                AcademicLevelEnum::BAC_PLUS_ONE,
                AcademicLevelEnum::BAC_PLUS_TWO,
                AcademicLevelEnum::BAC_PLUS_THREE,
                AcademicLevelEnum::HIGHER,
            ]),
            default => collect(AcademicLevelEnum::cases())
                ->mapWithKeys(fn ($case) => [$case->value => $case->label()])
                ->toArray(),
        };
    }

    public static function branchesByCycleOrLevel(?string $cycle, ?string $level): array
    {
        if (self::isCollegeCycle($cycle)) {
            return self::options([
                TrackBranchEnum::GENERAL,
                TrackBranchEnum::SCIENTIFIC,
                TrackBranchEnum::LITERARY,
                TrackBranchEnum::ECONOMIC,
                TrackBranchEnum::TECHNICAL,
            ]);
        }

        if (self::isBacCycle($cycle)) {
            return self::options([
                TrackBranchEnum::ENGINEERING,
                TrackBranchEnum::MEDICINE,
                TrackBranchEnum::LAW,
                TrackBranchEnum::BUSINESS,
                TrackBranchEnum::AGRICULTURE,
                TrackBranchEnum::EDUCATION,
                TrackBranchEnum::ARTS,
                TrackBranchEnum::TECHNOLOGY,
            ]);
        }

        if (self::isHigherCycle($cycle) || str_contains((string) $level, 'BAC+')) {
            return self::options([
                TrackBranchEnum::ENGINEERING,
                TrackBranchEnum::MEDICINE,
                TrackBranchEnum::BUSINESS,
                TrackBranchEnum::LAW,
                TrackBranchEnum::TECHNOLOGY,
            ]);
        }

        return collect(TrackBranchEnum::cases())
            ->mapWithKeys(fn ($case) => [$case->value => $case->label()])
            ->toArray();
    }

    public static function institutionTypesByCycle(?string $cycle): array
    {
        return collect(InstitutionTypeEnum::cases())
            ->mapWithKeys(fn ($case) => [$case->value => $case->label()])
            ->toArray();
    }

    public static function specialtyFamilies(): array
    {
        return collect(SpecialtyFamilyEnum::cases())
            ->mapWithKeys(fn ($case) => [$case->value => $case->label()])
            ->toArray();
    }

    public static function interestThemes(): array
    {
        return [
            'medicine' => 'Médecine / Santé',
            'ai' => 'IA / Data / Informatique',
            'engineering' => 'Ingénierie / Technologie',
            'business' => 'Business / Commerce / Gestion',
            'law' => 'Droit / Administration',
            'education' => 'Éducation / Pédagogie',
            'arts' => 'Arts / Création / Design',
            'agriculture' => 'Agriculture / Environnement',
        ];
    }

    public static function biofLanguages(): array
    {
        return [
            'FR' => 'Français',
            'AR' => 'Arabe',
            'EN' => 'Anglais',
        ];
    }

    private static function isCollegeCycle(?string $cycle): bool
    {
        return is_string($cycle) && str_contains($cycle, 'collège');
    }

    private static function isBacCycle(?string $cycle): bool
    {
        return is_string($cycle) && str_contains($cycle, 'Bac');
    }

    private static function isHigherCycle(?string $cycle): bool
    {
        return is_string($cycle) && (str_contains($cycle, 'BAC+') || str_contains($cycle, 'Supérieur'));
    }

    /**
     * @param array<int, AcademicLevelEnum|TrackBranchEnum> $cases
     */
    private static function options(array $cases): array
    {
        return collect($cases)
            ->mapWithKeys(fn ($case) => [$case->value => $case->label()])
            ->toArray();
    }
}
