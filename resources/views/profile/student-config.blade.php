<x-guest-layout>
    <div class="relative min-h-screen overflow-hidden">
        <div class="relative flex min-h-screen items-center justify-center px-4 py-16 sm:px-6 lg:px-8">
            <div class="w-full max-w-2xl overflow-hidden rounded-[28px] border border-[#b8cbe1] bg-white/96 shadow-[0_28px_50px_-18px_rgba(79,107,163,0.32)] ring-1 ring-[#dce6f4]/80 backdrop-blur-xl dark:border-slate-700 dark:bg-slate-900/95 dark:ring-slate-700/70">
                <div class="relative px-8 py-12 sm:px-12">
                    <!-- Alert if needed -->
                    @if (session('alert'))
                    <div class="mb-6 rounded-2xl border border-amber-300/50 bg-amber-50 px-4 py-4 text-sm text-amber-900 dark:border-amber-700 dark:bg-amber-900/20 dark:text-amber-200">
                        <div class="flex items-start gap-3">
                            <svg class="mt-0.5 h-5 w-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" /></svg>
                            <span>{{ session('alert') }}</span>
                        </div>
                    </div>
                    @endif

                    <!-- Header -->
                    <div class="mb-10 flex flex-col items-center text-center">
                        <h1 class="text-3xl font-semibold tracking-tight text-[#2a3d5d] dark:text-slate-100">
                            Configurez votre profil <span class="text-[#4f6ba3] dark:text-[#8aaed0]">Étudiant</span>
                        </h1>
                        <p class="mt-3 max-w-xl text-sm leading-relaxed text-[#5c6f8a] dark:text-slate-300">
                            Complétez votre profil pour accéder à toutes les fonctionnalités d'OrientationTech
                        </p>
                    </div>

                    <!-- Progress indicator -->
                    <div class="mb-8 flex justify-between">
                        <div class="step-indicator active flex flex-col items-center">
                            <div class="flex h-10 w-10 items-center justify-center rounded-full bg-[#4f6ba3] text-white font-semibold">1</div>
                            <span class="mt-2 text-xs font-semibold text-[#7a8cab] dark:text-slate-300">Académique</span>
                        </div>
                        <div class="step-indicator flex flex-col items-center">
                            <div class="flex h-10 w-10 items-center justify-center rounded-full border-2 border-[#c6d6ea] text-[#7a8cab] font-semibold dark:border-slate-600 dark:text-slate-400">2</div>
                            <span class="mt-2 text-xs font-semibold text-[#7a8cab] dark:text-slate-400">Préférences</span>
                        </div>
                        <div class="step-indicator flex flex-col items-center">
                            <div class="flex h-10 w-10 items-center justify-center rounded-full border-2 border-[#c6d6ea] text-[#7a8cab] font-semibold dark:border-slate-600 dark:text-slate-400">3</div>
                            <span class="mt-2 text-xs font-semibold text-[#7a8cab] dark:text-slate-400">Personnelles</span>
                        </div>
                        <div class="step-indicator flex flex-col items-center">
                            <div class="flex h-10 w-10 items-center justify-center rounded-full border-2 border-[#c6d6ea] text-[#7a8cab] font-semibold dark:border-slate-600 dark:text-slate-400">4</div>
                            <span class="mt-2 text-xs font-semibold text-[#7a8cab] dark:text-slate-400">Accord</span>
                        </div>
                    </div>

                    <!-- Form -->
                    <form id="profile-form" method="POST" action="{{ route('student-profile.store') }}" class="space-y-6">
                        @csrf

                        <!-- Step 1: Academic Information -->
                        <div id="step-1" class="step-content space-y-6">
                            <h2 class="text-lg font-semibold text-[#2a3d5d] dark:text-slate-100">Étape 1 — Informations Académiques</h2>

                            <!-- Education Level -->
                            <div class="space-y-2">
                                <x-input-label for="education_level" :value="__('Niveau d\'étude')" class="text-xs font-semibold uppercase tracking-[0.2em] text-[#7a8cab] dark:text-[#b3c4e0]" />
                                <select
                                    id="education_level"
                                    name="education_level"
                                    required
                                    class="block w-full rounded-2xl border border-[#c6d6ea] bg-white/90 px-4 py-3 text-base text-[#2a3d5d] shadow-sm transition focus:border-[#5b7db5] focus:outline-none focus:ring-4 focus:ring-[#8aaed0]/35 dark:border-slate-700 dark:bg-slate-900/70 dark:text-slate-100 dark:focus:border-[#8aaed0]"
                                    value="{{ old('education_level', $profile->education_level ?? '') }}"
                                >
                                    <option value="">-- Sélectionner --</option>
                                    <option value="1ere_bac">1ère année Baccalauréat</option>
                                    <option value="2eme_bac">2ème année Baccalauréat</option>
                                    <option value="bac_plus_1">BAC+1</option>
                                    <option value="bac_plus_2">BAC+2</option>
                                    <option value="bac_plus_3">BAC+3</option>
                                    <option value="bac_plus_4">BAC+4</option>
                                    <option value="bac_plus_5">BAC+5</option>
                                    <option value="bac_plus_6">BAC+6</option>
                                    <option value="doctorant">Doctorant</option>
                                </select>
                                <x-input-error :messages="$errors->get('education_level')" class="text-xs text-[#c23d3d] dark:text-rose-300" />
                            </div>

                            <!-- Bac Type (conditional) -->
                            <div id="bac-type-section" class="space-y-2 hidden">
                                <x-input-label for="bac_type" :value="__('Type de Baccalauréat')" class="text-xs font-semibold uppercase tracking-[0.2em] text-[#7a8cab] dark:text-[#b3c4e0]" />
                                <select
                                    id="bac_type"
                                    name="bac_type"
                                    class="block w-full rounded-2xl border border-[#c6d6ea] bg-white/90 px-4 py-3 text-base text-[#2a3d5d] shadow-sm transition focus:border-[#5b7db5] focus:outline-none focus:ring-4 focus:ring-[#8aaed0]/35 dark:border-slate-700 dark:bg-slate-900/70 dark:text-slate-100 dark:focus:border-[#8aaed0]"
                                    value="{{ old('bac_type', $profile->bac_type ?? '') }}"
                                >
                                    <option value="">-- Sélectionner --</option>
                                    <option value="marocain">Marocain</option>
                                    <option value="mission">Mission</option>
                                </select>
                                <x-input-error :messages="$errors->get('bac_type')" class="text-xs text-[#c23d3d] dark:text-rose-300" />
                            </div>

                            <!-- Bac Field (conditional) -->
                            <div id="bac-field-section" class="space-y-2 hidden">
                                <x-input-label for="bac_field" :value="__('Filière du Baccalauréat')" class="text-xs font-semibold uppercase tracking-[0.2em] text-[#7a8cab] dark:text-[#b3c4e0]" />
                                <select
                                    id="bac_field"
                                    name="bac_field"
                                    class="block w-full rounded-2xl border border-[#c6d6ea] bg-white/90 px-4 py-3 text-base text-[#2a3d5d] shadow-sm transition focus:border-[#5b7db5] focus:outline-none focus:ring-4 focus:ring-[#8aaed0]/35 dark:border-slate-700 dark:bg-slate-900/70 dark:text-slate-100 dark:focus:border-[#8aaed0]"
                                    value="{{ old('bac_field', $profile->bac_field ?? '') }}"
                                >
                                    <option value="">-- Sélectionner --</option>
                                    <option value="sciences_physiques">Sciences Physiques</option>
                                    <option value="sciences_vie">Sciences de la Vie et de la Terre</option>
                                    <option value="sciences_math">Sciences Mathématiques</option>
                                    <option value="sciences_eco">Sciences Économiques</option>
                                    <option value="lettres_humaines">Lettres et Sciences Humaines</option>
                                    <option value="tech_elec">Sciences et Technologies Électriques</option>
                                    <option value="tech_meca">Sciences et Technologies Mécaniques</option>
                                    <option value="arts_appliques">Arts Appliqués</option>
                                </select>
                                <x-input-error :messages="$errors->get('bac_field')" class="text-xs text-[#c23d3d] dark:text-rose-300" />
                            </div>

                            <!-- School Name -->
                            <div class="space-y-2">
                                <x-input-label for="school_name" :value="__('Établissement d\'enseignement')" class="text-xs font-semibold uppercase tracking-[0.2em] text-[#7a8cab] dark:text-[#b3c4e0]" />
                                <x-text-input
                                    id="school_name"
                                    name="school_name"
                                    type="text"
                                    required
                                    class="block w-full"
                                    placeholder="Nom de votre établissement"
                                    value="{{ old('school_name', $profile->school_name ?? '') }}"
                                />
                                <x-input-error :messages="$errors->get('school_name')" class="text-xs text-[#c23d3d] dark:text-rose-300" />
                            </div>

                            <!-- School Type -->
                            <div class="space-y-2">
                                <x-input-label for="school_type" :value="__('Type de lycée')" class="text-xs font-semibold uppercase tracking-[0.2em] text-[#7a8cab] dark:text-[#b3c4e0]" />
                                <select
                                    id="school_type"
                                    name="school_type"
                                    required
                                    class="block w-full rounded-2xl border border-[#c6d6ea] bg-white/90 px-4 py-3 text-base text-[#2a3d5d] shadow-sm transition focus:border-[#5b7db5] focus:outline-none focus:ring-4 focus:ring-[#8aaed0]/35 dark:border-slate-700 dark:bg-slate-900/70 dark:text-slate-100 dark:focus:border-[#8aaed0]"
                                    value="{{ old('school_type', $profile->school_type ?? '') }}"
                                >
                                    <option value="">-- Sélectionner --</option>
                                    <option value="public">Public</option>
                                    <option value="private">Privé</option>
                                </select>
                                <x-input-error :messages="$errors->get('school_type')" class="text-xs text-[#c23d3d] dark:text-rose-300" />
                            </div>
                        </div>

                        <!-- Step 2: Study Preferences -->
                        <div id="step-2" class="step-content hidden space-y-6">
                            <h2 class="text-lg font-semibold text-[#2a3d5d] dark:text-slate-100">Étape 2 — Préférences d'Études</h2>

                            <!-- Preferred School Types -->
                            <div class="space-y-3">
                                <div>
                                    <x-input-label :value="__('Type(s) d\'établissement préféré(s)')" class="text-xs font-semibold uppercase tracking-[0.2em] text-[#7a8cab] dark:text-[#b3c4e0]" />
                                    <p class="mt-1 text-xs text-[#5c6f8a] dark:text-slate-400">Vous pouvez sélectionner plusieurs types d'établissements</p>
                                </div>
                                <div class="space-y-2">
                                    @foreach (['public' => 'Public', 'private' => 'Privé', 'military' => 'Militaire', 'semi-public' => 'Semi-public'] as $value => $label)
                                    <label class="flex items-center">
                                        <input
                                            type="checkbox"
                                            name="preferred_school_types[]"
                                            value="{{ $value }}"
                                            class="h-4 w-4 rounded accent-[#4f6ba3]"
                                            {{ in_array($value, old('preferred_school_types', $profile->preferred_school_types ?? [])) ? 'checked' : '' }}
                                        />
                                        <span class="ml-3 text-sm text-[#2a3d5d] dark:text-slate-200">{{ $label }}</span>
                                    </label>
                                    @endforeach
                                </div>
                                <x-input-error :messages="$errors->get('preferred_school_types')" class="text-xs text-[#c23d3d] dark:text-rose-300" />
                            </div>

                            <!-- Interested Services -->
                            <div class="space-y-3">
                                <x-input-label :value="__('Services qui vous intéressent')" class="text-xs font-semibold uppercase tracking-[0.2em] text-[#7a8cab] dark:text-[#b3c4e0]" />
                                <div class="space-y-2">
                                    <label class="flex items-center">
                                        <input
                                            type="checkbox"
                                            name="interested_services[]"
                                            value="orientation_session"
                                            class="h-4 w-4 rounded accent-[#4f6ba3]"
                                            {{ in_array('orientation_session', old('interested_services', $profile->interested_services ?? [])) ? 'checked' : '' }}
                                        />
                                        <span class="ml-3 text-sm text-[#2a3d5d] dark:text-slate-200">Séance d'orientation avec un conseiller</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input
                                            type="checkbox"
                                            name="interested_services[]"
                                            value="school_registration"
                                            class="h-4 w-4 rounded accent-[#4f6ba3]"
                                            {{ in_array('school_registration', old('interested_services', $profile->interested_services ?? [])) ? 'checked' : '' }}
                                        />
                                        <span class="ml-3 text-sm text-[#2a3d5d] dark:text-slate-200">Service d'inscription dans les écoles supérieures marocaines</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input
                                            type="checkbox"
                                            name="interested_services[]"
                                            value="notifications"
                                            class="h-4 w-4 rounded accent-[#4f6ba3]"
                                            {{ in_array('notifications', old('interested_services', $profile->interested_services ?? [])) ? 'checked' : '' }}
                                        />
                                        <span class="ml-3 text-sm text-[#2a3d5d] dark:text-slate-200">Application de notification et information de concours</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Step 3: Personal Information -->
                        <div id="step-3" class="step-content hidden space-y-6">
                            <h2 class="text-lg font-semibold text-[#2a3d5d] dark:text-slate-100">Étape 3 — Informations Personnelles</h2>

                            <!-- Name & Last Name (auto-filled) -->
                            <div class="grid grid-cols-2 gap-4">
                                <div class="space-y-2">
                                    <x-input-label for="first_name" :value="__('Prénom')" class="text-xs font-semibold uppercase tracking-[0.2em] text-[#7a8cab] dark:text-[#b3c4e0]" />
                                    <x-text-input
                                        id="first_name"
                                        name="first_name"
                                        type="text"
                                        class="block w-full"
                                        readonly
                                        value="{{ old('first_name', auth()->user()->first_name ?? auth()->user()->name) }}"
                                    />
                                </div>
                                <div class="space-y-2">
                                    <x-input-label for="last_name" :value="__('Nom')" class="text-xs font-semibold uppercase tracking-[0.2em] text-[#7a8cab] dark:text-[#b3c4e0]" />
                                    <x-text-input
                                        id="last_name"
                                        name="last_name"
                                        type="text"
                                        class="block w-full"
                                        readonly
                                        value="{{ old('last_name', auth()->user()->last_name ?? '') }}"
                                    />
                                </div>
                            </div>

                            <!-- Birth Date -->
                            <div class="space-y-2">
                                <x-input-label for="birth_date" :value="__('Date de naissance')" class="text-xs font-semibold uppercase tracking-[0.2em] text-[#7a8cab] dark:text-[#b3c4e0]" />
                                <x-text-input
                                    id="birth_date"
                                    name="birth_date"
                                    type="date"
                                    required
                                    class="block w-full"
                                    value="{{ old('birth_date', $profile->birth_date?->format('Y-m-d') ?? '') }}"
                                />
                                <x-input-error :messages="$errors->get('birth_date')" class="text-xs text-[#c23d3d] dark:text-rose-300" />
                            </div>

                            <!-- Gender -->
                            <div class="space-y-2">
                                <x-input-label for="gender" :value="__('Genre')" class="text-xs font-semibold uppercase tracking-[0.2em] text-[#7a8cab] dark:text-[#b3c4e0]" />
                                <select
                                    id="gender"
                                    name="gender"
                                    required
                                    class="block w-full rounded-2xl border border-[#c6d6ea] bg-white/90 px-4 py-3 text-base text-[#2a3d5d] shadow-sm transition focus:border-[#5b7db5] focus:outline-none focus:ring-4 focus:ring-[#8aaed0]/35 dark:border-slate-700 dark:bg-slate-900/70 dark:text-slate-100 dark:focus:border-[#8aaed0]"
                                    value="{{ old('gender', $profile->gender ?? '') }}"
                                >
                                    <option value="">-- Sélectionner --</option>
                                    <option value="masculine">Masculin</option>
                                    <option value="feminine">Féminin</option>
                                </select>
                                <x-input-error :messages="$errors->get('gender')" class="text-xs text-[#c23d3d] dark:text-rose-300" />
                            </div>

                            <!-- City -->
                            <div class="space-y-2">
                                <x-input-label for="city" :value="__('Ville')" class="text-xs font-semibold uppercase tracking-[0.2em] text-[#7a8cab] dark:text-[#b3c4e0]" />
                                <x-text-input
                                    id="city"
                                    name="city"
                                    type="text"
                                    required
                                    class="block w-full"
                                    placeholder="Votre ville"
                                    value="{{ old('city', $profile->city ?? '') }}"
                                />
                                <x-input-error :messages="$errors->get('city')" class="text-xs text-[#c23d3d] dark:text-rose-300" />
                            </div>

                            <!-- Phone (auto-filled from user) -->
                            <div class="space-y-2">
                                <x-input-label for="phone" :value="__('Numéro de téléphone')" class="text-xs font-semibold uppercase tracking-[0.2em] text-[#7a8cab] dark:text-[#b3c4e0]" />
                                <x-text-input
                                    id="phone"
                                    name="phone"
                                    type="tel"
                                    required
                                    class="block w-full"
                                    placeholder="06 XX XX XX XX"
                                    value="{{ old('phone', auth()->user()->phone ?? '') }}"
                                />
                                <x-input-error :messages="$errors->get('phone')" class="text-xs text-[#c23d3d] dark:text-rose-300" />
                            </div>
                        </div>

                        <!-- Step 4: Contact Agreement -->
                        <div id="step-4" class="step-content hidden space-y-6">
                            <h2 class="text-lg font-semibold text-[#2a3d5d] dark:text-slate-100">Étape 4 — Accord de Contact</h2>

                            <div class="rounded-2xl border border-[#c6d6ea] bg-[#eef4fb] p-6 dark:border-slate-700 dark:bg-slate-900/60">
                                <p class="text-sm text-[#4d6185] dark:text-slate-200">
                                    <span class="font-semibold">En acceptant, vous autorisez OrientationTech à vous contacter par téléphone pour :</span>
                                </p>
                                <ul class="mt-3 space-y-2 text-sm text-[#4d6185] dark:text-slate-300">
                                    <li class="flex items-start gap-2">
                                        <span class="text-[#4f6ba3] dark:text-[#8aaed0]">•</span>
                                        Vous informer sur nos services d'orientation
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <span class="text-[#4f6ba3] dark:text-[#8aaed0]">•</span>
                                        Vous présenter notre plateforme d'orientation
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <span class="text-[#4f6ba3] dark:text-[#8aaed0]">•</span>
                                        Vous proposer des séances d'orientation personnalisées
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <span class="text-[#4f6ba3] dark:text-[#8aaed0]">•</span>
                                        Vous accompagner dans vos démarches d'inscription
                                    </li>
                                </ul>
                            </div>

                            <div class="space-y-3">
                                <label class="flex items-start gap-3 rounded-2xl border-2 border-[#c6d6ea] bg-white/90 p-4 transition hover:border-[#5b7db5] dark:border-slate-700 dark:bg-slate-900/70 dark:hover:border-[#8aaed0]">
                                    <input
                                        type="checkbox"
                                        name="consent_contact"
                                        value="1"
                                        required
                                        class="mt-1 h-5 w-5 accent-[#4f6ba3]"
                                        {{ old('consent_contact', $profile->consent_contact ?? false) ? 'checked' : '' }}
                                    />
                                    <span class="text-sm text-[#2a3d5d] dark:text-slate-200">
                                        J'accepte d'être contacté par OrientationTech pour en savoir plus sur nos services et notre plateforme d'orientation
                                    </span>
                                </label>
                                <p class="text-xs text-[#5c6f8a] dark:text-slate-400">
                                    Vous pouvez retirer votre consentement à tout moment en nous contactant.
                                </p>
                                <x-input-error :messages="$errors->get('consent_contact')" class="text-xs text-[#c23d3d] dark:text-rose-300" />
                            </div>
                        </div>

                        <!-- Navigation Buttons -->
                        <div class="mt-8 flex justify-between gap-4">
                            <button
                                type="button"
                                id="prev-btn"
                                class="hidden rounded-2xl border-2 border-[#c6d6ea] px-6 py-3 font-semibold text-[#4f6ba3] transition hover:border-[#5b7db5] hover:bg-[#eef4fb] dark:border-slate-700 dark:text-[#8aaed0] dark:hover:bg-slate-900/70"
                                onclick="changeStep(-1)"
                            >
                                ← Précédent
                            </button>
                            <div class="flex-1"></div>
                            <button
                                type="button"
                                id="next-btn"
                                class="rounded-2xl bg-[#4f6ba3] px-8 py-3 font-semibold text-white shadow-lg shadow-[#4f6ba3]/30 transition hover:bg-[#465f92] dark:hover:bg-[#405b8a]"
                                onclick="changeStep(1)"
                            >
                                Suivant →
                            </button>
                            <button
                                type="submit"
                                id="submit-btn"
                                class="hidden rounded-2xl bg-green-600 px-8 py-3 font-semibold text-white shadow-lg shadow-green-600/30 transition hover:bg-green-700 dark:hover:bg-green-800"
                            >
                                Terminer ✓
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        .step-indicator {
            position: relative;
        }

        .step-indicator.active div:first-child {
            background-color: #4f6ba3;
            color: white;
        }

        .step-indicator.active span {
            color: #4f6ba3;
            font-weight: bold;
        }

        /* Connect steps with a line */
        .step-indicator:not(:last-child)::after {
            content: '';
            position: absolute;
            top: 1.25rem;
            left: 50%;
            width: 100%;
            height: 2px;
            background-color: #c6d6ea;
            z-index: -1;
        }

        .step-indicator.active:not(:last-child)::after {
            background-color: #4f6ba3;
        }

        @media (prefers-color-scheme: dark) {
            .step-indicator.active div:first-child {
                background-color: #8aaed0;
            }

            .step-indicator.active span {
                color: #8aaed0;
            }

            .step-indicator:not(:last-child)::after {
                background-color: #475569;
            }

            .step-indicator.active:not(:last-child)::after {
                background-color: #8aaed0;
            }
        }
    </style>

    <script>
        let currentStep = 1;
        const totalSteps = 4;

        function showStep(step) {
            // Hide all steps
            document.querySelectorAll('.step-content').forEach(el => el.classList.add('hidden'));
            document.querySelectorAll('.step-indicator').forEach(el => el.classList.remove('active'));

            // Show current step
            document.getElementById(`step-${step}`).classList.remove('hidden');
            
            // Update all indicators - mark all steps before current as complete
            document.querySelectorAll('.step-indicator').forEach((indicator, index) => {
                if (index < step) {
                    indicator.classList.add('active');
                }
            });

            // Update buttons
            document.getElementById('prev-btn').classList.toggle('hidden', step === 1);
            document.getElementById('next-btn').classList.toggle('hidden', step === totalSteps);
            document.getElementById('submit-btn').classList.toggle('hidden', step !== totalSteps);

            // Handle conditional fields
            if (step === 1) {
                toggleBacFields();
            }

            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        function changeStep(direction) {
            const newStep = currentStep + direction;
            if (newStep >= 1 && newStep <= totalSteps) {
                currentStep = newStep;
                showStep(currentStep);
            }
        }

        function toggleBacFields() {
            const eduLevel = document.getElementById('education_level').value;
            const bacTypeSection = document.getElementById('bac-type-section');
            const bacFieldSection = document.getElementById('bac-field-section');
            const isBacLevel = eduLevel.includes('1ere_bac') || eduLevel.includes('2eme_bac');

            if (isBacLevel) {
                bacTypeSection.classList.remove('hidden');
                bacFieldSection.classList.remove('hidden');
                document.getElementById('bac_type').required = true;
                document.getElementById('bac_field').required = true;
            } else {
                bacTypeSection.classList.add('hidden');
                bacFieldSection.classList.add('hidden');
                document.getElementById('bac_type').required = false;
                document.getElementById('bac_field').required = false;
            }
        }

        // Event listeners
        document.getElementById('education_level').addEventListener('change', toggleBacFields);

        // Initialize
        showStep(currentStep);
    </script>
</x-guest-layout>
