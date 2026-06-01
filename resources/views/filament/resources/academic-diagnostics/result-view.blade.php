@props(['record'])

<div class="space-y-6">
    <!-- En-tête -->
    <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg p-6 text-white">
        <h2 class="text-2xl font-bold mb-2">Résultat de votre Diagnostic Académique</h2>
        <p class="opacity-90">{{ $record->submitted_at?->format('d/m/Y à H:i') }}</p>
    </div>

    <!-- Résultat Principal -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="bg-white border border-gray-200 rounded-lg p-6">
            <p class="text-sm font-medium text-gray-500 mb-1">Code Orientation</p>
            <p class="text-2xl font-bold text-gray-900">{{ $record->result_code }}</p>
        </div>
        <div class="bg-white border border-gray-200 rounded-lg p-6">
            <p class="text-sm font-medium text-gray-500 mb-1">Résultat Recommandé</p>
            <p class="text-2xl font-bold text-blue-600">{{ $record->result_label }}</p>
        </div>
    </div>

    <!-- Résumé -->
    @if($record->result_summary)
    <div class="bg-gray-50 border border-gray-200 rounded-lg p-6">
        <p class="text-sm font-medium text-gray-700 mb-2">Résumé</p>
        <p class="text-gray-900">{{ $record->result_summary }}</p>
    </div>
    @endif

    <!-- Détails du Test -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="bg-white border border-gray-200 rounded-lg p-4">
            <p class="text-xs font-medium text-gray-500 uppercase tracking-wide mb-2">Cycle</p>
            <p class="text-lg font-semibold text-gray-900">{{ $record->macro_cycle }}</p>
        </div>
        <div class="bg-white border border-gray-200 rounded-lg p-4">
            <p class="text-xs font-medium text-gray-500 uppercase tracking-wide mb-2">Niveau</p>
            <p class="text-lg font-semibold text-gray-900">{{ $record->academic_level }}</p>
        </div>
        @if($record->track_branch)
        <div class="bg-white border border-gray-200 rounded-lg p-4">
            <p class="text-xs font-medium text-gray-500 uppercase tracking-wide mb-2">Branche</p>
            <p class="text-lg font-semibold text-gray-900">{{ $record->track_branch }}</p>
        </div>
        @endif
        @if($record->last_grade)
        <div class="bg-white border border-gray-200 rounded-lg p-4">
            <p class="text-xs font-medium text-gray-500 uppercase tracking-wide mb-2">Dernière Note</p>
            <p class="text-lg font-semibold text-gray-900">{{ $record->last_grade }}/20</p>
        </div>
        @endif
    </div>

    <!-- Domaines Suggérés -->
    @if($record->result_payload && isset($record->result_payload['orientation_domains']))
    <div class="bg-white border border-gray-200 rounded-lg p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Domaines Recommandés</h3>
        <div class="flex flex-wrap gap-2">
            @foreach($record->result_payload['orientation_domains'] as $domain)
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                {{ $domain }}
            </span>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Actions -->
    <div class="flex gap-4">
        <a href="{{ route('filament.admin.resources.academic-diagnostics.index') }}"
           class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-800 rounded-lg font-medium hover:bg-gray-300 transition">
            Retour à la Liste
        </a>
        <a href="#"
           class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg font-medium hover:bg-blue-700 transition">
            Télécharger le Rapport
        </a>
    </div>
</div>
