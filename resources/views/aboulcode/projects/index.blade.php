@extends('layouts.app')

@section('content')
<div class="container mx-auto py-16">
    <h2 class="text-2xl font-semibold mb-6">Projets</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($projects as $project)
            <div class="bg-white rounded shadow p-4">
                <img src="{{ $project->cover ?? '/images/placeholder.png' }}" class="w-full h-40 object-cover rounded mb-2">
                <h3 class="font-semibold">{{ $project->title }}</h3>
                <p class="text-sm text-gray-600">{{ Str::limit($project->excerpt, 120) }}</p>
            </div>
        @endforeach
    </div>
    <div class="mt-6">{{ $projects->links() }}</div>
</div>
@endsection
