<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">
            <span class="inline-flex items-center gap-2">
                {{ __('filament.dashboard.insights.title') }}
                <x-filament::badge color="primary">
                    {{ __('filament.dashboard.insights.badge') }}
                </x-filament::badge>
            </span>
        </x-slot>

        <div class="space-y-4">
            <div class="rounded-lg border border-primary-100 bg-primary-50/70 p-5 dark:border-primary-400/20 dark:bg-primary-400/10">
                <div class="flex gap-4">
                    <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-primary-600 text-white shadow-sm shadow-primary-500/30">
                        <x-filament::icon icon="heroicon-o-sparkles" class="h-6 w-6" />
                    </span>

                    <div class="space-y-3 text-sm text-gray-700 dark:text-gray-200">
                        <p class="font-semibold text-gray-950 dark:text-white">
                            {{ __('filament.dashboard.insights.main') }}
                        </p>

                        <div>
                            <p class="font-semibold text-gray-950 dark:text-white">
                                {{ __('filament.dashboard.insights.recommendation_label') }}
                            </p>
                            <p>{{ __('filament.dashboard.insights.recommendation') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid gap-3 sm:grid-cols-3">
                @foreach ($metrics as $metric)
                    @php
                        $colorClasses = match ($metric['color']) {
                            'success' => 'text-emerald-600 dark:text-emerald-300',
                            'info' => 'text-sky-600 dark:text-sky-300',
                            default => 'text-primary-600 dark:text-primary-300',
                        };
                    @endphp

                    <div class="rounded-lg border border-gray-200 bg-white p-4 dark:border-white/10 dark:bg-white/5">
                        <p class="text-lg font-bold {{ $colorClasses }}">{{ $metric['value'] }}</p>
                        <p class="mt-1 text-xs font-medium leading-5 text-gray-600 dark:text-gray-300">
                            {{ $metric['label'] }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
