@php
    $supportUrl = \App\Filament\Pages\SupportConversations::getUrl();
@endphp

@if (filament()->auth()->check())
    <div class="ot-sidebar-support mx-4 mb-4 mt-3 rounded-lg border border-primary-100 bg-primary-50/70 p-4 shadow-sm dark:border-primary-400/20 dark:bg-primary-400/10">
        <div class="flex items-start gap-3">
            <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-white text-primary-600 ring-1 ring-primary-100 dark:bg-white/10 dark:text-primary-300 dark:ring-primary-400/20">
                <x-filament::icon icon="heroicon-o-lifebuoy" class="h-5 w-5" />
            </span>

            <div class="min-w-0">
                <p class="text-sm font-semibold text-gray-950 dark:text-white">
                    {{ __('filament.dashboard.sidebar_help.title') }}
                </p>
                <p class="mt-1 text-xs leading-5 text-gray-600 dark:text-gray-300">
                    {{ __('filament.dashboard.sidebar_help.body') }}
                </p>
            </div>
        </div>

        <x-filament::button
            :href="$supportUrl"
            tag="a"
            color="primary"
            size="sm"
            outlined
            class="mt-4 w-full"
            icon="heroicon-m-arrow-top-right-on-square"
        >
            {{ __('filament.dashboard.sidebar_help.action') }}
        </x-filament::button>
    </div>
@endif
