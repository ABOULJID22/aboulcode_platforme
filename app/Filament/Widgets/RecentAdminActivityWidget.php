<?php

namespace App\Filament\Widgets;

use App\Models\Post;
use App\Models\StudentProfile;
use App\Models\TestPersonnalise;
use Filament\Widgets\Widget;
use Illuminate\Support\Carbon;

class RecentAdminActivityWidget extends Widget
{
    protected static ?int $sort = 5;

    protected string $view = 'filament.widgets.recent-admin-activity-widget';

    protected int | string | array $columnSpan = [
        'default' => 12,
        'lg' => 3,
    ];

    protected function getViewData(): array
    {
        return [
            'activities' => $this->activities(),
        ];
    }

    public static function canView(): bool
    {
        return (bool) auth()->user()?->isSuperAdmin();
    }

    private function activities(): array
    {
        $activities = collect();

        $latestTest = TestPersonnalise::query()
            ->with('user')
            ->where('status', 'completed')
            ->latest('submitted_at')
            ->first();

        if ($latestTest?->user) {
            $activities->push([
                'title' => __('filament.dashboard.activity.test_completed', ['name' => $latestTest->user->name]),
                'description' => $latestTest->primary_domain ?: __('filament.dashboard.activity.orientation_test'),
                'time' => $latestTest->submitted_at?->diffForHumans() ?: __('filament.dashboard.activity.now'),
                'initials' => $this->initials($latestTest->user->name),
                'color' => 'success',
            ]);
        }

        $latestReport = TestPersonnalise::query()
            ->with('user')
            ->where('status', 'completed')
            ->whereExists(function ($query): void {
                $query->selectRaw('1')
                    ->from('academic_diagnostics')
                    ->whereColumn('academic_diagnostics.user_id', 'test_personnalises.user_id')
                    ->where('academic_diagnostics.status', 'completed');
            })
            ->latest('submitted_at')
            ->first();

        if ($latestReport?->user) {
            $activities->push([
                'title' => __('filament.dashboard.activity.report_generated', ['name' => $latestReport->user->name]),
                'description' => __('filament.dashboard.activity.complete_report'),
                'time' => $latestReport->submitted_at?->diffForHumans() ?: __('filament.dashboard.activity.now'),
                'initials' => $this->initials($latestReport->user->name),
                'color' => 'primary',
            ]);
        }

        $school = StudentProfile::query()
            ->selectRaw('school_name, count(*) as students, max(created_at) as latest_at')
            ->whereNotNull('school_name')
            ->groupBy('school_name')
            ->orderByDesc('latest_at')
            ->first();

        if ($school?->school_name) {
            $activities->push([
                'title' => __('filament.dashboard.activity.school_added_students', [
                    'school' => $school->school_name,
                    'count' => (int) $school->students,
                ]),
                'description' => __('filament.dashboard.activity.list_import'),
                'time' => $school->latest_at ? Carbon::parse($school->latest_at)->diffForHumans() : __('filament.dashboard.activity.now'),
                'initials' => $this->initials($school->school_name),
                'color' => 'warning',
            ]);
        }

        $post = Post::query()
            ->latest()
            ->first();

        if ($post) {
            $activities->push([
                'title' => __('filament.dashboard.activity.program_added'),
                'description' => $post->title ?: __('filament.dashboard.activity.educational_content'),
                'time' => $post->created_at?->diffForHumans() ?: __('filament.dashboard.activity.now'),
                'initials' => 'PR',
                'color' => 'info',
            ]);
        }

        if ($activities->isEmpty()) {
            return $this->sampleActivities();
        }

        return $activities
            ->take(5)
            ->values()
            ->all();
    }

    private function sampleActivities(): array
    {
        return [
            ['title' => __('filament.dashboard.activity.sample.test_completed'), 'description' => 'Riverside High School', 'time' => __('filament.dashboard.activity.sample.time_15'), 'initials' => 'JM', 'color' => 'success'],
            ['title' => __('filament.dashboard.activity.sample.report_generated'), 'description' => 'Northview High School', 'time' => __('filament.dashboard.activity.sample.time_43'), 'initials' => 'ML', 'color' => 'primary'],
            ['title' => __('filament.dashboard.activity.sample.school_added_students'), 'description' => __('filament.dashboard.activity.list_import'), 'time' => __('filament.dashboard.activity.sample.time_2h'), 'initials' => 'LA', 'color' => 'warning'],
            ['title' => __('filament.dashboard.activity.sample.program_added'), 'description' => __('filament.dashboard.activity.software_engineering'), 'time' => __('filament.dashboard.activity.sample.time_3h'), 'initials' => 'PW', 'color' => 'info'],
            ['title' => __('filament.dashboard.activity.sample.alert_threshold'), 'description' => __('filament.dashboard.activity.test_completion_low'), 'time' => __('filament.dashboard.activity.sample.time_5h'), 'initials' => 'ST', 'color' => 'danger'],
        ];
    }

    private function initials(string $name): string
    {
        return str($name)
            ->explode(' ')
            ->filter()
            ->take(2)
            ->map(fn (string $part): string => str($part)->substr(0, 1)->upper()->toString())
            ->implode('');
    }
}
