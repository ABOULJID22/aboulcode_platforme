<x-filament-widgets::widget>
    <footer class="mt-2 border-t border-gray-200 py-6 text-xs text-gray-500 dark:border-white/10 dark:text-gray-400">
        <div class="flex flex-col gap-4 xl:flex-row xl:items-center xl:justify-between">
            <p class="font-medium">
                {{ __('filament.dashboard.footer.copyright') }}
            </p>

            <nav class="flex flex-wrap items-center gap-x-6 gap-y-2" aria-label="{{ __('filament.dashboard.footer.aria') }}">
                <a href="{{ $aboutUrl }}" class="transition hover:text-gray-900 dark:hover:text-white">{{ __('filament.dashboard.footer.about') }}</a>
                <a href="{{ $privacyUrl }}" class="transition hover:text-gray-900 dark:hover:text-white">{{ __('filament.dashboard.footer.privacy') }}</a>
                <a href="{{ $termsUrl }}" class="transition hover:text-gray-900 dark:hover:text-white">{{ __('filament.dashboard.footer.terms') }}</a>
                <a href="{{ $securityUrl }}" class="transition hover:text-gray-900 dark:hover:text-white">{{ __('filament.dashboard.footer.security') }}</a>
                <a href="{{ $supportUrl }}" class="transition hover:text-gray-900 dark:hover:text-white">{{ __('filament.dashboard.footer.support') }}</a>
                <a href="{{ $documentationUrl }}" class="transition hover:text-gray-900 dark:hover:text-white">{{ __('filament.dashboard.footer.documentation') }}</a>
                <span class="hidden h-4 w-px bg-gray-200 dark:bg-white/10 sm:inline-block"></span>
                <a href="{{ route('locale.set', ['locale' => 'fr']) }}" class="font-semibold text-primary-600 dark:text-primary-300">FR</a>
                <span>/</span>
                <a href="{{ route('locale.set', ['locale' => 'en']) }}" class="font-semibold transition hover:text-gray-900 dark:hover:text-white">EN</a>
            </nav>
        </div>
    </footer>
</x-filament-widgets::widget>
