<div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
    <h3 class="text-lg font-semibold text-gray-900 mb-4">Progression des Tests</h3>

    @php
        $progress = $this->getProgressData();
    @endphp

    <div class="space-y-4">
        <!-- Stats de Progression -->
        <div class="grid grid-cols-2 gap-4">
            <div class="text-center p-3 bg-blue-50 rounded-lg">
                <p class="text-2xl font-bold text-blue-600">{{ $progress['total_tests'] }}</p>
                <p class="text-xs text-gray-600 mt-1">Total de Tests</p>
            </div>
            <div class="text-center p-3 bg-green-50 rounded-lg">
                <p class="text-2xl font-bold text-green-600">{{ $progress['completed_tests'] }}</p>
                <p class="text-xs text-gray-600 mt-1">Tests Complétés</p>
            </div>
        </div>

        <!-- Barre de Progression -->
        <div class="mt-4">
            <div class="flex items-center justify-between mb-2">
                <span class="text-sm font-medium text-gray-700">Progression Globale</span>
                <span class="text-sm font-semibold text-gray-900">{{ $progress['progress_percent'] }}%</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2">
                <div class="bg-blue-600 h-2 rounded-full transition-all"
                     style="width: {{ $progress['progress_percent'] }}%">
                </div>
            </div>
        </div>

        <!-- Dernier Test -->
        <div class="mt-4 pt-4 border-t border-gray-200">
            <p class="text-sm font-medium text-gray-700 mb-2">Dernier Test :</p>
            <div class="grid grid-cols-2 gap-2">
                <div class="text-sm">
                    <span class="text-gray-600">Date :</span>
                    <p class="font-medium text-gray-900">{{ $progress['latest_test_date'] }}</p>
                </div>
                <div class="text-sm">
                    <span class="text-gray-600">Cycle :</span>
                    <p class="font-medium text-gray-900">{{ $progress['latest_test_cycle'] }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
