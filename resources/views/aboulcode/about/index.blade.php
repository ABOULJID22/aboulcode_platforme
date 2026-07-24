@extends('layouts.app')

@section('content')
<main class="min-h-screen bg-white dark:bg-gray-900">
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-r from-blue-600 to-indigo-600 dark:from-blue-900 dark:to-indigo-900 py-20 px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-4xl text-center">
            <h1 class="text-5xl font-bold text-white mb-6">
                À Propos d'ABOULCODE
            </h1>
            <p class="text-xl text-blue-100">
                Une agence web moderne dédiée à la transformation numérique de vos projets
            </p>
        </div>
    </section>

    <!-- Our Story Section -->
    <section class="py-16 px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-4xl">
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-8">
                Notre Histoire
            </h2>
            <div class="space-y-4 text-gray-700 dark:text-gray-300">
                <p class="text-lg leading-relaxed">
                    Fondée en 2019, ABOULCODE est née de la passion de créer des solutions numériques innovantes. 
                    Notre équipe de développeurs, designers et stratèges numériques travaille chaque jour pour transformer 
                    les idées de nos clients en produits digitaux exceptionnels.
                </p>
                <p class="text-lg leading-relaxed">
                    Avec plus de 5 ans d'expérience dans le secteur du développement web et mobile, nous avons aidé 
                    des dizaines d'entreprises à atteindre leurs objectifs numériques. Notre approche combine expertise technique, 
                    créativité et une compréhension profonde des besoins du marché.
                </p>
            </div>
        </div>
    </section>

    <!-- Our Mission Section -->
    <section class="py-16 px-4 sm:px-6 lg:px-8 bg-gray-50 dark:bg-gray-800">
        <div class="mx-auto max-w-4xl">
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-8">
                Notre Mission
            </h2>
            <div class="grid md:grid-cols-2 gap-8">
                <div class="bg-white dark:bg-gray-700 p-6 rounded-lg">
                    <h3 class="font-semibold text-lg text-gray-900 dark:text-white mb-3">
                        🎯 Innover
                    </h3>
                    <p class="text-gray-700 dark:text-gray-300">
                        Créer des solutions numériques qui propulsent vos projets vers l'avenir
                    </p>
                </div>
                <div class="bg-white dark:bg-gray-700 p-6 rounded-lg">
                    <h3 class="font-semibold text-lg text-gray-900 dark:text-white mb-3">
                        💼 Professionnalisme
                    </h3>
                    <p class="text-gray-700 dark:text-gray-300">
                        Fournir des services de qualité supérieure avec une éthique professionnelle exemplaire
                    </p>
                </div>
                <div class="bg-white dark:bg-gray-700 p-6 rounded-lg">
                    <h3 class="font-semibold text-lg text-gray-900 dark:text-white mb-3">
                        🤝 Collaborer
                    </h3>
                    <p class="text-gray-700 dark:text-gray-300">
                        Travailler étroitement avec nos clients pour comprendre et dépasser leurs attentes
                    </p>
                </div>
                <div class="bg-white dark:bg-gray-700 p-6 rounded-lg">
                    <h3 class="font-semibold text-lg text-gray-900 dark:text-white mb-3">
                        📈 Croître
                    </h3>
                    <p class="text-gray-700 dark:text-gray-300">
                        Accompagner vos projets dans leur évolution pour un succès durable
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Values Section -->
    <section class="py-16 px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-4xl">
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-8">
                Nos Valeurs
            </h2>
            <div class="grid md:grid-cols-2 gap-8">
                <div class="border-l-4 border-blue-600 pl-6 py-2">
                    <h3 class="font-bold text-lg text-gray-900 dark:text-white mb-2">
                        Innovation
                    </h3>
                    <p class="text-gray-700 dark:text-gray-300">
                        Nous recherchons constamment les meilleures technologies et les approches les plus innovantes 
                        pour fournir des solutions avant-gardistes.
                    </p>
                </div>
                <div class="border-l-4 border-blue-600 pl-6 py-2">
                    <h3 class="font-bold text-lg text-gray-900 dark:text-white mb-2">
                        Qualité
                    </h3>
                    <p class="text-gray-700 dark:text-gray-300">
                        Chaque projet est traité avec soin et attention aux détails pour assurer une excellence 
                        constante dans la livraison.
                    </p>
                </div>
                <div class="border-l-4 border-blue-600 pl-6 py-2">
                    <h3 class="font-bold text-lg text-gray-900 dark:text-white mb-2">
                        Expertise
                    </h3>
                    <p class="text-gray-700 dark:text-gray-300">
                        Notre équipe possède une expertise approfondie dans tous les domaines du développement 
                        web et mobile moderne.
                    </p>
                </div>
                <div class="border-l-4 border-blue-600 pl-6 py-2">
                    <h3 class="font-bold text-lg text-gray-900 dark:text-white mb-2">
                        Performance
                    </h3>
                    <p class="text-gray-700 dark:text-gray-300">
                        Nous optimisons chaque aspect de nos solutions pour garantir des performances optimales 
                        et une expérience utilisateur exceptionnelle.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="py-16 px-4 sm:px-6 lg:px-8 bg-gray-50 dark:bg-gray-800">
        <div class="mx-auto max-w-4xl">
            <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-12 text-center">
                Notre Équipe
            </h2>
            <div class="grid md:grid-cols-2 gap-8">
                <!-- Team Member 1 -->
                <div class="text-center">
                    <div class="mb-4">
                        <div class="w-24 h-24 mx-auto bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center">
                            <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                            </svg>
                        </div>
                    </div>
                    <h3 class="font-bold text-lg text-gray-900 dark:text-white mb-1">
                        Ahmed Bouamine
                    </h3>
                    <p class="text-blue-600 dark:text-blue-400 font-semibold mb-2">
                        Fondateur & Directeur
                    </p>
                    <p class="text-gray-700 dark:text-gray-300 text-sm">
                        Entrepreneur passionné avec 8+ ans d'expérience en développement web et gestion de projets digitaux
                    </p>
                </div>

                <!-- Team Member 2 -->
                <div class="text-center">
                    <div class="mb-4">
                        <div class="w-24 h-24 mx-auto bg-gradient-to-br from-indigo-400 to-indigo-600 rounded-full flex items-center justify-center">
                            <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                            </svg>
                        </div>
                    </div>
                    <h3 class="font-bold text-lg text-gray-900 dark:text-white mb-1">
                        Fatima El-Hassani
                    </h3>
                    <p class="text-blue-600 dark:text-blue-400 font-semibold mb-2">
                        Lead Developer
                    </p>
                    <p class="text-gray-700 dark:text-gray-300 text-sm">
                        Développeuse full-stack spécialisée dans Laravel, React et architecture cloud
                    </p>
                </div>

                <!-- Team Member 3 -->
                <div class="text-center">
                    <div class="mb-4">
                        <div class="w-24 h-24 mx-auto bg-gradient-to-br from-purple-400 to-purple-600 rounded-full flex items-center justify-center">
                            <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                            </svg>
                        </div>
                    </div>
                    <h3 class="font-bold text-lg text-gray-900 dark:text-white mb-1">
                        Mohamed Karim
                    </h3>
                    <p class="text-blue-600 dark:text-blue-400 font-semibold mb-2">
                        UI/UX Designer
                    </p>
                    <p class="text-gray-700 dark:text-gray-300 text-sm">
                        Designer créatif passionné par la création d'interfaces exceptionnelles et l'expérience utilisateur
                    </p>
                </div>

                <!-- Team Member 4 -->
                <div class="text-center">
                    <div class="mb-4">
                        <div class="w-24 h-24 mx-auto bg-gradient-to-br from-pink-400 to-pink-600 rounded-full flex items-center justify-center">
                            <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                            </svg>
                        </div>
                    </div>
                    <h3 class="font-bold text-lg text-gray-900 dark:text-white mb-1">
                        Salma Bennani
                    </h3>
                    <p class="text-blue-600 dark:text-blue-400 font-semibold mb-2">
                        Project Manager
                    </p>
                    <p class="text-gray-700 dark:text-gray-300 text-sm">
                        Gestionnaire de projets expérimentée assurant une livraison fluide et alignée avec vos objectifs
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics Section -->
    <section class="py-16 px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-4xl">
            <div class="grid md:grid-cols-4 gap-8 text-center">
                <div>
                    <div class="text-4xl font-bold text-blue-600 dark:text-blue-400 mb-2">
                        50+
                    </div>
                    <p class="text-gray-700 dark:text-gray-300">
                        Projets Réalisés
                    </p>
                </div>
                <div>
                    <div class="text-4xl font-bold text-blue-600 dark:text-blue-400 mb-2">
                        30+
                    </div>
                    <p class="text-gray-700 dark:text-gray-300">
                        Clients Satisfaits
                    </p>
                </div>
                <div>
                    <div class="text-4xl font-bold text-blue-600 dark:text-blue-400 mb-2">
                        15+
                    </div>
                    <p class="text-gray-700 dark:text-gray-300">
                        Experts
                    </p>
                </div>
                <div>
                    <div class="text-4xl font-bold text-blue-600 dark:text-blue-400 mb-2">
                        5+
                    </div>
                    <p class="text-gray-700 dark:text-gray-300">
                        Ans d'Expérience
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 px-4 sm:px-6 lg:px-8 bg-blue-600 dark:bg-blue-900">
        <div class="mx-auto max-w-3xl text-center">
            <h2 class="text-3xl font-bold text-white mb-4">
                Prêt à transformer votre vision en réalité ?
            </h2>
            <p class="text-blue-100 text-lg mb-8">
                Contactez-nous aujourd'hui pour discuter de votre projet et découvrir comment ABOULCODE peut vous aider
            </p>
            <a href="{{ route('contact.create') }}" class="inline-flex items-center justify-center rounded-lg bg-white px-8 py-3 text-base font-semibold text-blue-600 shadow-lg transition hover:bg-gray-100 hover:-translate-y-0.5">
                Nous Contacter
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>
        </div>
    </section>
</main>
@endsection
