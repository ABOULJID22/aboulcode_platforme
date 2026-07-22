<?php

namespace App\Filament\Resources\Users\Tables;

use App\Models\User;
use App\Services\Notifications\PlatformNotificationService;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Notifications\Notification;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Filament\Actions\DeleteAction;
use Filament\Tables\Table;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table 
            ->columns([
                ImageColumn::make('avatar_url')
                    ->label(__('users.table.avatar'))
                    ->circular()
                    ->height(40)
                    ->width(40)
                    ->disk('public')
                    ->getStateUsing(function ($record) {
                        $state = $record->avatar_url ?? null;

                        // Fallback to default avatar if empty
                        if (!$state) {
                            return asset('images/avater.png');
                        }

                        // If already a full URL, return as-is
                        if (Str::startsWith($state, ['http://', 'https://'])) {
                            return $state;
                        }

                        // If already a public storage URL (/storage/...), verify existence
                        if (Str::startsWith($state, '/storage/')) {
                            $relative = ltrim(Str::after($state, '/storage/'), '/');
                            return Storage::disk('public')->exists($relative)
                                ? $state
                                : asset('images/avater.png');
                        }

                        // If an absolute local path was stored, convert to storage-relative path
                        if (Str::contains($state, ['storage/app/public', 'storage\\app\\public'])) {
                            $state = 'avatar/' . basename($state);
                        }

                        // Build public URL if file exists, otherwise fallback
                        return Storage::disk('public')->exists($state)
                            ? Storage::disk('public')->url($state)
                            : asset('images/avater.png');
                    }),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('email')
                    ->label(__('users.table.email'))
                    ->searchable(),
                TextColumn::make('role_label')
                    ->label(__('users.table.role'))
                    ->getStateUsing(function ($record) {
                        // Display the user's roles
                        $roleNames = optional($record->roles)->pluck('name')->join(', ');
                        return $roleNames ?: __('users.role.no_role');
                    })
                    ->toggleable()
                    ->searchable(),
                TextColumn::make('phone')
                    ->label(__('users.table.phone'))
                    ->toggleable(),

                TextColumn::make('is_active')
                    ->label('Statut')
                    ->formatStateUsing(fn (bool $state, User $record): string => $state
                        ? 'Actif'
                        : ($record->isTeacher() ? 'En attente' : 'Inactif'))
                    ->badge()
                    ->color(fn (bool $state, User $record): string => $state
                        ? 'success'
                        : ($record->isTeacher() ? 'warning' : 'danger'))
                    ->sortable(),
                
        
                TextColumn::make('last_login_at')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),
                
               
            ])
            ->filters([
                SelectFilter::make('role')
                    ->label('Role')
                    ->options([
                        User::ROLE_SUPER_ADMIN => 'Super admin',
                        User::ROLE_TEACHER => 'Enseignant',
                        User::ROLE_STUDENT => 'Eleve',
                        User::ROLE_USER => 'Utilisateur',
                    ])
                    ->query(fn (Builder $query, array $data): Builder => filled($data['value'] ?? null)
                        ? $query->whereHas('roles', fn (Builder $roleQuery): Builder => $roleQuery->where('name', $data['value']))
                        : $query),

                SelectFilter::make('is_active')
                    ->label('Statut')
                    ->options([
                        '1' => 'Actif',
                        '0' => 'Inactif / en attente',
                    ]),

                Filter::make('pending_teachers')
                    ->label('Enseignants en attente')
                    ->query(fn (Builder $query): Builder => $query
                        ->where('is_active', false)
                        ->whereHas('roles', fn (Builder $roleQuery): Builder => $roleQuery->where('name', User::ROLE_TEACHER))),
            ])
            ->recordActions([
                Action::make('validate_teacher')
                    ->label('Valider')
                    ->icon('heroicon-m-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(fn (User $record): bool => (auth()->user()?->isSuperAdmin() ?? false)
                        && $record->isTeacher()
                        && ! $record->is_active)
                    ->action(function (User $record): void {
                        $record->update(['is_active' => true]);

                        app(PlatformNotificationService::class)->notifyTeacherValidated($record->fresh());

                        Notification::make()
                            ->title('Compte enseignant valide')
                            ->body("{$record->name} peut maintenant se connecter.")
                            ->success()
                            ->send();
                    })
                    ->button(),

                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make()->visible(fn () => auth()->user()?->isSuperAdmin() ?? false),

            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
