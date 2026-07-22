@php
    $current = app()->getLocale();
    $locales = [
        'fr' => 'FR',
        'en' => 'EN',
    ];
@endphp

@if (filament()->auth()->check())
    <div class="fi-topbar-lang inline-flex items-center gap-2">
        <nav class="ot-lang-switch inline-flex items-center gap-1 rounded-full border border-gray-200 bg-white p-0.5 text-xs font-semibold shadow-sm dark:border-white/10 dark:bg-white/10">
            @foreach ($locales as $locale => $label)
                <a
                    href="{{ route('locale.set', ['locale' => $locale]) }}"
                    title="{{ $label }}"
                    @class([
                        'inline-flex min-w-9 items-center justify-center rounded-full px-3 py-1 transition focus:outline-none focus-visible:ring-2 focus-visible:ring-primary-500/60',
                        'bg-primary-600 text-white shadow-sm dark:bg-primary-500' => $current === $locale,
                        'text-gray-500 hover:bg-gray-100 hover:text-gray-950 dark:text-gray-300 dark:hover:bg-white/10 dark:hover:text-white' => $current !== $locale,
                    ])
                >
                    {{ $label }}
                </a>
            @endforeach
        </nav>

        <button
            x-data="OrientationTechThemeToggle()"
            x-on:click="toggle()"
            type="button"
            class="fi-theme-toggle"
            aria-label="{{ __('filament.dashboard.topbar.toggle_theme') }}"
        >
            <span class="fi-theme-toggle-track">
                <span class="fi-theme-toggle-thumb" x-bind:class="{ 'translate-x-full rotate-180': isDark }"></span>
            </span>
            <span class="fi-theme-toggle-icons">
                <x-filament::icon
                    alias="theme-switcher"
                    icon="heroicon-m-sun"
                    class="h-4 w-4"
                    x-show="!isDark"
                    x-cloak
                />
                <x-filament::icon
                    alias="theme-switcher"
                    icon="heroicon-m-moon"
                    class="h-4 w-4"
                    x-show="isDark"
                    x-cloak
                />
            </span>
        </button>
    </div>
@endif

@once
    @push('scripts')
        <script>
            window.OrientationTechThemeToggle = function () {
                return {
                    isDark: document.documentElement.classList.contains('dark'),
                    init() {
                        if (this.$store?.theme) {
                            this.isDark = this.$store.theme.mode === 'dark';
                            this.$watch('$store.theme.mode', (value) => {
                                this.isDark = value === 'dark';
                            });
                        }
                    },
                    toggle() {
                        if (this.$store?.theme?.toggleMode) {
                            this.$store.theme.toggleMode();
                            this.isDark = this.$store.theme.mode === 'dark';
                            return;
                        }

                        this.isDark = !this.isDark;
                        document.documentElement.classList.toggle('dark', this.isDark);
                        window.localStorage.setItem('theme', this.isDark ? 'dark' : 'light');
                    }
                };
            };
        </script>
    @endpush
@endonce
