@extends('layouts.app')

@section('content')
<div class="container mx-auto py-20">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
        <div>
            <h1 class="text-4xl font-bold mb-4">ABOULCODE — Digital Studio</h1>
            <p class="text-lg text-gray-600 mb-6">We design and build modern web and mobile experiences for ambitious startups and brands.</p>
            <a href="/projets" class="inline-block bg-blue-600 text-white px-6 py-3 rounded">Voir nos projets</a>
        </div>
        <div class="space-y-4">
            @foreach($projects as $p)
                <div class="bg-white rounded shadow p-4">
                    <img src="{{ $p->cover ?? '/images/placeholder.png' }}" alt="{{ $p->title }}" class="w-full h-40 object-cover rounded mb-2">
                    <h3 class="text-lg font-semibold">{{ $p->title }}</h3>
                    <p class="text-sm text-gray-500">{{ $p->client }} — {{ $p->year }}</p>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
