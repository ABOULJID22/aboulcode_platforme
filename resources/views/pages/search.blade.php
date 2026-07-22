<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Recherche - OrientationTech</title>
    @include('layouts.favicon')
    @include('layouts.theme-init')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gray-50 text-gray-900 dark:bg-gray-900 dark:text-gray-100">
@include('layouts.navbar')

<main class="min-h-screen pt-24 sm:pt-28">
    <section class="border-b border-gray-200 bg-white dark:border-white/10 dark:bg-gray-950">
        <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:py-12">
            <div class="grid gap-8 lg:grid-cols-[minmax(0,1fr),22rem] lg:items-end">
                <div>
                    <p class="mb-0 text-xs font-extrabold uppercase tracking-[0.22em] text-[#2563eb] dark:text-blue-300">OrientationTech</p>
                    <h1 class="mb-0 mt-3 text-3xl font-black tracking-tight text-gray-950 sm:text-4xl dark:text-white">Recherche globale</h1>
                    <p class="mb-0 mt-3 max-w-2xl text-sm leading-6 text-gray-600 sm:text-base dark:text-gray-300">
                        Articles, domaines, ressources, services et pages publiques.
                    </p>
                </div>

                <div class="rounded-2xl border border-gray-200 bg-gray-50 p-4 dark:border-white/10 dark:bg-gray-900">
                    <div class="flex items-center justify-between gap-3">
                        <span class="text-sm font-bold text-gray-700 dark:text-gray-200">Resultats</span>
                        <span class="rounded-full bg-[#eff6ff] px-3 py-1 text-sm font-black text-[#2563eb] dark:bg-blue-500/10 dark:text-blue-200">
                            {{ $hasQuery ? $totalResults : 0 }}
                        </span>
                    </div>
                    @if($hasQuery)
                        <p class="mb-0 mt-2 truncate text-sm text-gray-500 dark:text-gray-400">Pour "{{ $query }}"</p>
                    @else
                        <p class="mb-0 mt-2 text-sm text-gray-500 dark:text-gray-400">Saisis au moins 2 caracteres.</p>
                    @endif
                </div>
            </div>

            <form method="GET" action="{{ route('search') }}" class="mt-8">
                <div class="flex flex-col overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-lg shadow-slate-950/5 focus-within:border-[#2563eb] focus-within:ring-4 focus-within:ring-[#2563eb]/10 sm:flex-row dark:border-white/10 dark:bg-gray-900">
                    <div class="flex min-w-0 flex-1 items-center gap-3 px-4 py-3">
                        <svg class="h-5 w-5 shrink-0 text-[#2563eb]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <circle cx="11" cy="11" r="7" />
                            <path d="m20 20-3.5-3.5" />
                        </svg>
                        <label for="global-search-page" class="sr-only">Recherche globale</label>
                        <input
                            id="global-search-page"
                            type="search"
                            name="q"
                            value="{{ $query }}"
                            placeholder="Rechercher un domaine, un article, une ressource..."
                            autocomplete="off"
                            class="min-h-12 w-full border-0 bg-transparent text-base font-semibold text-gray-950 placeholder:text-gray-400 focus:outline-none focus:ring-0 dark:text-white dark:placeholder:text-gray-500"
                            autofocus
                        >
                    </div>
                    <button type="submit" class="m-2 inline-flex items-center justify-center rounded-xl bg-[#2563eb] px-5 py-3 text-sm font-black text-white transition hover:bg-[#1d4ed8] focus:outline-none focus:ring-4 focus:ring-[#2563eb]/20">
                        Rechercher
                    </button>
                </div>
            </form>
        </div>
    </section>

    <section class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:py-10">
        @if(! $hasQuery)
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                @foreach($quickLinks as $link)
                    <a href="{{ $link['url'] }}" class="group rounded-2xl border border-gray-200 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:border-[#bfdbfe] hover:shadow-lg dark:border-white/10 dark:bg-gray-800">
                        <span class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-[#eff6ff] text-[#2563eb] dark:bg-blue-500/10 dark:text-blue-200">
                            <svg class="h-5 w-5 transition group-hover:translate-x-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M5 12h14" />
                                <path d="m13 6 6 6-6 6" />
                            </svg>
                        </span>
                        <h2 class="mb-0 mt-4 text-base font-black text-gray-950 dark:text-white">{{ $link['label'] }}</h2>
                    </a>
                @endforeach
            </div>
        @elseif($totalResults === 0)
            <div class="rounded-2xl border border-dashed border-gray-300 bg-white p-8 text-center dark:border-white/10 dark:bg-gray-800">
                <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-gray-100 text-gray-500 dark:bg-gray-900 dark:text-gray-300">
                    <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <circle cx="11" cy="11" r="7" />
                        <path d="m20 20-3.5-3.5" />
                    </svg>
                </div>
                <h2 class="mb-0 mt-5 text-xl font-black text-gray-950 dark:text-white">Aucun resultat trouve</h2>
                <p class="mb-0 mt-2 text-sm text-gray-500 dark:text-gray-400">Essaie avec un mot plus simple comme data, IA, cybersecurite ou developpement.</p>
            </div>
        @else
            <div class="grid gap-6 lg:grid-cols-[16rem,minmax(0,1fr)]">
                <aside class="lg:sticky lg:top-28 lg:self-start">
                    <div class="rounded-2xl border border-gray-200 bg-white p-4 shadow-sm dark:border-white/10 dark:bg-gray-800">
                        <p class="mb-3 text-xs font-black uppercase tracking-[0.18em] text-gray-500 dark:text-gray-400">Categories</p>
                        <div class="space-y-2">
                            @foreach($sections as $key => $section)
                                @if($section['items']->isNotEmpty())
                                    <a href="#search-{{ $key }}" class="flex items-center justify-between rounded-xl px-3 py-2 text-sm font-bold text-gray-700 transition hover:bg-[#eff6ff] hover:text-[#2563eb] dark:text-gray-200 dark:hover:bg-blue-500/10 dark:hover:text-blue-200">
                                        <span>{{ $section['label'] }}</span>
                                        <span class="rounded-full bg-gray-100 px-2 py-0.5 text-xs text-gray-500 dark:bg-gray-900 dark:text-gray-300">{{ $section['items']->count() }}</span>
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </aside>

                <div class="space-y-8">
                    @foreach($sections as $key => $section)
                        @continue($section['items']->isEmpty())

                        <section id="search-{{ $key }}" class="scroll-mt-28">
                            <div class="mb-3 flex flex-col gap-1 sm:flex-row sm:items-end sm:justify-between">
                                <div>
                                    <h2 class="mb-0 text-xl font-black text-gray-950 dark:text-white">{{ $section['label'] }}</h2>
                                    <p class="mb-0 mt-1 text-sm text-gray-500 dark:text-gray-400">{{ $section['description'] }}</p>
                                </div>
                                <span class="text-sm font-bold text-[#2563eb] dark:text-blue-200">{{ $section['items']->count() }}</span>
                            </div>

                            <div class="space-y-3">
                                @foreach($section['items'] as $item)
                                    <a href="{{ $item['url'] }}" class="group block rounded-2xl border border-gray-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:border-[#bfdbfe] hover:shadow-lg dark:border-white/10 dark:bg-gray-800 dark:hover:border-blue-400/30">
                                        <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                                            <div class="min-w-0">
                                                <div class="flex flex-wrap items-center gap-2">
                                                    <span class="rounded-full bg-[#eff6ff] px-3 py-1 text-xs font-black text-[#2563eb] dark:bg-blue-500/10 dark:text-blue-200">{{ $item['badge'] }}</span>
                                                    @if(! empty($item['meta']))
                                                        <span class="text-xs font-semibold text-gray-500 dark:text-gray-400">{{ $item['meta'] }}</span>
                                                    @endif
                                                </div>
                                                <h3 class="mb-0 mt-3 text-lg font-black text-gray-950 transition group-hover:text-[#2563eb] dark:text-white dark:group-hover:text-blue-200">{{ $item['title'] }}</h3>
                                                <p class="mb-0 mt-2 line-clamp-2 text-sm leading-6 text-gray-600 dark:text-gray-300">{{ $item['summary'] }}</p>
                                            </div>
                                            <span class="inline-flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border border-gray-200 text-gray-500 transition group-hover:border-[#bfdbfe] group-hover:bg-[#eff6ff] group-hover:text-[#2563eb] dark:border-white/10 dark:text-gray-300 dark:group-hover:bg-blue-500/10 dark:group-hover:text-blue-200">
                                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                                    <path d="M7 17 17 7" />
                                                    <path d="M8 7h9v9" />
                                                </svg>
                                            </span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </section>
                    @endforeach
                </div>
            </div>
        @endif
    </section>
</main>

@include('layouts.footer')
</body>
</html>
