<?php

namespace App\Filament\Pages;

use App\Filament\Resources\Posts\PostResource;
use App\Filament\Resources\Users\UserResource;
use App\Models\Post;
use App\Models\User;
use App\Services\Notifications\PlatformNotificationService;
use BackedEnum;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use UnitEnum;

class PendingValidations extends Page
{
    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-clipboard-document-check';

    protected static ?string $navigationLabel = 'Validations en attente';

    protected static ?string $title = 'Validations en attente';

    protected static ?string $slug = 'validations-en-attente';

    protected static ?int $navigationSort = 5;

    protected static UnitEnum|string|null $navigationGroup = null;

    protected string $view = 'filament.pages.pending-validations';

    public static function getNavigationGroup(): UnitEnum|string|null
    {
        return __('filament.nav.groups.administration');
    }

    public static function canAccess(): bool
    {
        return (bool) auth()->user()?->isSuperAdmin();
    }

    public static function shouldRegisterNavigation(): bool
    {
        return static::canAccess();
    }

    public static function getNavigationBadge(): ?string
    {
        $count = static::pendingCount();

        return $count > 0 ? (string) $count : null;
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return static::pendingCount() > 0 ? 'warning' : null;
    }

    public static function pendingCount(): int
    {
        return static::pendingTeachersQuery()->count()
            + static::pendingPostsQuery()->count();
    }

    public function pendingTeachers(): Collection
    {
        return static::pendingTeachersQuery()
            ->latest()
            ->limit(12)
            ->get();
    }

    public function pendingTeachersCount(): int
    {
        return static::pendingTeachersQuery()->count();
    }

    public function pendingPosts(): Collection
    {
        return static::pendingPostsQuery()
            ->with('author')
            ->latest('updated_at')
            ->limit(12)
            ->get();
    }

    public function pendingPostsCount(): int
    {
        return static::pendingPostsQuery()->count();
    }

    public function validateTeacher(string $teacherId): void
    {
        $this->ensureSuperAdmin();

        $teacher = static::pendingTeachersQuery()
            ->whereKey($teacherId)
            ->first();

        if (! $teacher) {
            Notification::make()
                ->title('Compte introuvable ou deja valide')
                ->warning()
                ->send();

            return;
        }

        $teacher->update(['is_active' => true]);
        $teacher->refresh();

        app(PlatformNotificationService::class)->notifyTeacherValidated($teacher);

        Notification::make()
            ->title('Compte enseignant valide')
            ->body("{$teacher->name} peut maintenant se connecter.")
            ->success()
            ->send();
    }

    public function approvePost(string|int $postId): void
    {
        $this->ensureSuperAdmin();

        $post = static::pendingPostsQuery()
            ->whereKey($postId)
            ->first();

        if (! $post) {
            Notification::make()
                ->title('Article introuvable ou deja traite')
                ->warning()
                ->send();

            return;
        }

        $oldStatus = $post->status;

        $post->update([
            'status' => Post::STATUS_PUBLISHED,
            'approved_by' => auth()->id(),
            'approved_at' => now(),
            'published_at' => $post->published_at ?: now(),
            'rejected_at' => null,
            'rejection_reason' => null,
        ]);

        $post->refresh();

        app(PlatformNotificationService::class)->notifyPostStatusChanged($post->fresh(['author']), $oldStatus);

        Notification::make()
            ->title('Article valide')
            ->body("{$post->title} est maintenant publie.")
            ->success()
            ->send();
    }

    public function teacherViewUrl(User $teacher): string
    {
        return UserResource::getUrl('view', ['record' => $teacher]);
    }

    public function teacherEditUrl(User $teacher): string
    {
        return UserResource::getUrl('edit', ['record' => $teacher]);
    }

    public function postEditUrl(Post $post): string
    {
        return PostResource::getUrl('edit', ['record' => $post]);
    }

    public function postsIndexUrl(): string
    {
        return PostResource::getUrl('index');
    }

    private static function pendingTeachersQuery(): Builder
    {
        return User::query()
            ->role(User::ROLE_TEACHER)
            ->where('is_active', false);
    }

    private static function pendingPostsQuery(): Builder
    {
        return Post::query()
            ->where('status', Post::STATUS_PENDING);
    }

    private function ensureSuperAdmin(): void
    {
        abort_unless(auth()->user()?->isSuperAdmin(), 403);
    }
}
