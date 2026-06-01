<?php

namespace App\Filament\Resources\TestPersonnalises\Schemas;

use App\Services\TestPersonnalises\TestPersonnaliseQuestionnaire;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Schema;

class TestPersonnaliseForm
{
    public static function configure(Schema $schema): Schema
    {
        $responseScale = TestPersonnaliseQuestionnaire::responseScale();

        $steps = [
            Step::make('À propos de ce test')
                ->description('Comprenez l’objectif avant de commencer.')
                ->schema([
                    Section::make('À propos de ce test')
                        ->schema([
                            Placeholder::make('about_test_message')
                                ->content('Ce test d\'orientation est basé sur des méthodes psychométriques reconnues. Il vous aidera à découvrir votre profil unique et à identifier les formations et métiers qui correspondent le mieux à vos intérêts, aptitudes et personnalité. Prenez votre temps pour répondre honnêtement à chaque question.'),
                        ]),
                ]),
            Step::make('Contexte')
                ->description('Choisissez le niveau cible du test.')
                ->schema([
                    Select::make('target_level')
                        ->label('Niveau cible')
                        ->options(TestPersonnaliseQuestionnaire::targetLevels())
                        ->required(),
                    TextInput::make('test_name')
                        ->label('Nom du test')
                        ->default('TestPersonnalise')
                        ->required(),
                    TextInput::make('version')
                        ->label('Version')
                        ->default('1.0')
                        ->required(),
                ]),
        ];

        foreach (TestPersonnaliseQuestionnaire::axes() as $axis) {
            $questions = [];

            foreach ($axis['questions'] ?? [] as $question) {
                $questions[] = Radio::make('answers.' . $question['id'])
                    ->label($question['text'])
                    ->options($responseScale)
                    ->required()
                    ->inline(false);
            }

            $steps[] = Step::make($axis['label'])
                ->description('Temps estimé: ' . ($axis['time_minutes'] ?? 0) . ' min')
                ->schema([
                    Section::make($axis['label'])
                        ->schema([
                            Placeholder::make('axis_note_' . $axis['key'])
                                ->content('Répondez selon ce qui vous ressemble vraiment. Aucun axe ne décide seul de l’orientation finale.'),
                            Grid::make(1)->schema($questions),
                        ]),
                ]);
        }

        $steps[] = Step::make('Résumé')
            ->description('Vérifiez les informations avant l’envoi.')
            ->schema([
                Placeholder::make('summary_hint')
                    ->content('Le résultat produira des scores par axe et par domaine IT, puis sera fusionné plus tard avec le test diagnostique.'),
            ]);

        return $schema
            ->columns(1)
            ->components([
                Wizard::make($steps)
                    ->startOnStep(1)
                    ->persistStepInQueryString(),
            ]);
    }
}