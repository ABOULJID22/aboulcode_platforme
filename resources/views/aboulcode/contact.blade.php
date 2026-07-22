@extends('layouts.app')

@section('content')
<div class="container mx-auto py-16">
    <div class="max-w-2xl mx-auto bg-white rounded shadow p-8">
        <h2 class="text-2xl font-semibold mb-4">Contactez-nous</h2>
        @if(session('success'))
            <div class="mb-4 text-green-600">{{ session('success') }}</div>
        @endif
        <form method="POST" action="{{ route('aboulcode.contact.submit') }}">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <input name="name" placeholder="Nom" class="border p-2 rounded" required>
                <input name="email" placeholder="Email" type="email" class="border p-2 rounded" required>
                <input name="phone" placeholder="Téléphone" class="border p-2 rounded">
                <input name="company" placeholder="Entreprise" class="border p-2 rounded">
                <input name="budget" placeholder="Budget" class="border p-2 rounded">
                <input name="subject" placeholder="Sujet" class="border p-2 rounded">
            </div>
            <div class="mt-4">
                <textarea name="message" placeholder="Message" class="w-full border p-2 rounded" rows="6" required></textarea>
            </div>
            <div class="mt-4 text-right">
                <button class="bg-blue-600 text-white px-4 py-2 rounded">Envoyer</button>
            </div>
        </form>
    </div>
</div>
@endsection
