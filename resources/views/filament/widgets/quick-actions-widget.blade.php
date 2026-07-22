<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">
            {{ __('filament.dashboard.quick_actions.title') }}
        </x-slot>

        <div class="ot-quick-actions grid gap-3">
            @foreach ($actions as $action)
                <a
                    href="{{ $action['url'] }}"
                    class="group flex min-h-12 w-full max-w-full items-center justify-between gap-3 overflow-hidden rounded-lg border border-gray-200 bg-white px-3.5 py-3 text-sm font-semibold text-gray-700 shadow-sm transition hover:border-primary-200 hover:bg-primary-50/60 hover:text-primary-700 dark:border-white/10 dark:bg-white/5 dark:text-gray-200 dark:hover:border-primary-400/30 dark:hover:bg-primary-400/10 dark:hover:text-primary-200"
                >
                    <span class="flex min-w-0 items-center gap-3">
                        <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-primary-50 text-primary-600 ring-1 ring-primary-100 dark:bg-primary-400/10 dark:text-primary-300 dark:ring-primary-400/20">
                            <x-filament::icon :icon="$action['icon']" class="h-5 w-5" />
                        </span>
                        <span class="min-w-0 leading-5">{{ $action['label'] }}</span>
                    </span>

                    <x-filament::icon icon="heroicon-m-chevron-right" class="h-4 w-4 shrink-0 text-gray-400 transition group-hover:translate-x-0.5 group-hover:text-primary-500" />
                </a>
            @endforeach
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
