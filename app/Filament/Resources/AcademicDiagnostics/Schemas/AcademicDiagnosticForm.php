<?php

namespace App\Filament\Resources\AcademicDiagnostics\Schemas;

use App\Services\Diagnostics\AcademicDiagnosticOptions;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Schema;

class AcademicDiagnosticForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Wizard::make([
                    Step::make('Cycle et niveau')
                        ->description('Commencez par identifier le parcours scolaire.')
                        ->schema([
                            Select::make('macro_cycle')
                                ->label('Cycle académique')
                                ->options(AcademicDiagnosticOptions::macroCycles())
                                ->required()
                                ->live()
                                ->afterStateUpdated(function (Set $set): void {
                                    $set('academic_level', null);
                                    $set('track_branch', null);
                                    $set('institution_type', null);
                                }),
                            Select::make('academic_level')
                                ->label('Niveau académique')
                                ->options(fn (Get $get): array => AcademicDiagnosticOptions::levelsByCycle($get('macro_cycle')))
                                ->required()
                                ->live(),
                        ]),
                    Step::make('Intérêt principal')
                        ->description('Choisissez ce qui attire le plus l’élève.')
                        ->schema([
                            Select::make('interest_theme')
                                ->label('Centre d’intérêt')
                                ->options(AcademicDiagnosticOptions::interestThemes())
                                ->required(),
                            TextInput::make('remark')
                                ->label('Remarque libre')
                                ->placeholder('Exemple : je veux aller en médecine avec IA')
                                ->maxLength(500)
                                ->columnSpanFull(),
                        ]),
                    Step::make('Contexte complémentaire')
                        ->description('Ces champs restent utiles pour affiner la recommandation.')
                        ->schema([
                            Select::make('track_branch')
                                ->label('Branche / orientation')
                                ->options(fn (Get $get): array => AcademicDiagnosticOptions::branchesByCycleOrLevel($get('macro_cycle'), $get('academic_level')))
                                ->searchable(),
                            Select::make('institution_type')
                                ->label('Type d’établissement')
                                ->options(fn (Get $get): array => AcademicDiagnosticOptions::institutionTypesByCycle($get('macro_cycle')))
                                ->searchable(),
                            Select::make('specialty_family')
                                ->label('Famille de spécialité')
                                ->options(AcademicDiagnosticOptions::specialtyFamilies())
                                ->searchable(),
                        ]),
                    Step::make('Détails complémentaires')
                        ->description('Complétez les informations utiles au calcul du résultat.')
                        ->schema([
                            TextInput::make('specialty_label')
                                ->label('Intitulé de spécialité')
                                ->maxLength(255),
                            Select::make('biof_language')
                                ->label('Langue d’enseignement')
                                ->options(AcademicDiagnosticOptions::biofLanguages())
                                ->required(),
                        ]),
                ])
                    ->startOnStep(1)
                    ->persistStepInQueryString(),
            ]);
    }
}
