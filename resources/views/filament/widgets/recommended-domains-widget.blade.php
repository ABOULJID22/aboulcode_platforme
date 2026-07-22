<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">
            {{ __('filament.dashboard.widgets.recommended_domains.title') }}
        </x-slot>

        <x-slot name="description">
            {{ __('filament.dashboard.widgets.recommended_domains.description') }}
        </x-slot>

        <x-slot name="afterHeader">
            <x-filament::button
                :href="$viewAllUrl"
                tag="a"
                color="gray"
                size="sm"
                outlined
            >
                {{ __('filament.dashboard.actions.view_all') }}
            </x-filament::button>
        </x-slot>

        <div class="space-y-4">
            @foreach ($domains as $domain)
                @php
                    $color = $domain['color'] ?? 'gray';
                    $iconClasses = match ($color) {
                        'primary' => 'bg-primary-50 text-primary-600 ring-primary-100 dark:bg-primary-400/10 dark:text-primary-300 dark:ring-primary-400/20',
                        'success' => 'bg-emerald-50 text-emerald-600 ring-emerald-100 dark:bg-emerald-400/10 dark:text-emerald-300 dark:ring-emerald-400/20',
                        'warning' => 'bg-amber-50 text-amber-600 ring-amber-100 dark:bg-amber-400/10 dark:text-amber-300 dark:ring-amber-400/20',
                        'info' => 'bg-sky-50 text-sky-600 ring-sky-100 dark:bg-sky-400/10 dark:text-sky-300 dark:ring-sky-400/20',
                        'danger' => 'bg-rose-50 text-rose-600 ring-rose-100 dark:bg-rose-400/10 dark:text-rose-300 dark:ring-rose-400/20',
                        default => 'bg-gray-50 text-gray-600 ring-gray-100 dark:bg-white/10 dark:text-gray-300 dark:ring-white/10',
                    };
                    $barClasses = match ($color) {
                        'primary' => 'bg-primary-500',
                        'success' => 'bg-emerald-500',
                        'warning' => 'bg-amber-500',
                        'info' => 'bg-sky-500',
                        'danger' => 'bg-rose-500',
                        default => 'bg-gray-400',
                    };
                @endphp

                <div class="flex items-center gap-3">
                    <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full ring-1 {{ $iconClasses }}">
                        <x-filament::icon :icon="$domain['icon']" class="h-4 w-4" />
                    </span>

                    <div class="min-w-0 flex-1">
                        <div class="mb-1 flex items-center justify-between gap-3 text-sm">
                            <span class="truncate font-medium text-gray-700 dark:text-gray-200">
                                {{ $domain['label'] }}
                            </span>
                            <span class="shrink-0 font-semibold text-gray-950 dark:text-white">
                                {{ number_format($domain['value'], 1, ',', ' ') }}%
                            </span>
                        </div>

                        <div class="h-2 overflow-hidden rounded-full bg-gray-100 dark:bg-white/10">
                            <div
                                class="h-full rounded-full {{ $barClasses }}"
                                style="width: {{ min(100, max(4, (float) $domain['value'])) }}%"
                            ></div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
