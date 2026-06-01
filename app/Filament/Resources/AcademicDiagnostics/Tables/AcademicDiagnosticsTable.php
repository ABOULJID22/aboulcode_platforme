<?php

namespace App\Filament\Resources\AcademicDiagnostics\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AcademicDiagnosticsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->searchable(),
                TextColumn::make('macro_cycle')
                    ->searchable(),
                TextColumn::make('academic_level')
                    ->searchable(),
                TextColumn::make('interest_theme')
                    ->badge()
                    ->toggleable(),
                TextColumn::make('track_branch')
                    ->searchable(),
                TextColumn::make('institution_type')
                    ->searchable(),
                TextColumn::make('specialty_family')
                    ->searchable(),
                TextColumn::make('specialty_label')
                    ->searchable(),
                TextColumn::make('biof_language')
                    ->searchable(),
                TextColumn::make('remark')
                    ->limit(40)
                    ->toggleable(),
                TextColumn::make('status')
                    ->badge(),
                TextColumn::make('result_code')
                    ->searchable(),
                TextColumn::make('result_label')
                    ->searchable(),
                TextColumn::make('submitted_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
