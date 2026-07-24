<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog Technique - ABOULCODE</title>
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
                        Blog Technique
                    </h1>
                    <p class="mt-6 text-lg leading-8 text-slate-600 dark:text-slate-300 max-w-2xl mx-auto">
                        Restez informé avec nos articles sur les dernières tendances technologiques et nos conseils en développement
                    </p>
                </div>
            </div>
        </section>

        <!-- Blog Posts -->
        <section class="relative py-16 sm:py-24 px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-7xl">
                @php
                    $posts = [
                        [
                            'id' => 1,
                            'title' => 'Les meilleures pratiques de développement Laravel',
                            'excerpt' => 'Découvrez comment optimiser vos projets Laravel pour une meilleure performance et maintenabilité',
                            'category' => 'Laravel',
                            'date' => '15 Juillet 2024',
                            'author' => 'ABOULCODE',
                        ],
                        [
                            'id' => 2,
                            'title' => 'React vs Vue.js : Lequel choisir ?',
                            'excerpt' => 'Comparaison détaillée des deux frameworks frontend les plus populaires du marché',
                            'category' => 'Frontend',
                            'date' => '12 Juillet 2024',
                            'author' => 'ABOULCODE',
                        ],
                        [
                            'id' => 3,
                            'title' => 'Sécurité Web : Les 10 règles incontournables',
                            'excerpt' => 'Guide complet pour protéger vos applications web contre les menaces courantes',
                            'category' => 'Sécurité',
                            'date' => '10 Juillet 2024',
                            'author' => 'ABOULCODE',
                        ],
                        [
                            'id' => 4,
                            'title' => 'DevOps : Automatisation et déploiement continu',
                            'excerpt' => 'Comment mettre en place une pipeline CI/CD efficace pour vos projets',
                            'category' => 'DevOps',
                            'date' => '8 Juillet 2024',
                            'author' => 'ABOULCODE',
                        ],
                        [
                            'id' => 5,
                            'title' => 'API RESTful : Design et bonnes pratiques',
                            'excerpt' => 'Tout ce que vous devez savoir pour concevoir des API robustes et scalables',
                            'category' => 'Backend',
                            'date' => '5 Juillet 2024',
                            'author' => 'ABOULCODE',
                        ],
                        [
                            'id' => 6,
                            'title' => 'Flutter : Le futur du développement mobile ?',
                            'excerpt' => 'Exploration de framework Flutter et ses avantages pour le cross-platform',
                            'category' => 'Mobile',
                            'date' => '1 Juillet 2024',
                            'author' => 'ABOULCODE',
                        ],
                    ];
                @endphp

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($posts as $post)
                        <article class="group relative overflow-hidden rounded-2xl bg-white dark:bg-gray-800 shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                            <!-- Category Badge -->
                            <div class="absolute top-4 right-4 z-10">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-300">
                                    {{ $post['category'] }}
                                </span>
                            </div>

                            <!-- Image -->
                            <div class="h-48 overflow-hidden bg-gradient-to-br from-blue-400 to-indigo-600 group-hover:scale-105 transition-transform duration-300">
                                <svg class="w-full h-full text-white/30" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M13 3a1 1 0 11-2 0 1 1 0 012 0zM13 7a1 1 0 11-2 0 1 1 0 012 0zM13 11a1 1 0 11-2 0 1 1 0 012 0zM13 15a1 1 0 11-2 0 1 1 0 012 0zM13 19a1 1 0 11-2 0 1 1 0 012 0zM18 3a1 1 0 11-2 0 1 1 0 012 0zM18 7a1 1 0 11-2 0 1 1 0 012 0zM18 11a1 1 0 11-2 0 1 1 0 012 0zM18 15a1 1 0 11-2 0 1 1 0 012 0zM18 19a1 1 0 11-2 0 1 1 0 012 0zM8 3a1 1 0 11-2 0 1 1 0 012 0zM8 7a1 1 0 11-2 0 1 1 0 012 0zM8 11a1 1 0 11-2 0 1 1 0 012 0zM8 15a1 1 0 11-2 0 1 1 0 012 0zM8 19a1 1 0 11-2 0 1 1 0 012 0z"/>
                                </svg>
                            </div>

                            <!-- Content -->
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-3 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition">
                                    {{ $post['title'] }}
                                </h3>
                                <p class="text-slate-600 dark:text-slate-300 text-sm mb-4">
                                    {{ $post['excerpt'] }}
                                </p>

                                <!-- Meta -->
                                <div class="flex items-center justify-between pt-4 border-t border-gray-200 dark:border-gray-700">
                                    <div class="flex items-center text-xs text-slate-500 dark:text-slate-400 space-x-4">
                                        <span>{{ $post['date'] }}</span>
                                        <span>{{ $post['author'] }}</span>
                                    </div>
                                </div>

                                <!-- Read More -->
                                <a href="#" class="inline-flex items-center mt-4 text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 font-semibold text-sm group">
                                    Lire l'article
                                    <svg class="w-4 h-4 ml-2 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-16 flex justify-center items-center gap-2">
                    <button class="px-4 py-2 rounded-lg border border-gray-200 dark:border-gray-700 text-slate-600 dark:text-slate-400 hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                        Précédent
                    </button>
                    <button class="px-4 py-2 rounded-lg bg-blue-600 text-white">1</button>
                    <button class="px-4 py-2 rounded-lg border border-gray-200 dark:border-gray-700 text-slate-600 dark:text-slate-400 hover:bg-gray-50 dark:hover:bg-gray-800 transition">2</button>
                    <button class="px-4 py-2 rounded-lg border border-gray-200 dark:border-gray-700 text-slate-600 dark:text-slate-400 hover:bg-gray-50 dark:hover:bg-gray-800 transition">3</button>
                    <button class="px-4 py-2 rounded-lg border border-gray-200 dark:border-gray-700 text-slate-600 dark:text-slate-400 hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                        Suivant
                    </button>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="relative bg-gradient-to-r from-blue-600 to-indigo-600 dark:from-blue-900 dark:to-indigo-900 py-16 px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <h2 class="text-4xl font-bold text-white mb-4">
                    Restons connectés
                </h2>
                <p class="text-xl text-blue-100 mb-8">
                    Abonnez-vous à notre newsletter pour recevoir les derniers articles et actualités
                </p>
                <form class="flex flex-col sm:flex-row gap-3 max-w-md mx-auto">
                    <input type="email" placeholder="Votre adresse email" class="flex-1 rounded-lg px-4 py-3 text-slate-900 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-white">
                    <button type="submit" class="rounded-lg bg-white px-6 py-3 text-base font-semibold text-blue-600 shadow-lg transition hover:bg-gray-100 hover:-translate-y-0.5">
                        S'abonner
                    </button>
                </form>
            </div>
        </section>
    </main>

    <!-- Footer -->
    @include('layouts.footer')
</body>
</html>
