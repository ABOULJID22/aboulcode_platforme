<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">
            {{ __('filament.dashboard.activity.title') }}
        </x-slot>

        <div class="space-y-4">
            @foreach ($activities as $activity)
                @php
                    $badgeClasses = match ($activity['color'] ?? 'gray') {
                        'success' => 'bg-emerald-100 text-emerald-700 dark:bg-emerald-400/15 dark:text-emerald-300',
                        'primary' => 'bg-primary-100 text-primary-700 dark:bg-primary-400/15 dark:text-primary-300',
                        'warning' => 'bg-amber-100 text-amber-700 dark:bg-amber-400/15 dark:text-amber-300',
                        'info' => 'bg-sky-100 text-sky-700 dark:bg-sky-400/15 dark:text-sky-300',
                        'danger' => 'bg-rose-100 text-rose-700 dark:bg-rose-400/15 dark:text-rose-300',
                        default => 'bg-gray-100 text-gray-700 dark:bg-white/10 dark:text-gray-300',
                    };
                @endphp

                <div class="flex items-start gap-3">
                    <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full text-xs font-semibold {{ $badgeClasses }}">
                        {{ $activity['initials'] }}
                    </span>

                    <div class="min-w-0 flex-1">
                        <div class="flex items-start justify-between gap-3">
                            <p class="text-sm font-semibold leading-5 text-gray-950 dark:text-white">
                                {{ $activity['title'] }}
                            </p>
                            <span class="shrink-0 text-xs text-gray-500 dark:text-gray-400">
                                {{ $activity['time'] }}
                            </span>
                        </div>

                        <p class="mt-1 text-xs leading-5 text-gray-500 dark:text-gray-400">
                            {{ $activity['description'] }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
