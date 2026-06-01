<div class="space-y-4">
    <p class="text-sm text-gray-600 mb-4">Vérifiez vos réponses avant de soumettre le diagnostic :</p>

    <div class="grid grid-cols-2 gap-4 bg-gray-50 p-4 rounded">
        <div>
            <p class="text-xs font-medium text-gray-500">Cycle</p>
            <p class="font-semibold text-gray-900">{{ $getState()['macro_cycle'] ?? 'Non renseigné' }}</p>
        </div>
        <div>
            <p class="text-xs font-medium text-gray-500">Niveau</p>
            <p class="font-semibold text-gray-900">{{ $getState()['academic_level'] ?? 'Non renseigné' }}</p>
        </div>
        <div>
            <p class="text-xs font-medium text-gray-500">Branche</p>
            <p class="font-semibold text-gray-900">{{ $getState()['track_branch'] ?? 'Non renseigné' }}</p>
        </div>
        <div>
            <p class="text-xs font-medium text-gray-500">Type Établissement</p>
            <p class="font-semibold text-gray-900">{{ $getState()['institution_type'] ?? 'Non renseigné' }}</p>
        </div>
        <div>
            <p class="text-xs font-medium text-gray-500">Langue</p>
            <p class="font-semibold text-gray-900">{{ $getState()['biof_language'] ?? 'FR' }}</p>
        </div>
        <div>
            <p class="text-xs font-medium text-gray-500">Dernière Note</p>
            <p class="font-semibold text-gray-900">{{ $getState()['last_grade'] ?? 'N/A' }}/20</p>
        </div>
    </div>

    <p class="text-xs text-gray-500 italic">Cliquez sur "Soumettre" pour finaliser votre diagnostic.</p>
</div>
