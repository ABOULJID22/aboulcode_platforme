<x-guest-layout>
    <section class="relative w-full overflow-hidden pt-20 sm:pt-24 lg:pt-16">
        <div class="mx-auto grid min-h-[calc(100vh-6rem)] w-full max-w-[1440px] overflow-hidden rounded-none bg-white/95 shadow-[0_34px_90px_rgba(2,6,23,0.24)] ring-1 ring-white/50 dark:bg-slate-950/95 lg:grid-cols-[0.95fr_1.05fr] lg:rounded-[2rem]">
            <aside class="relative order-2 overflow-hidden bg-[#061842] px-6 py-10 text-white sm:px-10 lg:order-1 lg:px-14 lg:py-14">
                <div class="absolute inset-0 bg-[radial-gradient(circle_at_18%_22%,rgba(37,99,235,0.48),transparent_34%),radial-gradient(circle_at_82%_15%,rgba(96,165,250,0.18),transparent_32%),linear-gradient(145deg,#06112f_0%,#083cba_52%,#061842_100%)]"></div>
                <div class="absolute -bottom-40 -left-24 h-96 w-96 rounded-full border-[26px] border-blue-500/70"></div>
                <div class="absolute right-8 top-20 h-52 w-52 rounded-full border border-white/10"></div>
                <div class="absolute left-8 top-12 grid grid-cols-7 gap-3 opacity-20" aria-hidden="true">
                    @for ($i = 0; $i < 42; $i++)
                        <span class="h-1.5 w-1.5 rounded-full bg-white"></span>
                    @endfor
                </div>

                <div class="relative z-10 flex min-h-full flex-col">
                    <div class="max-w-xl">
                        <p class="mb-4 inline-flex rounded-full border border-white/15 bg-white/10 px-4 py-2 text-xs font-bold uppercase tracking-[0.22em] text-blue-100 backdrop-blur">OrientationTech</p>
                        <h1 class="font-libre-baskerville text-4xl font-bold leading-tight text-white sm:text-5xl lg:text-6xl">
                            Your future.<br>
                            <span class="text-blue-300">Our mission.</span>
                        </h1>
                        <p class="mt-5 max-w-lg text-base leading-8 text-blue-50/90 sm:text-lg">
                            OrientationTech guides students and educators toward informed choices and brighter futures.
                        </p>
                    </div>

                    <div class="relative mt-10 flex flex-1 items-center justify-center lg:mt-8">
                        <div class="absolute left-2 top-6 z-20 hidden rounded-2xl border border-white/20 bg-white/18 p-4 shadow-2xl backdrop-blur-md sm:block">
                            <p class="text-xs font-bold text-blue-50">Career Paths</p>
                            <div class="mt-3 space-y-2">
                                <span class="block h-2 w-28 rounded-full bg-white/70"></span>
                                <span class="block h-2 w-20 rounded-full bg-blue-200/70"></span>
                                <span class="block h-2 w-24 rounded-full bg-white/40"></span>
                            </div>
                        </div>

                        <div class="absolute right-2 top-3 z-20 hidden rounded-2xl border border-white/20 bg-white/16 p-4 shadow-2xl backdrop-blur-md sm:block">
                            <div class="flex h-24 w-40 items-end gap-2">
                                <span class="h-8 flex-1 rounded-t bg-blue-200/70"></span>
                                <span class="h-12 flex-1 rounded-t bg-white/70"></span>
                                <span class="h-16 flex-1 rounded-t bg-blue-300/80"></span>
                                <span class="h-20 flex-1 rounded-t bg-white/80"></span>
                            </div>
                        </div>

                        <div class="absolute bottom-8 right-14 z-20 hidden rounded-2xl border border-white/15 bg-blue-950/35 px-4 py-3 shadow-xl backdrop-blur-md md:flex md:items-center md:gap-3">
                            <span class="flex h-11 w-11 items-center justify-center rounded-xl bg-blue-500 text-white">
                                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 3 2 8l10 5 10-5-10-5Z"/><path d="M6 10.5V16c3 2 9 2 12 0v-5.5"/></svg>
                            </span>
                            <div>
                                <p class="text-sm font-bold">AI Orientation</p>
                                <p class="text-xs text-blue-100/80">Personalized insights</p>
                            </div>
                        </div>

                        <div class="relative w-full max-w-xl overflow-hidden rounded-[2rem] border border-white/15 bg-white/8 p-4 shadow-[0_30px_80px_rgba(0,0,0,0.28)] backdrop-blur-sm">
                            <div class="absolute inset-x-8 bottom-6 h-20 rounded-[100%] bg-blue-500/40 blur-3xl"></div>
                            <img src="{{ asset('images/hero-student.png') }}" alt="Student using OrientationTech on a laptop" class="relative z-10 mx-auto max-h-[410px] w-full object-contain drop-shadow-2xl">
                        </div>
                    </div>

                    <div class="relative z-10 mt-10 grid gap-4 sm:grid-cols-3">
                        <div class="rounded-2xl border border-white/15 bg-white/10 p-4 backdrop-blur">
                            <span class="mb-3 flex h-11 w-11 items-center justify-center rounded-xl border border-white/20 bg-white/10 text-blue-100">
                                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="m15 9-4.5 4.5L9 12"/></svg>
                            </span>
                            <h2 class="text-sm font-bold">Personalized guidance</h2>
                            <p class="mt-1 text-xs leading-5 text-blue-100/80">Discover paths that match your strengths and interests.</p>
                        </div>
                        <div class="rounded-2xl border border-white/15 bg-white/10 p-4 backdrop-blur">
                            <span class="mb-3 flex h-11 w-11 items-center justify-center rounded-xl border border-white/20 bg-white/10 text-blue-100">
                                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M4 4.5A2.5 2.5 0 0 1 6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15Z"/></svg>
                            </span>
                            <h2 class="text-sm font-bold">Expert resources</h2>
                            <p class="mt-1 text-xs leading-5 text-blue-100/80">Access reliable content and up-to-date insights.</p>
                        </div>
                        <div class="rounded-2xl border border-white/15 bg-white/10 p-4 backdrop-blur">
                            <span class="mb-3 flex h-11 w-11 items-center justify-center rounded-xl border border-white/20 bg-white/10 text-blue-100">
                                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10Z"/><path d="m9 12 2 2 4-4"/></svg>
                            </span>
                            <h2 class="text-sm font-bold">Secure & private</h2>
                            <p class="mt-1 text-xs leading-5 text-blue-100/80">Your data is protected with industry standards.</p>
                        </div>
                    </div>

                    <p class="relative z-10 mt-8 flex items-center gap-3 text-sm text-blue-50/90">
                        <svg class="h-5 w-5 text-blue-200" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10Z"/></svg>
                        Trusted by students and educators across Morocco.
                    </p>
                </div>
            </aside>

            <div class="order-1 flex items-center justify-center bg-slate-50 px-4 py-8 dark:bg-slate-950 sm:px-8 lg:order-2 lg:px-12 lg:py-12">
                <div
                    x-data="signupPage({ role: @js(old('user_type', 'student')), name: @js(old('name', '')), email: @js(old('email', '')) })"
                    class="w-full max-w-4xl rounded-[2rem] border border-slate-200 bg-white p-6 shadow-[0_28px_70px_rgba(15,23,42,0.12)] dark:border-white/10 dark:bg-slate-900 sm:p-8 lg:p-10"
                >
                    <div class="mb-8 text-center">
                        <span class="mx-auto mb-5 flex h-16 w-16 items-center justify-center rounded-full bg-blue-50 text-[#2563eb] shadow-[0_18px_35px_rgba(37,99,235,0.18)] dark:bg-blue-500/15 dark:text-blue-200">
                            <svg class="h-9 w-9" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M18 20a6 6 0 0 0-12 0"/><circle cx="12" cy="10" r="4"/></svg>
                        </span>
                        <h1 class="font-libre-baskerville text-2xl font-bold text-slate-950 sm:text-3xl dark:text-white">
                            Create your <span class="text-[#2563eb]">OrientationTech</span> account
                        </h1>
                        <p class="mt-2 text-sm text-slate-500 sm:text-base dark:text-slate-300">Join our community and start building your future today.</p>
                    </div>

                    <form method="POST" action="{{ route('register') }}" class="space-y-5" @submit="handleSubmit($event)" novalidate>
                        @csrf

                        <div>
                            <p class="mb-3 text-xs font-bold uppercase tracking-[0.24em] text-[#2563eb]">Type de profil</p>
                            <div class="grid gap-4 sm:grid-cols-2">
                                <label class="group relative flex cursor-pointer items-center gap-4 rounded-2xl border p-5 transition" :class="selectedRole === 'student' ? 'border-[#2563eb] bg-blue-50/80 shadow-[0_18px_35px_rgba(37,99,235,0.12)] dark:bg-blue-500/10' : 'border-slate-200 bg-white hover:border-blue-200 dark:border-white/10 dark:bg-slate-950/50 dark:hover:border-blue-500/40'">
                                    <input type="radio" name="user_type" value="student" x-model="selectedRole" class="h-5 w-5 accent-[#2563eb]" @change="clearError('user_type')" required>
                                    <span class="flex h-14 w-14 shrink-0 items-center justify-center rounded-full bg-slate-100 text-[#2563eb] group-hover:bg-blue-100 dark:bg-slate-800">
                                        <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M18 20a6 6 0 0 0-12 0"/><circle cx="12" cy="10" r="4"/></svg>
                                    </span>
                                    <span>
                                        <span class="block font-bold text-slate-900 dark:text-white">Élève</span>
                                        <span class="mt-1 block text-sm text-slate-500 dark:text-slate-300">Accédez au test d’orientation</span>
                                    </span>
                                </label>

                                <label class="group relative flex cursor-pointer items-center gap-4 rounded-2xl border p-5 transition" :class="selectedRole === 'teacher' ? 'border-[#2563eb] bg-blue-50/80 shadow-[0_18px_35px_rgba(37,99,235,0.12)] dark:bg-blue-500/10' : 'border-slate-200 bg-white hover:border-blue-200 dark:border-white/10 dark:bg-slate-950/50 dark:hover:border-blue-500/40'">
                                    <input type="radio" name="user_type" value="teacher" x-model="selectedRole" class="h-5 w-5 accent-[#2563eb]" @change="clearError('user_type')" required>
                                    <span class="flex h-14 w-14 shrink-0 items-center justify-center rounded-full bg-slate-100 text-[#2563eb] group-hover:bg-blue-100 dark:bg-slate-800">
                                        <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 5h16v11H4z"/><path d="M8 21h8"/><path d="M12 16v5"/><path d="M9 9h6"/><path d="M9 12h3"/></svg>
                                    </span>
                                    <span>
                                        <span class="block font-bold text-slate-900 dark:text-white">Enseignant</span>
                                        <span class="mt-1 block text-sm text-slate-500 dark:text-slate-300">Tableau de bord enseignant</span>
                                    </span>
                                </label>
                            </div>
                            <p x-show="errors.user_type" x-text="errors.user_type" class="mt-2 text-sm text-red-600" x-cloak></p>
                            <x-input-error :messages="$errors->get('user_type')" class="mt-2 text-sm text-red-600" />
                        </div>

                        <div class="grid gap-4 md:grid-cols-2">
                            <div class="space-y-2">
                                <label for="name" class="text-xs font-bold uppercase tracking-[0.2em] text-[#2563eb]">Full name</label>
                                <div class="relative">
                                    <svg class="pointer-events-none absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M18 20a6 6 0 0 0-12 0"/><circle cx="12" cy="10" r="4"/></svg>
                                    <input id="name" name="name" type="text" x-model="formData.name" @input="clearError('name')" value="{{ old('name') }}" autocomplete="name" autofocus placeholder="Enter your full name" class="w-full rounded-xl border border-slate-200 bg-white px-12 py-3 text-slate-900 shadow-sm transition placeholder:text-slate-400 focus:border-[#2563eb] focus:outline-none focus:ring-4 focus:ring-blue-100 dark:border-white/10 dark:bg-slate-950 dark:text-white dark:focus:ring-blue-500/20">
                                </div>
                                <p x-show="errors.name" x-text="errors.name" class="text-sm text-red-600" x-cloak></p>
                                <x-input-error :messages="$errors->get('name')" class="text-sm text-red-600" />
                            </div>

                            <div class="space-y-2">
                                <label for="email" class="text-xs font-bold uppercase tracking-[0.2em] text-[#2563eb]">Email</label>
                                <div class="relative">
                                    <svg class="pointer-events-none absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 4h16v16H4z"/><path d="m22 6-10 7L2 6"/></svg>
                                    <input id="email" name="email" type="email" x-model="formData.email" @input="clearError('email')" value="{{ old('email') }}" autocomplete="username" placeholder="you@example.com" class="w-full rounded-xl border border-slate-200 bg-white px-12 py-3 text-slate-900 shadow-sm transition placeholder:text-slate-400 focus:border-[#2563eb] focus:outline-none focus:ring-4 focus:ring-blue-100 dark:border-white/10 dark:bg-slate-950 dark:text-white dark:focus:ring-blue-500/20">
                                </div>
                                <p x-show="errors.email" x-text="errors.email" class="text-sm text-red-600" x-cloak></p>
                                <x-input-error :messages="$errors->get('email')" class="text-sm text-red-600" />
                            </div>

                            <div class="space-y-2">
                                <label for="password" class="text-xs font-bold uppercase tracking-[0.2em] text-[#2563eb]">Password</label>
                                <div class="relative">
                                    <svg class="pointer-events-none absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6 10V8a6 6 0 0 1 12 0v2"/><rect x="4" y="10" width="16" height="10" rx="2"/></svg>
                                    <input id="password" name="password" :type="showPassword ? 'text' : 'password'" x-model="formData.password" @input="clearError('password')" autocomplete="new-password" placeholder="Create a password" class="w-full rounded-xl border border-slate-200 bg-white px-12 py-3 pr-12 text-slate-900 shadow-sm transition placeholder:text-slate-400 focus:border-[#2563eb] focus:outline-none focus:ring-4 focus:ring-blue-100 dark:border-white/10 dark:bg-slate-950 dark:text-white dark:focus:ring-blue-500/20">
                                    <button type="button" @click="showPassword = !showPassword" class="absolute right-3 top-1/2 flex h-9 w-9 -translate-y-1/2 items-center justify-center rounded-lg text-slate-400 transition hover:bg-slate-100 hover:text-[#2563eb] dark:hover:bg-slate-800" aria-label="Toggle password visibility">
                                        <svg x-show="!showPassword" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12Z"/><circle cx="12" cy="12" r="3"/></svg>
                                        <svg x-show="showPassword" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" x-cloak><path d="m3 3 18 18"/><path d="M10.6 10.6A2 2 0 0 0 12 14a2 2 0 0 0 1.4-.6"/><path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c6.5 0 10 8 10 8a17.88 17.88 0 0 1-3.22 4.31"/><path d="M6.61 6.61C3.84 8.48 2 12 2 12s3.5 8 10 8a9.5 9.5 0 0 0 4.39-1.06"/></svg>
                                    </button>
                                </div>
                                <p x-show="errors.password" x-text="errors.password" class="text-sm text-red-600" x-cloak></p>
                                <x-input-error :messages="$errors->get('password')" class="text-sm text-red-600" />
                            </div>

                            <div class="space-y-2">
                                <label for="password_confirmation" class="text-xs font-bold uppercase tracking-[0.2em] text-[#2563eb]">Confirm password</label>
                                <div class="relative">
                                    <svg class="pointer-events-none absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6 10V8a6 6 0 0 1 12 0v2"/><rect x="4" y="10" width="16" height="10" rx="2"/></svg>
                                    <input id="password_confirmation" name="password_confirmation" :type="showConfirmPassword ? 'text' : 'password'" x-model="formData.password_confirmation" @input="clearError('password_confirmation')" autocomplete="new-password" placeholder="Confirm your password" class="w-full rounded-xl border border-slate-200 bg-white px-12 py-3 pr-12 text-slate-900 shadow-sm transition placeholder:text-slate-400 focus:border-[#2563eb] focus:outline-none focus:ring-4 focus:ring-blue-100 dark:border-white/10 dark:bg-slate-950 dark:text-white dark:focus:ring-blue-500/20">
                                    <button type="button" @click="showConfirmPassword = !showConfirmPassword" class="absolute right-3 top-1/2 flex h-9 w-9 -translate-y-1/2 items-center justify-center rounded-lg text-slate-400 transition hover:bg-slate-100 hover:text-[#2563eb] dark:hover:bg-slate-800" aria-label="Toggle confirm password visibility">
                                        <svg x-show="!showConfirmPassword" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12Z"/><circle cx="12" cy="12" r="3"/></svg>
                                        <svg x-show="showConfirmPassword" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" x-cloak><path d="m3 3 18 18"/><path d="M10.6 10.6A2 2 0 0 0 12 14a2 2 0 0 0 1.4-.6"/><path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c6.5 0 10 8 10 8a17.88 17.88 0 0 1-3.22 4.31"/><path d="M6.61 6.61C3.84 8.48 2 12 2 12s3.5 8 10 8a9.5 9.5 0 0 0 4.39-1.06"/></svg>
                                    </button>
                                </div>
                                <p x-show="errors.password_confirmation" x-text="errors.password_confirmation" class="text-sm text-red-600" x-cloak></p>
                                <x-input-error :messages="$errors->get('password_confirmation')" class="text-sm text-red-600" />
                            </div>
                        </div>

                        <div class="rounded-xl border border-slate-200 bg-slate-50 p-4 dark:border-white/10 dark:bg-slate-950/60">
                            <p class="mb-3 text-xs font-bold uppercase tracking-[0.2em] text-slate-500 dark:text-slate-300">Password requirements</p>
                            <div class="grid gap-2 text-sm sm:grid-cols-2">
                                <template x-for="rule in [
                                    { key: 'length', label: 'At least 8 characters' },
                                    { key: 'letter', label: 'At least one letter (a-z)' },
                                    { key: 'number', label: 'At least one number (0-9)' },
                                    { key: 'special', label: 'At least one special character' }
                                ]" :key="rule.key">
                                    <div class="flex items-center gap-2" :class="passwordRuleMet(rule.key) ? 'text-emerald-600 dark:text-emerald-300' : 'text-slate-500 dark:text-slate-400'">
                                        <span class="flex h-5 w-5 items-center justify-center rounded-full border text-[0.65rem]" :class="passwordRuleMet(rule.key) ? 'border-emerald-300 bg-emerald-50 dark:bg-emerald-500/15' : 'border-slate-300 bg-white dark:border-white/10 dark:bg-slate-900'">
                                            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m5 12 4 4L19 6"/></svg>
                                        </span>
                                        <span x-text="rule.label"></span>
                                    </div>
                                </template>
                            </div>
                        </div>

                        <div>
                            <label class="flex items-start gap-3 text-sm text-slate-600 dark:text-slate-300">
                                <input type="checkbox" name="terms" value="1" x-model="formData.terms" @change="clearError('terms')" class="mt-0.5 h-5 w-5 rounded border-slate-300 text-[#2563eb] focus:ring-[#2563eb]">
                                <span>I agree to the <a href="{{ route('legal') }}" class="font-semibold text-[#2563eb] hover:text-blue-700">Terms of Service</a> and <a href="{{ route('privacy') }}" class="font-semibold text-[#2563eb] hover:text-blue-700">Privacy Policy</a>.</span>
                            </label>
                            <p x-show="errors.terms" x-text="errors.terms" class="mt-2 text-sm text-red-600" x-cloak></p>
                        </div>

                        <button type="submit" class="group flex w-full items-center justify-center gap-3 rounded-xl bg-[#2563eb] px-6 py-4 text-base font-bold text-white shadow-[0_18px_35px_rgba(37,99,235,0.28)] transition hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-200 disabled:cursor-wait disabled:opacity-80" :disabled="loading">
                            <svg x-show="!loading" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M16 21v-2a4 4 0 0 0-8 0v2"/><circle cx="12" cy="7" r="4"/><path d="M19 8v6"/><path d="M22 11h-6"/></svg>
                            <svg x-show="loading" class="h-5 w-5 animate-spin" viewBox="0 0 24 24" fill="none" aria-hidden="true" x-cloak><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" d="M4 12a8 8 0 0 1 8-8" stroke="currentColor" stroke-width="4" stroke-linecap="round"></path></svg>
                            <span x-text="loading ? 'Creating account...' : 'Create account'"></span>
                        </button>

                        <div class="flex items-center gap-4 text-center text-sm text-slate-500 dark:text-slate-300">
                            <span class="h-px flex-1 bg-slate-200 dark:bg-white/10"></span>
                            <span>Already registered? <a href="{{ route('login') }}" class="font-bold text-[#2563eb] hover:text-blue-700">Sign in</a></span>
                            <span class="h-px flex-1 bg-slate-200 dark:bg-white/10"></span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-guest-layout>