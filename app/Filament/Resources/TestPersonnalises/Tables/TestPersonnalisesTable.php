<?php

namespace App\Filament\Resources\TestPersonnalises\Tables;

use App\Filament\Resources\TestPersonnalises\TestPersonnaliseResource;
use App\Models\TestPersonnalise;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TestPersonnalisesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')->label('Utilisateur')->searchable(),
                TextColumn::make('target_level')->label('Niveau cible')->badge(),
                TextColumn::make('primary_domain')->label('Domaine principal')->badge(),
                TextColumn::make('status')->badge(),
                TextColumn::make('submitted_at')->label('Soumis le')->dateTime()->sortable(),
                TextColumn::make('created_at')->toggleable(isToggledHiddenByDefault: true),
            ])
            ->recordActions([
                ViewAction::make()
                    ->url(fn (TestPersonnalise $record): string => TestPersonnaliseResource::getUrl('view', ['record' => $record])),
                EditAction::make()
                    ->url(fn (TestPersonnalise $record): string => TestPersonnaliseResource::getUrl('edit', ['record' => $record])),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}