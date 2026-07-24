<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ABOULCODE — Studio digital</title>

    <!-- À utiliser seulement pour une maquette HTML autonome -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        @keyframes hero-enter {
            from {
                opacity: 0;
                transform: translateY(24px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes hero-scale {
            from {
                opacity: 0;
                transform: scale(.96);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes fade-tab {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes pulse-soft {
            0%, 100% {
                opacity: 1;
            }

            50% {
                opacity: .45;
            }
        }

        .hero-enter {
            animation: hero-enter .7s cubic-bezier(.16, 1, .3, 1) both;
        }

        .hero-scale {
            animation: hero-scale .8s .1s cubic-bezier(.16, 1, .3, 1) both;
        }

        .tab-panel {
            animation: fade-tab .3s cubic-bezier(.16, 1, .3, 1) both;
        }

        .pulse-soft {
            animation: pulse-soft 1.6s ease-in-out infinite;
        }

        .tab-panel[hidden] {
            display: none;
        }

        .modal[hidden] {
            display: none;
        }

        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                animation-duration: .01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: .01ms !important;
                scroll-behavior: auto !important;
            }
        }
    </style>
</head>

<body class="bg-[#FAFAFC] font-sans text-slate-800">

    <!-- HERO -->
    <section class="relative overflow-hidden bg-[#FAFAFC] pb-20 pt-28 text-slate-800 md:pb-28 md:pt-36">

        <!-- Background -->
        <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(ellipse_70%_50%_at_50%_0%,rgba(59,130,246,0.09),transparent)]"></div>
        <div class="pointer-events-none absolute right-12 top-12 h-[450px] w-[450px] rounded-full bg-blue-400/10 blur-3xl"></div>
        <div class="pointer-events-none absolute left-12 top-48 h-[400px] w-[400px] rounded-full bg-indigo-400/10 blur-3xl"></div>
        <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(#cbd5e1_1px,transparent_1px)] opacity-50 [background-size:24px_24px]"></div>

        <div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 items-center gap-12 lg:grid-cols-12 lg:gap-8">

                <!-- Colonne gauche -->
                <div class="hero-enter space-y-6 text-left lg:col-span-5">

                    <div class="inline-flex items-center gap-2 rounded-full border border-blue-200/80 bg-blue-50 px-3.5 py-1.5 font-mono text-xs font-semibold tracking-wide text-blue-700 shadow-sm">
                        <span class="pulse-soft inline-block h-2 w-2 rounded-full bg-blue-600"></span>
                        <span>AGENCE DIGITALE &amp; STUDIO TECH SUR-MESURE</span>
                    </div>

                    <h1 class="text-4xl font-black leading-[1.06] tracking-tight text-slate-900 sm:text-5xl lg:text-6xl">
                        Des produits web <br>
                        <span class="text-blue-600">haute performance</span> <br>
                        pour startups &amp; PME.
                    </h1>

                    <p class="max-w-xl text-sm font-normal leading-relaxed text-slate-600 sm:text-base">
                        ABOULCODE conçoit et accélère vos projets digitaux : applications web complexes,
                        plateformes EdTech/LMS, produits SaaS scalables et interfaces UI/UX sur-mesure.
                        Transformez vos idées en solutions performantes avec une exécution claire,
                        moderne et durable.
                    </p>

                    <div class="flex flex-col items-stretch gap-3 pt-2 sm:flex-row sm:items-center">
                        <button
                            type="button"
                            data-open-estimator
                            class="group inline-flex items-center justify-center rounded-2xl bg-blue-600 px-6 py-3.5 text-sm font-bold text-white shadow-lg shadow-blue-600/25 transition duration-200 hover:-translate-y-0.5 hover:bg-blue-700 hover:shadow-xl active:translate-y-0"
                        >
                            <svg class="mr-2 h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="5" y="2" width="14" height="20" rx="2"></rect>
                                <path d="M8 6h8M8 10h2M14 10h2M8 14h2M14 14h2M8 18h8"></path>
                            </svg>

                            <span>Calculer mon devis express</span>

                            <svg class="ml-1.5 h-4 w-4 transition-transform group-hover:translate-x-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M5 12h14M13 6l6 6-6 6"></path>
                            </svg>
                        </button>

                        <a
                            href="#realisations"
                            class="inline-flex items-center justify-center rounded-2xl border border-slate-200/90 bg-white px-6 py-3.5 text-sm font-bold text-slate-800 shadow-sm transition duration-200 hover:-translate-y-0.5 hover:bg-slate-50"
                        >
                            <svg class="mr-2 h-4 w-4 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="m13 2 9 9-9 9-9-9 9-9Z"></path>
                                <path d="M13 2v9h9"></path>
                            </svg>

                            <span>Nos réalisations (35+)</span>
                        </a>
                    </div>

                    <!-- Garanties -->
                    <div class="grid grid-cols-2 gap-3 pt-2 font-mono text-xs text-slate-600 sm:grid-cols-3">
                        <div class="flex items-center gap-1.5">
                            <svg class="h-4 w-4 shrink-0 text-emerald-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="m5 12 4 4L19 6"></path>
                                <circle cx="12" cy="12" r="9"></circle>
                            </svg>
                            <span>Livraison en 14j</span>
                        </div>

                        <div class="flex items-center gap-1.5">
                            <svg class="h-4 w-4 shrink-0 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 3 4 6v5c0 5 3.4 8.6 8 10 4.6-1.4 8-5 8-10V6l-8-3Z"></path>
                                <path d="m9 12 2 2 4-4"></path>
                            </svg>
                            <span>100% Code source</span>
                        </div>

                        <div class="col-span-2 flex items-center gap-1.5 sm:col-span-1">
                            <svg class="h-4 w-4 shrink-0 text-amber-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M13 2 4 14h7l-1 8 9-12h-7l1-8Z"></path>
                            </svg>
                            <span>ROI orienté résultats</span>
                        </div>
                    </div>

                    <!-- Social proof -->
                    <div class="flex items-center gap-4 border-t border-slate-200/60 pt-4">
                        <div class="flex -space-x-2 overflow-hidden">
                            <img
                                class="inline-block h-10 w-10 rounded-full object-cover ring-2 ring-white shadow-sm"
                                src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=200&q=80"
                                alt="Cliente ABOULCODE"
                                width="80"
                                height="80"
                                loading="lazy"
                            >

                            <img
                                class="inline-block h-10 w-10 rounded-full object-cover ring-2 ring-white shadow-sm"
                                src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=200&q=80"
                                alt="Client ABOULCODE"
                                width="80"
                                height="80"
                                loading="lazy"
                            >

                            <img
                                class="inline-block h-10 w-10 rounded-full object-cover ring-2 ring-white shadow-sm"
                                src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=200&q=80"
                                alt="Cliente ABOULCODE"
                                width="80"
                                height="80"
                                loading="lazy"
                            >

                            <img
                                class="inline-block h-10 w-10 rounded-full object-cover ring-2 ring-white shadow-sm"
                                src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=200&q=80"
                                alt="Client ABOULCODE"
                                width="80"
                                height="80"
                                loading="lazy"
                            >
                        </div>

                        <div class="space-y-0.5">
                            <div class="flex gap-0.5 text-amber-400" aria-label="Note moyenne de 5 sur 5">
                                <span>★</span>
                                <span>★</span>
                                <span>★</span>
                                <span>★</span>
                                <span>★</span>
                            </div>

                            <p class="text-xs font-semibold text-slate-700">
                                Plus de 50 clients &amp; startups satisfaits
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Colonne droite -->
                <div class="hero-scale relative lg:col-span-7">
                    <div class="relative space-y-4 rounded-3xl border border-slate-200/90 bg-white p-5 shadow-2xl sm:p-6">

                        <!-- Header mockup -->
                        <div class="flex flex-wrap items-center justify-between gap-2 border-b border-slate-100 pb-3">
                            <div class="flex items-center gap-2">
                                <div class="flex h-8 w-8 items-center justify-center rounded-xl bg-blue-600 text-xs font-black text-white shadow-md shadow-blue-600/20">
                                    &lt;/&gt;
                                </div>

                                <div>
                                    <span class="block text-xs font-extrabold tracking-tight text-slate-900">
                                        ABOULCODE STUDIO
                                    </span>

                                    <span class="font-mono text-[10px] text-slate-400">
                                        Démos produit en direct
                                    </span>
                                </div>
                            </div>

                            <!-- Tabs -->
                            <div
                                class="flex items-center gap-1 rounded-2xl bg-slate-100 p-1 font-mono text-[11px] font-bold"
                                role="tablist"
                                aria-label="Démos ABOULCODE"
                            >
                                <button
                                    type="button"
                                    class="hero-tab rounded-xl bg-white px-3 py-1.5 text-blue-600 shadow-sm transition"
                                    data-tab="saas"
                                    role="tab"
                                    aria-selected="true"
                                >
                                    SaaS &amp; MRR
                                </button>

                                <button
                                    type="button"
                                    class="hero-tab rounded-xl px-3 py-1.5 text-slate-600 transition hover:text-slate-900"
                                    data-tab="edtech"
                                    role="tab"
                                    aria-selected="false"
                                >
                                    EdTech LMS
                                </button>

                                <button
                                    type="button"
                                    class="hero-tab rounded-xl px-3 py-1.5 text-slate-600 transition hover:text-slate-900"
                                    data-tab="mobile"
                                    role="tab"
                                    aria-selected="false"
                                >
                                    Mobile
                                </button>

                                <button
                                    type="button"
                                    class="hero-tab rounded-xl px-3 py-1.5 text-slate-600 transition hover:text-slate-900"
                                    data-tab="code"
                                    role="tab"
                                    aria-selected="false"
                                >
                                    Code
                                </button>
                            </div>
                        </div>

                        <!-- TAB : SaaS -->
                        <div class="tab-panel space-y-4" data-panel="saas">
                            <div class="space-y-4 rounded-2xl border border-slate-800 bg-slate-900 p-5 text-white shadow-inner">
                                <div class="flex items-center justify-between gap-4">
                                    <div>
                                        <span class="block font-mono text-[10px] font-bold uppercase tracking-wider text-blue-400">
                                            Dashboard SaaS analytics
                                        </span>

                                        <h4 class="text-lg font-black text-white">
                                            Performances métier &amp; revenus
                                        </h4>
                                    </div>

                                    <span class="flex items-center gap-1 rounded-full border border-emerald-500/30 bg-emerald-500/20 px-3 py-1 font-mono text-[10px] font-bold text-emerald-400">
                                        <span class="pulse-soft h-1.5 w-1.5 rounded-full bg-emerald-400"></span>
                                        Croissance +18.4%
                                    </span>
                                </div>

                                <div class="grid grid-cols-3 gap-3 text-center font-mono">
                                    <div class="rounded-xl border border-slate-800 bg-slate-950 p-3">
                                        <span class="block text-[10px] text-slate-400">REVENU MENSUEL</span>
                                        <span class="text-base font-extrabold text-blue-400">$24,850</span>
                                    </div>

                                    <div class="rounded-xl border border-slate-800 bg-slate-950 p-3">
                                        <span class="block text-[10px] text-slate-400">CLIENTS ACTIFS</span>
                                        <span class="text-base font-extrabold text-white">1,420</span>
                                    </div>

                                    <div class="rounded-xl border border-slate-800 bg-slate-950 p-3">
                                        <span class="block text-[10px] text-slate-400">RÉTENTION 90J</span>
                                        <span class="text-base font-extrabold text-emerald-400">94.2%</span>
                                    </div>
                                </div>

                                <!-- Chart -->
                                <div class="pt-2">
                                    <div class="flex h-20 items-end justify-between gap-2 px-2">
                                        <div class="flex h-full flex-1 items-end overflow-hidden rounded-t-md bg-slate-800"><div class="w-full rounded-t-md bg-blue-600" style="height: 40%"></div></div>
                                        <div class="flex h-full flex-1 items-end overflow-hidden rounded-t-md bg-slate-800"><div class="w-full rounded-t-md bg-blue-600" style="height: 55%"></div></div>
                                        <div class="flex h-full flex-1 items-end overflow-hidden rounded-t-md bg-slate-800"><div class="w-full rounded-t-md bg-blue-600" style="height: 35%"></div></div>
                                        <div class="flex h-full flex-1 items-end overflow-hidden rounded-t-md bg-slate-800"><div class="w-full rounded-t-md bg-blue-600" style="height: 70%"></div></div>
                                        <div class="flex h-full flex-1 items-end overflow-hidden rounded-t-md bg-slate-800"><div class="w-full rounded-t-md bg-blue-600" style="height: 85%"></div></div>
                                        <div class="flex h-full flex-1 items-end overflow-hidden rounded-t-md bg-slate-800"><div class="w-full rounded-t-md bg-blue-600" style="height: 60%"></div></div>
                                        <div class="flex h-full flex-1 items-end overflow-hidden rounded-t-md bg-slate-800"><div class="w-full rounded-t-md bg-blue-600" style="height: 95%"></div></div>
                                        <div class="flex h-full flex-1 items-end overflow-hidden rounded-t-md bg-slate-800"><div class="w-full rounded-t-md bg-blue-600" style="height: 80%"></div></div>
                                        <div class="flex h-full flex-1 items-end overflow-hidden rounded-t-md bg-slate-800"><div class="w-full rounded-t-md bg-blue-600" style="height: 100%"></div></div>
                                    </div>

                                    <div class="mt-1 flex justify-between px-1 font-mono text-[9px] text-slate-500">
                                        <span>Jan</span>
                                        <span>Mar</span>
                                        <span>Mai</span>
                                        <span>Juil</span>
                                        <span>Sep</span>
                                        <span>Nov</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- TAB : EdTech -->
                        <div class="tab-panel space-y-4" data-panel="edtech" hidden>
                            <div class="space-y-4 rounded-2xl border border-blue-200/80 bg-blue-50/70 p-5">
                                <div class="flex items-center justify-between gap-3">
                                    <div class="flex items-center gap-2">
                                        <div class="flex h-8 w-8 items-center justify-center rounded-xl bg-blue-600 text-white">
                                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M2 10 12 4l10 6-10 6-10-6Z"></path>
                                                <path d="M6 12.5V16c0 1.5 2.7 3 6 3s6-1.5 6-3v-3.5"></path>
                                            </svg>
                                        </div>

                                        <div>
                                            <span class="block text-xs font-bold text-slate-900">SkillUp EdTech Studio</span>
                                            <span class="text-[10px] text-slate-500">Plateforme de formation certifiante</span>
                                        </div>
                                    </div>

                                    <span class="rounded-full bg-blue-600 px-2.5 py-1 text-[10px] font-bold text-white">
                                        12,500+ apprenants
                                    </span>
                                </div>

                                <div class="space-y-3 rounded-xl border border-blue-100 bg-white p-4">
                                    <div class="flex justify-between gap-3 text-xs font-bold text-slate-800">
                                        <span>Parcours : Développeur Full-Stack Modern</span>
                                        <span class="font-mono text-blue-600">82% complété</span>
                                    </div>

                                    <div class="h-2.5 w-full overflow-hidden rounded-full bg-slate-100">
                                        <div class="h-full w-[82%] rounded-full bg-blue-600"></div>
                                    </div>

                                    <p class="text-[11px] leading-snug text-slate-500">
                                        Dernier module validé :
                                        <strong>Architecture Microservices &amp; Docker</strong>.
                                        Certificat officiel généré.
                                    </p>
                                </div>

                                <div class="grid grid-cols-2 gap-3 text-center font-mono text-xs">
                                    <div class="rounded-xl border border-blue-100 bg-white p-2.5">
                                        <span class="block text-base font-bold text-blue-600">4.9 / 5</span>
                                        <span class="text-[10px] text-slate-500">Avis étudiants</span>
                                    </div>

                                    <div class="rounded-xl border border-blue-100 bg-white p-2.5">
                                        <span class="block text-base font-bold text-emerald-600">8,400+</span>
                                        <span class="text-[10px] text-slate-500">Certificats QR</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- TAB : Mobile -->
                        <div class="tab-panel space-y-4" data-panel="mobile" hidden>
                            <div class="space-y-4 rounded-2xl border border-slate-800 bg-slate-950 p-5 text-white">
                                <div class="flex items-center justify-between gap-3">
                                    <div class="flex items-center gap-2">
                                        <div class="flex h-7 w-7 items-center justify-center rounded-lg bg-blue-500 text-xs font-bold text-white">
                                            FT
                                        </div>

                                        <div>
                                            <span class="block text-xs font-extrabold">FinTrack Mobile App</span>
                                            <span class="block font-mono text-[10px] text-slate-400">PWA Native Performance</span>
                                        </div>
                                    </div>

                                    <span class="rounded border border-emerald-500/30 bg-emerald-500/20 px-2 py-0.5 font-mono text-[10px] text-emerald-400">
                                        €4 250,00 solde
                                    </span>
                                </div>

                                <div class="space-y-2 rounded-xl border border-slate-800 bg-slate-900 p-3">
                                    <span class="font-mono text-[10px] text-slate-400">
                                        Dernières transactions intelligentes
                                    </span>

                                    <div class="space-y-1.5 font-mono text-xs">
                                        <div class="flex items-center justify-between rounded-lg bg-slate-950 p-2">
                                            <span class="text-slate-300">Paiement Serveur AWS</span>
                                            <span class="font-bold text-rose-400">- €124,50</span>
                                        </div>

                                        <div class="flex items-center justify-between rounded-lg bg-slate-950 p-2">
                                            <span class="text-slate-300">Facture Client SaaS</span>
                                            <span class="font-bold text-emerald-400">+ €2 800,00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- TAB : Code -->
                        <div class="tab-panel space-y-4" data-panel="code" hidden>
                            <div class="space-y-2 rounded-2xl border border-slate-800 bg-slate-950 p-4 font-mono text-xs text-slate-200">
                                <div class="flex items-center justify-between border-b border-slate-800 pb-2 text-[11px] text-slate-400">
                                    <span class="font-bold text-blue-400">resources/views/landing.blade.php</span>

                                    <span class="flex items-center gap-1 text-emerald-400">
                                        <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="m5 12 4 4L19 6"></path>
                                        </svg>
                                        Clean Code Approved
                                    </span>
                                </div>

                                <pre class="overflow-x-auto rounded-lg bg-slate-900 p-3 text-[11px] leading-relaxed text-slate-300"><code>@extends('layouts.app')

@section('content')
    &lt;x-hero
        title="Des produits web sur-mesure"
        subtitle="ABOULCODE Studio Digital"
        cta="Démarrer mon projet"
    /&gt;
@endsection</code></pre>

                                <button
                                    type="button"
                                    class="flex w-full items-center justify-center gap-2 rounded-xl bg-blue-600 py-2 text-xs font-bold text-white transition hover:bg-blue-500"
                                >
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8Z"></path>
                                        <path d="M14 2v6h6M8 13h8M8 17h6"></path>
                                    </svg>
                                    Inspecter le code Blade Laravel
                                </button>
                            </div>
                        </div>

                        <!-- Bottom CTA -->
                        <div class="flex items-center justify-between gap-3 rounded-2xl border border-blue-200/80 bg-blue-50 p-3.5 text-xs">
                            <div class="flex items-center gap-2">
                                <svg class="h-4 w-4 shrink-0 text-blue-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="m12 3-1.5 5.5L5 10l5.5 1.5L12 17l1.5-5.5L19 10l-5.5-1.5L12 3Z"></path>
                                </svg>

                                <span class="font-medium text-slate-800">
                                    Un projet en tête ? Obtenez un
                                    <strong>chiffrage express et clair</strong> sous 24h.
                                </span>
                            </div>

                            <button
                                type="button"
                                data-open-estimator
                                class="shrink-0 rounded-xl bg-blue-600 px-3.5 py-1.5 text-xs font-bold text-white shadow-sm transition hover:bg-blue-700"
                            >
                                Estimer →
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- MODAL DEVIS -->
    <div
        id="estimator-modal"
        class="modal fixed inset-0 z-50 flex items-center justify-center bg-slate-950/55 p-4 backdrop-blur-sm"
        role="dialog"
        aria-modal="true"
        aria-labelledby="estimator-title"
        hidden
    >
        <div class="w-full max-w-lg rounded-3xl bg-white p-6 shadow-2xl sm:p-8">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="text-xs font-bold uppercase tracking-[.14em] text-blue-600">
                        Devis express
                    </p>

                    <h2 id="estimator-title" class="mt-2 text-2xl font-black tracking-tight text-slate-900">
                        Parlons de votre projet.
                    </h2>

                    <p class="mt-2 text-sm leading-6 text-slate-600">
                        Décrivez brièvement votre besoin. ABOULCODE vous répond avec une première estimation.
                    </p>
                </div>

                <button
                    type="button"
                    data-close-estimator
                    aria-label="Fermer la fenêtre"
                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border border-slate-200 text-slate-500 transition hover:bg-slate-100"
                >
                    ✕
                </button>
            </div>

            <form class="mt-6 space-y-4">
                <div>
                    <label for="name" class="mb-1.5 block text-sm font-bold text-slate-700">
                        Nom complet
                    </label>

                    <input
                        id="name"
                        type="text"
                        placeholder="Votre nom"
                        class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                    >
                </div>

                <div>
                    <label for="email" class="mb-1.5 block text-sm font-bold text-slate-700">
                        Adresse email
                    </label>

                    <input
                        id="email"
                        type="email"
                        placeholder="vous@entreprise.com"
                        class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                    >
                </div>

                <div>
                    <label for="project-type" class="mb-1.5 block text-sm font-bold text-slate-700">
                        Type de projet
                    </label>

                    <select
                        id="project-type"
                        class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none transition focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                    >
                        <option>Site vitrine professionnel</option>
                        <option>Application web / SaaS</option>
                        <option>Plateforme EdTech / LMS</option>
                        <option>Dashboard ou outil métier</option>
                        <option>UI/UX et identité digitale</option>
                        <option>Autre besoin</option>
                    </select>
                </div>

                <button
                    type="submit"
                    class="inline-flex w-full items-center justify-center rounded-xl bg-blue-600 px-5 py-3.5 text-sm font-bold text-white shadow-lg shadow-blue-600/20 transition hover:bg-blue-700"
                >
                    Envoyer ma demande
                </button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tabs = document.querySelectorAll('.hero-tab');
            const panels = document.querySelectorAll('[data-panel]');

            const activeClasses = [
                'bg-white',
                'text-blue-600',
                'shadow-sm'
            ];

            const inactiveClasses = [
                'text-slate-600',
                'hover:text-slate-900'
            ];

            tabs.forEach(function (tab) {
                tab.addEventListener('click', function () {
                    const target = this.dataset.tab;

                    tabs.forEach(function (item) {
                        item.setAttribute('aria-selected', 'false');
                        item.classList.remove(...activeClasses);
                        item.classList.add(...inactiveClasses);
                    });

                    this.setAttribute('aria-selected', 'true');
                    this.classList.remove(...inactiveClasses);
                    this.classList.add(...activeClasses);

                    panels.forEach(function (panel) {
                        panel.hidden = panel.dataset.panel !== target;

                        if (panel.dataset.panel === target) {
                            panel.classList.remove('tab-panel');
                            void panel.offsetWidth;
                            panel.classList.add('tab-panel');
                        }
                    });
                });
            });

            const modal = document.getElementById('estimator-modal');
            const openButtons = document.querySelectorAll('[data-open-estimator]');
            const closeButtons = document.querySelectorAll('[data-close-estimator]');

            function openModal() {
                modal.hidden = false;
                document.body.style.overflow = 'hidden';

                const firstInput = modal.querySelector('input');
                if (firstInput) {
                    setTimeout(function () {
                        firstInput.focus();
                    }, 100);
                }
            }

            function closeModal() {
                modal.hidden = true;
                document.body.style.overflow = '';
            }

            openButtons.forEach(function (button) {
                button.addEventListener('click', openModal);
            });

            closeButtons.forEach(function (button) {
                button.addEventListener('click', closeModal);
            });

            modal.addEventListener('click', function (event) {
                if (event.target === modal) {
                    closeModal();
                }
            });

            document.addEventListener('keydown', function (event) {
                if (event.key === 'Escape' && !modal.hidden) {
                    closeModal();
                }
            });
        });
    </script>

</body>
</html>








