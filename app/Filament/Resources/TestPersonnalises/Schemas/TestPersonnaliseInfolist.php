<?php

namespace App\Filament\Resources\TestPersonnalises\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TestPersonnaliseInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Résultat personnalisé')
                    ->description('Lecture rapide du test et de la piste principale.')
                    ->schema([
                        Grid::make(3)->schema([
                            TextEntry::make('target_level')
                                ->label('Niveau cible')
                                ->badge()
                                ->placeholder('—'),
                            TextEntry::make('primary_domain')
                                ->label('Domaine principal')
                                ->badge()
                                ->placeholder('—'),
                            TextEntry::make('status')
                                ->label('Statut')
                                ->badge()
                                ->placeholder('—'),
                        ]),
                    ]),
                Section::make('Scores mis en avant')
                    ->description('Les axes et domaines les plus pertinents sont regroupés pour une lecture plus claire.')
                    ->schema([
                        Grid::make(2)->schema([
                            TextEntry::make('axis_scores_summary')
                                ->label('Scores par axe')
                                ->getStateUsing(function ($record): string {
                                    return collect($record->axis_scores ?? [])
                                        ->sortDesc()
                                        ->take(5)
                                        ->map(fn ($score, $axis): string => sprintf('%s: %s%%', $axis, $score))
                                        ->implode(' • ');
                                })
                                ->placeholder('—')
                                ->columnSpanFull(),
                            TextEntry::make('domain_scores_summary')
                                ->label('Scores IT')
                                ->getStateUsing(function ($record): string {
                                    return collect($record->domain_scores ?? [])
                                        ->sortDesc()
                                        ->take(8)
                                        ->map(fn ($score, $domain): string => sprintf('%s: %s%%', $domain, $score))
                                        ->implode(' • ');
                                })
                                ->placeholder('—')
                                ->columnSpanFull(),
                        ]),
                    ]),
                Section::make('Résumé d\'orientation')
                    ->schema([
                        TextEntry::make('result_summary')
                            ->label('Résumé')
                            ->prose()
                            ->columnSpanFull()
                            ->placeholder('—'),
                    ]),
                Section::make('Métadonnées')
                    ->schema([
                        Grid::make(3)->schema([
                            TextEntry::make('submitted_at')
                                ->label('Soumis le')
                                ->dateTime()
                                ->placeholder('—'),
                            TextEntry::make('created_at')
                                ->label('Créé le')
                                ->dateTime()
                                ->placeholder('—'),
                            TextEntry::make('updated_at')
                                ->label('Mis à jour le')
                                ->dateTime()
                                ->placeholder('—'),
                        ]),
                    ])
                    ->collapsed(),
            ]);
    }
}
