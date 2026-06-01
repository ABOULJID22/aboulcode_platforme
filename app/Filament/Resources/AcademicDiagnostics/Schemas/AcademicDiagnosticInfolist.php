<?php

namespace App\Filament\Resources\AcademicDiagnostics\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AcademicDiagnosticInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Résultat du diagnostic')
                    ->description('Vue synthétique de votre orientation académique.')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextEntry::make('result_label')
                                    ->label('Orientation détectée')
                                    ->badge()
                                    ->size('lg'),
                                TextEntry::make('result_code')
                                    ->label('Code résultat')
                                    ->badge()
                                    ->color('gray')
                                    ->copyable(),
                                TextEntry::make('status')
                                    ->label('Statut')
                                    ->badge(),
                            ]),
                    ]),

                Section::make('Profil académique')
                    ->description('Les éléments saisis pendant le test.')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('macro_cycle')
                                    ->label('Cycle'),
                                TextEntry::make('academic_level')
                                    ->label('Niveau'),
                                TextEntry::make('interest_theme')
                                    ->label('Centre d’intérêt')
                                    ->badge()
                                    ->placeholder('—'),
                                TextEntry::make('track_branch')
                                    ->label('Branche / orientation')
                                    ->placeholder('—'),
                                TextEntry::make('institution_type')
                                    ->label('Type d’établissement')
                                    ->placeholder('—'),
                                TextEntry::make('specialty_family')
                                    ->label('Famille de spécialité')
                                    ->placeholder('—'),
                                TextEntry::make('specialty_label')
                                    ->label('Spécialité')
                                    ->placeholder('—'),
                                TextEntry::make('biof_language')
                                    ->label('Langue')
                                    ->placeholder('—'),
                                TextEntry::make('remark')
                                    ->label('Remarque')
                                    ->placeholder('—')
                                    ->columnSpanFull(),
                            ]),
                    ]),

                Section::make('Interprétation')
                    ->description('Lecture métier du diagnostic.')
                    ->schema([
                        TextEntry::make('result_summary')
                            ->label('Résumé')
                            ->prose()
                            ->columnSpanFull(),

                        TextEntry::make('orientation_domains')
                            ->label('Domaines recommandés')
                            ->getStateUsing(function ($record): array {
                                return $record->result_payload['orientation_domains'] ?? [];
                            })
                            ->bulleted()
                            ->listWithLineBreaks()
                            ->columnSpanFull(),
                    ]),

                Section::make('Métadonnées')
                    ->schema([
                        Grid::make(3)
                            ->schema([
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
