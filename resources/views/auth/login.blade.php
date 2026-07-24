<x-guest-layout>
    <section class="relative w-full overflow-hidden pt-20 text-white sm:pt-24">
        <div class="pointer-events-none absolute inset-0 -z-10">
            <div class="absolute left-1/2 top-24 h-72 w-72 -translate-x-1/2 rounded-full bg-blue-500/35 blur-3xl"></div>
            <div class="absolute left-8 top-24 hidden h-64 w-80 rounded-[2rem] border border-white/10 bg-white/10 blur-[1px] lg:block"></div>
            <div class="absolute right-10 top-48 hidden h-60 w-80 rounded-[2rem] border border-white/10 bg-white/10 blur-[1px] lg:block"></div>
            <div class="absolute bottom-10 left-10 hidden h-36 w-64 rounded-[1.5rem] border border-blue-300/20 bg-blue-500/10 blur-[1px] md:block"></div>
            <div class="absolute right-14 top-24 grid grid-cols-7 gap-3 opacity-20" aria-hidden="true">
                @for ($i = 0; $i < 42; $i++)
                    <span class="h-1.5 w-1.5 rounded-full bg-blue-100"></span>
                @endfor
            </div>
        </div>

        <div class="mx-auto flex min-h-[calc(100vh-6rem)] w-full max-w-7xl flex-col items-center justify-center px-4 py-10 sm:px-6 lg:px-8">
            <div
                x-data="loginPage({ email: @js(old('email', '')), rememberMe: @js(old('remember') ? true : false), hasServerErrors: @js($errors->any()) })"
                class="relative w-full max-w-xl rounded-[2rem] border border-white/35 bg-white/82 p-6 text-slate-900 shadow-[0_30px_90px_rgba(37,99,235,0.34)] backdrop-blur-2xl dark:border-white/10 dark:bg-slate-900/78 dark:text-white sm:p-9 lg:p-11"
            >
                <div class="pointer-events-none absolute -inset-1 -z-10 rounded-[2.1rem] bg-blue-500/20 blur-2xl"></div>
                <div class="pointer-events-none absolute left-14 top-16 text-white/80" aria-hidden="true">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2 14.4 8.6 21 11l-6.6 2.4L12 20l-2.4-6.6L3 11l6.6-2.4L12 2Z"/></svg>
                </div>
                <div class="pointer-events-none absolute right-14 top-20 text-white/80" aria-hidden="true">
                    <svg class="h-7 w-7" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2 14.4 8.6 21 11l-6.6 2.4L12 20l-2.4-6.6L3 11l6.6-2.4L12 2Z"/></svg>
                </div>

                <div class="mb-8 text-center">
                    <span class="mx-auto mb-6 flex h-20 w-20 items-center justify-center rounded-full bg-white text-[#2563eb] shadow-[0_18px_45px_rgba(15,23,42,0.18)] dark:bg-slate-950">
                        <img src="{{ asset('images/logo.png') }}" alt="ABOULCODE" class="h-12 w-12 object-contain">
                    </span>
                    <h1 class="font-libre-baskerville text-3xl font-bold leading-tight text-slate-950 sm:text-4xl dark:text-white">
                        Welcome back to<br>
                        <span class="text-[#2563eb]">ABOULCODE</span>
                    </h1>
                    <p class="mx-auto mt-4 max-w-md text-sm leading-6 text-slate-600 dark:text-slate-300">
                        Sign in to continue your journey and unlock your potential.
                    </p>
                </div>

                <x-auth-session-status class="mb-5 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700 dark:border-emerald-500/30 dark:bg-emerald-500/10 dark:text-emerald-200" :status="session('status')" />

                @if ($errors->any())
                    <div class="mb-5 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700 dark:border-red-500/30 dark:bg-red-500/10 dark:text-red-200">
                        {{ $errors->first() }}
                    </div>
                @endif

                <div x-show="errors.general" x-text="errors.general" class="mb-5 rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700 dark:border-red-500/30 dark:bg-red-500/10 dark:text-red-200" x-cloak></div>
                <form method="POST" action="{{ route('login') }}" class="space-y-5" @submit="handleSubmit($event)" novalidate>
                    @csrf

                    <div class="space-y-2">
                        <label for="email" class="text-xs font-bold uppercase tracking-[0.22em] text-[#2563eb]">Email</label>
                        <div class="relative">
                            <svg class="pointer-events-none absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400 dark:text-slate-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 4h16v16H4z"/><path d="m22 6-10 7L2 6"/></svg>
                            <input id="email" name="email" type="email" x-model="email" @input="clearError('email')" value="{{ old('email') }}" autocomplete="username" autofocus placeholder="you@example.com" class="w-full rounded-xl border border-slate-200 bg-white/88 px-12 py-3.5 text-slate-900 shadow-sm transition placeholder:text-slate-400 focus:border-[#2563eb] focus:outline-none focus:ring-4 focus:ring-blue-100 dark:border-white/10 dark:bg-slate-950/85 dark:text-white dark:focus:ring-blue-500/20">
                        </div>
                        <p x-show="errors.email" x-text="errors.email" class="text-sm text-red-600 dark:text-red-300" x-cloak></p>
                        <x-input-error :messages="$errors->get('email')" class="text-sm text-red-600 dark:text-red-300" />
                    </div>

                    <div class="space-y-2">
                        <label for="password" class="text-xs font-bold uppercase tracking-[0.22em] text-[#2563eb]">Password</label>
                        <div class="relative">
                            <svg class="pointer-events-none absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400 dark:text-slate-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6 10V8a6 6 0 0 1 12 0v2"/><rect x="4" y="10" width="16" height="10" rx="2"/></svg>
                            <input id="password" name="password" :type="showPassword ? 'text' : 'password'" x-model="password" @input="clearError('password')" autocomplete="current-password" placeholder="Your password" class="w-full rounded-xl border border-slate-200 bg-white/88 px-12 py-3.5 pr-12 text-slate-900 shadow-sm transition placeholder:text-slate-400 focus:border-[#2563eb] focus:outline-none focus:ring-4 focus:ring-blue-100 dark:border-white/10 dark:bg-slate-950/85 dark:text-white dark:focus:ring-blue-500/20">
                            <button type="button" @click="showPassword = !showPassword" class="absolute right-3 top-1/2 flex h-9 w-9 -translate-y-1/2 items-center justify-center rounded-lg text-slate-400 transition hover:bg-slate-100 hover:text-[#2563eb] dark:hover:bg-slate-800" aria-label="Toggle password visibility">
                                <svg x-show="!showPassword" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12Z"/><circle cx="12" cy="12" r="3"/></svg>
                                <svg x-show="showPassword" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" x-cloak><path d="m3 3 18 18"/><path d="M10.6 10.6A2 2 0 0 0 12 14a2 2 0 0 0 1.4-.6"/><path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c6.5 0 10 8 10 8a17.88 17.88 0 0 1-3.22 4.31"/><path d="M6.61 6.61C3.84 8.48 2 12 2 12s3.5 8 10 8a9.5 9.5 0 0 0 4.39-1.06"/></svg>
                            </button>
                        </div>
                        <p x-show="errors.password" x-text="errors.password" class="text-sm text-red-600 dark:text-red-300" x-cloak></p>
                        <x-input-error :messages="$errors->get('password')" class="text-sm text-red-600 dark:text-red-300" />
                    </div>

                    <div class="flex flex-col gap-3 text-sm text-slate-600 dark:text-slate-300 sm:flex-row sm:items-center sm:justify-between">
                        <label for="remember_me" class="inline-flex items-center gap-3">
                            <input id="remember_me" type="checkbox" name="remember" x-model="rememberMe" class="h-4 w-4 rounded border-slate-300 text-[#2563eb] focus:ring-[#2563eb]">
                            <span>Remember me</span>
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="font-semibold text-[#2563eb] transition hover:text-blue-700">Forgot your password?</a>
                        @endif
                    </div>

                    <button type="submit" class="group flex w-full items-center justify-center gap-3 rounded-xl bg-[#2563eb] px-6 py-4 text-base font-bold text-white shadow-[0_18px_35px_rgba(37,99,235,0.32)] transition hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-200 disabled:cursor-wait disabled:opacity-80" :disabled="loading">
                        <svg x-show="!loading" class="h-5 w-5 transition group-hover:translate-x-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14"/><path d="m13 6 6 6-6 6"/></svg>
                        <svg x-show="loading" class="h-5 w-5 animate-spin" viewBox="0 0 24 24" fill="none" aria-hidden="true" x-cloak><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" d="M4 12a8 8 0 0 1 8-8" stroke="currentColor" stroke-width="4" stroke-linecap="round"></path></svg>
                        <span x-text="loading ? 'Signing in...' : 'Sign in'"></span>
                    </button>

                    <p class="text-center text-sm text-slate-600 dark:text-slate-300">
                        Don’t have an account?
                        <a href="{{ route('register') }}" class="font-bold text-[#2563eb] transition hover:text-blue-700">Create one</a>
                    </p>
                </form>
            </div>
            <div class="mt-10 grid w-full max-w-5xl gap-5 text-white sm:grid-cols-3">
                <div class="flex items-center gap-4 rounded-2xl border border-white/15 bg-white/8 p-5 backdrop-blur-md">
                    <span class="flex h-14 w-14 shrink-0 items-center justify-center rounded-full border border-white/20 bg-blue-500/20 text-blue-100">
                        <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 3 2 8l10 5 10-5-10-5Z"/><path d="M6 10.5V16c3 2 9 2 12 0v-5.5"/></svg>
                    </span>
                    <div>
                        <h2 class="font-bold">Expert Guidance</h2>
                        <p class="mt-1 text-sm leading-6 text-blue-50/82">Learn from reliable resources and AI-powered tools.</p>
                    </div>
                </div>
                <div class="flex items-center gap-4 rounded-2xl border border-white/15 bg-white/8 p-5 backdrop-blur-md">
                    <span class="flex h-14 w-14 shrink-0 items-center justify-center rounded-full border border-white/20 bg-blue-500/20 text-blue-100">
                        <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 19V5"/><path d="M4 19h16"/><path d="m7 15 4-4 3 3 5-7"/><path d="M19 7h-4"/><path d="M19 7v4"/></svg>
                    </span>
                    <div>
                        <h2 class="font-bold">Smart Learning</h2>
                        <p class="mt-1 text-sm leading-6 text-blue-50/82">Personalized paths to help you grow and succeed.</p>
                    </div>
                </div>
                <div class="flex items-center gap-4 rounded-2xl border border-white/15 bg-white/8 p-5 backdrop-blur-md">
                    <span class="flex h-14 w-14 shrink-0 items-center justify-center rounded-full border border-white/20 bg-blue-500/20 text-blue-100">
                        <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10Z"/><path d="m9 12 2 2 4-4"/></svg>
                    </span>
                    <div>
                        <h2 class="font-bold">Trusted Platform</h2>
                        <p class="mt-1 text-sm leading-6 text-blue-50/82">Secure, reliable, and designed for your future.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-guest-layout>
