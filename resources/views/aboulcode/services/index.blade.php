<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nos Services - ABOULCODE</title>
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
                        Nos Services
                    </h1>
                    <p class="mt-6 text-lg leading-8 text-slate-600 dark:text-slate-300 max-w-2xl mx-auto">
                        ABOULCODE est une agence web et studio digital complète offrant une gamme complète de services pour vos besoins digitaux
                    </p>
                </div>
            </div>
        </section>

        <!-- Services Grid -->
        <section class="relative py-16 sm:py-24 px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-7xl">
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($services as $service)
                        <div class="group relative rounded-2xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 p-8 hover:border-blue-400 dark:hover:border-blue-500 hover:shadow-xl transition-all duration-300">
                            <!-- Icon -->
                            <div class="inline-flex items-center justify-center h-14 w-14 rounded-lg bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 mb-4 group-hover:scale-110 transition-transform">
                                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                            </div>

                            <!-- Content -->
                            <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-3">
                                {{ $service['title'] }}
                            </h3>
                            <p class="text-slate-600 dark:text-slate-300 text-sm mb-6">
                                {{ $service['description'] }}
                            </p>

                            <!-- Features -->
                            <ul class="space-y-2">
                                @foreach($service['features'] as $feature)
                                    <li class="flex items-start text-sm text-slate-600 dark:text-slate-400">
                                        <svg class="w-5 h-5 text-green-500 mr-3 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $feature }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Why Choose Us Section -->
        <section class="relative bg-slate-50 dark:bg-gray-800 py-16 sm:py-24 px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-7xl">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold text-slate-900 dark:text-white mb-4">
                        Pourquoi choisir ABOULCODE ?
                    </h2>
                    <p class="text-xl text-slate-600 dark:text-slate-300">
                        Expertise, qualité et accompagnement
                    </p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <div class="text-center">
                        <div class="mx-auto h-12 w-12 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm3.5-9c.83 0 1.5-.67 1.5-1.5S16.33 8 15.5 8 14 8.67 14 9.5s.67 1.5 1.5 1.5zm-7 0c.83 0 1.5-.67 1.5-1.5S9.33 8 8.5 8 7 8.67 7 9.5 7.67 11 8.5 11zm3.5 6.5c2.33 0 4.31-1.46 5.11-3.5H6.89c.8 2.04 2.78 3.5 5.11 3.5z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-2">
                            Équipe Expérimentée
                        </h3>
                        <p class="text-slate-600 dark:text-slate-400">
                            Développeurs et designers passionnés avec des années d'expérience
                        </p>
                    </div>

                    <div class="text-center">
                        <div class="mx-auto h-12 w-12 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-2">
                            Qualité Assurée
                        </h3>
                        <p class="text-slate-600 dark:text-slate-400">
                            Respect des meilleurs standards et pratiques de l'industrie
                        </p>
                    </div>

                    <div class="text-center">
                        <div class="mx-auto h-12 w-12 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8zm.5-13H11v6l5.25 3.15.75-1.23-4.5-2.67z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-2">
                            Délais Respectés
                        </h3>
                        <p class="text-slate-600 dark:text-slate-400">
                            Livraison dans les délais prévus sans compromettre la qualité
                        </p>
                    </div>

                    <div class="text-center">
                        <div class="mx-auto h-12 w-12 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20 8h-3V4H3c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2v-3h3l3-4-3-4zm-3 8h-2v2h-2v-2h-2v-2h2v-2h2v2h2v2z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-2">
                            Support Continu
                        </h3>
                        <p class="text-slate-600 dark:text-slate-400">
                            Accompagnement et support technique tout au long du projet
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="relative bg-gradient-to-r from-blue-600 to-indigo-600 dark:from-blue-900 dark:to-indigo-900 py-16 px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <h2 class="text-4xl font-bold text-white mb-4">
                    Prêt à commencer ?
                </h2>
                <p class="text-xl text-blue-100 mb-8">
                    Contactez-nous pour discuter de votre projet et obtenir un devis personnalisé
                </p>
                <a href="{{ route('contact.create') }}" class="inline-flex items-center justify-center rounded-lg bg-white px-8 py-3 text-base font-semibold text-blue-600 shadow-lg transition hover:bg-gray-100 hover:-translate-y-0.5">
                    Nous Contacter
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
