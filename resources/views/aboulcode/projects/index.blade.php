<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nos Projets - ABOULCODE</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-gray-900 dark:text-gray-100 font-sans dark:bg-gray-900 flex flex-col min-h-screen">
    <!-- Navbar -->
    @include('layouts.navbar')

    <!-- Main Content -->
    <main class="flex-grow">
        <!-- Hero Section -->
        <section class="relative isolate overflow-hidden bg-gradient-to-br from-blue-50 to-indigo-100 dark:from-slate-900 dark:to-slate-800 px-4 pt-24 pb-16 sm:px-6 lg:pt-32">
            <div class="mx-auto max-w-7xl">
                <div class="text-center">
                    <h1 class="text-5xl font-black tracking-tight text-slate-900 dark:text-white sm:text-6xl">
                        Nos Projets
                    </h1>
                    <p class="mt-6 text-lg leading-8 text-slate-600 dark:text-slate-300 max-w-2xl mx-auto">
                        Découvrez une sélection de nos réalisations qui démontrent notre expertise en développement web et mobile
                    </p>
                </div>
            </div>
        </section>

        <!-- Projects Grid -->
        <section class="relative py-16 sm:py-24 px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-7xl">
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($projects as $project)
                        <div class="group relative overflow-hidden rounded-2xl bg-white dark:bg-gray-800 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                            <!-- Project Image -->
                            <div class="relative h-48 overflow-hidden bg-gradient-to-br from-blue-400 to-indigo-600">
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <svg class="w-24 h-24 text-white/30" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                    </svg>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2">
                                    {{ $project['title'] }}
                                </h3>
                                <p class="text-slate-600 dark:text-slate-300 text-sm mb-4">
                                    {{ $project['description'] }}
                                </p>

                                <!-- Technologies -->
                                <div class="flex flex-wrap gap-2 mb-6">
                                    @foreach($project['technologies'] as $tech)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300">
                                            {{ $tech }}
                                        </span>
                                    @endforeach
                                </div>

                                <!-- Link -->
                                <a href="{{ $project['link'] }}" class="inline-flex items-center text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 font-semibold text-sm group">
                                    Voir le projet
                                    <svg class="w-4 h-4 ml-2 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="relative bg-gradient-to-r from-blue-600 to-indigo-600 dark:from-blue-900 dark:to-indigo-900 py-16 px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <h2 class="text-4xl font-bold text-white mb-4">
                    Vous avez un projet en tête ?
                </h2>
                <p class="text-xl text-blue-100 mb-8">
                    Parlons de votre vision et de comment nous pouvons l'transformer en réalité
                </p>
                <a href="{{ route('contact.create') }}" class="inline-flex items-center justify-center rounded-lg bg-white px-8 py-3 text-base font-semibold text-blue-600 shadow-lg transition hover:bg-gray-100 hover:-translate-y-0.5">
                    Démarrer un projet
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                </a>
            </div>
        </section>
    </main>

    <!-- Footer -->
    @include('layouts.footer')
</body>
</html>
