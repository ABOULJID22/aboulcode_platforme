<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ABOULCODE</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>body{background:#f8fafc}</style>
</head>
<body>
    <nav class="bg-white shadow">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="/" class="font-bold text-xl">ABOULCODE</a>
            <div class="space-x-4">
                <a href="/" class="text-gray-700">Accueil</a>
                <a href="/projets" class="text-gray-700">Projets</a>
                <a href="/services" class="text-gray-700">Services</a>
                <a href="/blog" class="text-gray-700">Blog</a>
                <a href="/a-propos" class="text-gray-700">À propos</a>
                <a href="/contact" class="text-gray-700">Contact</a>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="mt-16 py-8 text-center text-sm text-gray-600">
        © {{ date('Y') }} ABOULCODE
    </footer>
</body>
</html>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'OrientationTech') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @include('layouts.favicon')


        <!-- Scripts -->
        @include('layouts.theme-init')
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased flex flex-col min-h-screen">
        <div class="flex-grow bg-gray-100 dark:bg-gray-900">
            @include('layouts.navbar')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
          @include('layouts.footer') 
          {{-- Render pushed scripts from child views --}}
          @stack('scripts')
    </body>
</html>
