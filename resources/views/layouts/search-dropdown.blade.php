@php
    $popularSearches = [
        'Web Development',
        'Data Science',
        'Cybersecurity',
        'UI/UX Design',
        'Cloud Computing',
    ];
@endphp

<div
    id="global-search-dropdown"
    x-show="isSearchOpen"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 -translate-y-3"
    x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 -translate-y-3"
    @click.outside="closeSearch()"
    class="fixed inset-x-0 top-16 z-40 border-y border-blue-100/80 bg-[#f8fbff]/95 shadow-[0_24px_55px_rgba(15,23,42,0.14)] backdrop-blur-xl sm:top-20 dark:border-white/10 dark:bg-slate-950/95"
    x-cloak
>
    <div class="relative mx-auto max-w-6xl px-4 py-5 sm:px-6 sm:py-7 lg:px-8">
        <button
            type="button"
            @click="closeSearch()"
            class="absolute right-4 top-4 flex h-11 w-11 items-center justify-center rounded-xl border border-slate-200/80 bg-white/90 text-slate-500 shadow-sm transition hover:border-blue-200 hover:bg-blue-50 hover:text-[#2563eb] focus:outline-none focus-visible:ring-2 focus-visible:ring-[#2563eb] dark:border-white/10 dark:bg-slate-900/90 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-white sm:right-6"
            aria-label="Close search"
        >
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M18 6 6 18" />
                <path d="m6 6 12 12" />
            </svg>
        </button>

        <form
            method="GET"
            action="{{ route('search') }}"
            class="mx-auto flex w-full max-w-4xl items-center gap-3 rounded-2xl border border-slate-200/80 bg-white px-4 py-3 pr-14 text-slate-900 shadow-[0_14px_34px_rgba(15,23,42,0.10)] transition focus-within:border-[#2563eb]/40 focus-within:ring-4 focus-within:ring-[#2563eb]/10 dark:border-white/10 dark:bg-slate-900 dark:text-white sm:px-5 sm:py-4 sm:pr-5"
            role="search"
        >
            <svg class="h-5 w-5 shrink-0 text-slate-500 dark:text-slate-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <circle cx="11" cy="11" r="7" />
                <path d="m20 20-3.5-3.5" />
            </svg>

            <label for="global-search-dropdown-input" class="sr-only">Search</label>
            <input
                id="global-search-dropdown-input"
                x-ref="searchInput"
                x-model="searchQuery"
                type="search"
                name="q"
                placeholder="Search for domains, guides, or topics..."
                autocomplete="off"
                class="min-w-0 flex-1 border-0 !bg-transparent p-0 text-sm font-semibold text-slate-900 placeholder:text-slate-500 focus:outline-none focus:ring-0 dark:text-white dark:placeholder:text-slate-400 sm:text-base"
            >

            <div class="hidden shrink-0 items-center gap-1.5 text-xs font-semibold text-slate-500 dark:text-slate-400 sm:flex">
                <span>Press</span>
                <kbd class="rounded-lg border border-slate-200 bg-slate-50 px-2 py-1 font-semibold text-slate-600 shadow-sm dark:border-white/10 dark:bg-slate-800 dark:text-slate-200">/</kbd>
                <span>to focus</span>
            </div>

            <button type="submit" class="sr-only">Search</button>
        </form>

        <div class="mx-auto mt-4 flex max-w-4xl flex-wrap items-center justify-center gap-2 text-sm sm:justify-start">
            <span class="mr-1 font-semibold text-slate-600 dark:text-slate-300">Popular searches:</span>
            @foreach ($popularSearches as $suggestion)
                <a
                    href="{{ route('search', ['q' => $suggestion]) }}"
                    @click="closeSearch()"
                    class="inline-flex items-center rounded-full border border-slate-200/80 bg-white/80 px-4 py-2 text-xs font-semibold text-slate-600 shadow-sm transition hover:border-[#2563eb]/30 hover:bg-[#2563eb]/10 hover:text-[#2563eb] focus:outline-none focus-visible:ring-2 focus-visible:ring-[#2563eb] dark:border-white/10 dark:bg-slate-900/80 dark:text-slate-200 dark:hover:bg-blue-500/15 dark:hover:text-blue-200"
                >
                    {{ $suggestion }}
                </a>
            @endforeach
        </div>
    </div>
</div>