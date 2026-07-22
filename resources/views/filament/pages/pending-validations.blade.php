<x-filament::page>
    @php
        $teachers = $this->pendingTeachers();
        $posts = $this->pendingPosts();
        $teachersCount = $this->pendingTeachersCount();
        $postsCount = $this->pendingPostsCount();
        $totalCount = $teachersCount + $postsCount;
    @endphp

    <div class="space-y-6">
        <div class="grid gap-4 lg:grid-cols-3">
            <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-white/10 dark:bg-gray-900">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">File de validation</p>
                        <p class="mt-2 text-3xl font-semibold text-gray-950 dark:text-white">{{ $totalCount }}</p>
                    </div>
                    <span class="flex h-11 w-11 items-center justify-center rounded-lg bg-primary-50 text-primary-600 dark:bg-primary-500/10 dark:text-primary-300">
                        <x-filament::icon icon="heroicon-o-clipboard-document-check" class="h-6 w-6" />
                    </span>
                </div>
                <div class="mt-4 h-1.5 overflow-hidden rounded-full bg-gray-100 dark:bg-white/10">
                    <div class="h-full rounded-full bg-primary-500" style="width: {{ $totalCount > 0 ? 100 : 0 }}%"></div>
                </div>
            </div>

            <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-white/10 dark:bg-gray-900">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Profils teacher</p>
                        <p class="mt-2 text-3xl font-semibold text-amber-600 dark:text-amber-300">{{ $teachersCount }}</p>
                    </div>
                    <span class="flex h-11 w-11 items-center justify-center rounded-lg bg-amber-50 text-amber-600 dark:bg-amber-500/10 dark:text-amber-300">
                        <x-filament::icon icon="heroicon-o-user-plus" class="h-6 w-6" />
                    </span>
                </div>
                <p class="mt-4 text-sm text-gray-500 dark:text-gray-400">
                    {{ $teachersCount === 0 ? 'Aucun compte a activer.' : 'Compte(s) bloque(s) avant validation admin.' }}
                </p>
            </div>

            <div class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-white/10 dark:bg-gray-900">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Articles soumis</p>
                        <p class="mt-2 text-3xl font-semibold text-sky-600 dark:text-sky-300">{{ $postsCount }}</p>
                    </div>
                    <span class="flex h-11 w-11 items-center justify-center rounded-lg bg-sky-50 text-sky-600 dark:bg-sky-500/10 dark:text-sky-300">
                        <x-filament::icon icon="heroicon-o-document-text" class="h-6 w-6" />
                    </span>
                </div>
                <p class="mt-4 text-sm text-gray-500 dark:text-gray-400">
                    {{ $postsCount === 0 ? 'Aucun article en attente.' : 'Article(s) pret(s) pour revue.' }}
                </p>
            </div>
        </div>

        @if ($totalCount === 0)
            <div class="rounded-lg border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-800 dark:border-emerald-500/20 dark:bg-emerald-500/10 dark:text-emerald-200">
                <div class="flex items-start gap-3">
                    <x-filament::icon icon="heroicon-o-check-circle" class="mt-0.5 h-5 w-5 shrink-0" />
                    <div>
                        <p class="font-semibold">Tout est a jour.</p>
                        <p class="mt-1 text-emerald-700 dark:text-emerald-300">Les prochaines inscriptions teacher et articles soumis apparaitront ici automatiquement.</p>
                    </div>
                </div>
            </div>
        @endif

        <x-filament::section>
            <x-slot name="heading">
                Profils enseignants a valider
            </x-slot>

            <x-slot name="description">
                Comptes teacher crees depuis l'inscription publique et bloques par le champ is_active.
            </x-slot>

            @if ($teachers->isEmpty())
                <div class="flex min-h-36 flex-col items-center justify-center rounded-lg border border-dashed border-gray-300 bg-gray-50 px-4 py-8 text-center dark:border-white/10 dark:bg-white/5">
                    <x-filament::icon icon="heroicon-o-user-circle" class="h-9 w-9 text-gray-400" />
                    <p class="mt-3 text-sm font-medium text-gray-950 dark:text-white">Aucun profil teacher en attente</p>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Les enseignants deja valides restent visibles dans la ressource Utilisateurs.</p>
                </div>
            @else
                <div class="overflow-hidden rounded-lg border border-gray-200 dark:border-white/10">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 text-sm dark:divide-white/10">
                            <thead class="bg-gray-50 dark:bg-white/5">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Teacher</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Contact</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Statut</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Inscription</th>
                                    <th class="px-4 py-3 text-right text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 bg-white dark:divide-white/10 dark:bg-transparent">
                                @foreach ($teachers as $teacher)
                                    <tr class="transition hover:bg-gray-50 dark:hover:bg-white/5">
                                        <td class="px-4 py-4">
                                            <div class="flex items-center gap-3">
                                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-amber-50 text-sm font-semibold text-amber-700 dark:bg-amber-500/10 dark:text-amber-300">
                                                    {{ \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr($teacher->name ?? 'T', 0, 1)) }}
                                                </div>
                                                <div class="min-w-0">
                                                    <p class="truncate font-semibold text-gray-950 dark:text-white">{{ $teacher->name }}</p>
                                                    <p class="mt-0.5 text-xs text-gray-500 dark:text-gray-400">Role teacher</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-4 text-gray-600 dark:text-gray-300">
                                            <div class="max-w-xs truncate">{{ $teacher->email }}</div>
                                        </td>
                                        <td class="px-4 py-4">
                                            <span class="inline-flex items-center gap-1 rounded-md bg-amber-50 px-2 py-1 text-xs font-medium text-amber-700 ring-1 ring-inset ring-amber-600/20 dark:bg-amber-500/10 dark:text-amber-300 dark:ring-amber-400/20">
                                                <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                                                En attente
                                            </span>
                                        </td>
                                        <td class="px-4 py-4 text-gray-600 dark:text-gray-300">
                                            <div>{{ $teacher->created_at?->format('d/m/Y H:i') }}</div>
                                            <div class="mt-0.5 text-xs text-gray-500 dark:text-gray-400">{{ $teacher->created_at?->diffForHumans() }}</div>
                                        </td>
                                        <td class="px-4 py-4">
                                            <div class="flex flex-wrap justify-end gap-2">
                                                <a href="{{ $this->teacherViewUrl($teacher) }}" class="inline-flex items-center gap-1.5 rounded-md border border-gray-300 px-3 py-1.5 text-sm font-medium text-gray-700 transition hover:bg-gray-50 dark:border-white/10 dark:text-gray-200 dark:hover:bg-white/5">
                                                    <x-filament::icon icon="heroicon-m-eye" class="h-4 w-4" />
                                                    Voir
                                                </a>
                                                <a href="{{ $this->teacherEditUrl($teacher) }}" class="inline-flex items-center gap-1.5 rounded-md border border-gray-300 px-3 py-1.5 text-sm font-medium text-gray-700 transition hover:bg-gray-50 dark:border-white/10 dark:text-gray-200 dark:hover:bg-white/5">
                                                    <x-filament::icon icon="heroicon-m-pencil-square" class="h-4 w-4" />
                                                    Modifier
                                                </a>
                                                <button
                                                    type="button"
                                                    wire:click="validateTeacher('{{ $teacher->id }}')"
                                                    wire:confirm="Valider ce compte enseignant ?"
                                                    class="inline-flex items-center gap-1.5 rounded-md bg-emerald-600 px-3 py-1.5 text-sm font-medium text-white transition hover:bg-emerald-700"
                                                >
                                                    <x-filament::icon icon="heroicon-m-check-circle" class="h-4 w-4" />
                                                    Valider
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </x-filament::section>

        <x-filament::section>
            <x-slot name="heading">
                Articles en attente de validation
            </x-slot>

            <x-slot name="description">
                Articles proposes par les enseignants avant publication.
            </x-slot>

            <x-slot name="afterHeader">
                <a href="{{ $this->postsIndexUrl() }}" class="inline-flex items-center gap-1.5 rounded-md border border-gray-300 px-3 py-1.5 text-sm font-medium text-gray-700 transition hover:bg-gray-50 dark:border-white/10 dark:text-gray-200 dark:hover:bg-white/5">
                    <x-filament::icon icon="heroicon-m-arrow-top-right-on-square" class="h-4 w-4" />
                    Tous les articles
                </a>
            </x-slot>

            @if ($posts->isEmpty())
                <div class="flex min-h-36 flex-col items-center justify-center rounded-lg border border-dashed border-gray-300 bg-gray-50 px-4 py-8 text-center dark:border-white/10 dark:bg-white/5">
                    <x-filament::icon icon="heroicon-o-document-check" class="h-9 w-9 text-gray-400" />
                    <p class="mt-3 text-sm font-medium text-gray-950 dark:text-white">Aucun article en attente</p>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Les articles publies ou en brouillon ne sont pas affiches ici.</p>
                </div>
            @else
                <div class="overflow-hidden rounded-lg border border-gray-200 dark:border-white/10">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 text-sm dark:divide-white/10">
                            <thead class="bg-gray-50 dark:bg-white/5">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Article</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Auteur</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Statut</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Soumission</th>
                                    <th class="px-4 py-3 text-right text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 bg-white dark:divide-white/10 dark:bg-transparent">
                                @foreach ($posts as $post)
                                    <tr class="transition hover:bg-gray-50 dark:hover:bg-white/5">
                                        <td class="px-4 py-4">
                                            <div class="max-w-xl">
                                                <p class="line-clamp-1 font-semibold text-gray-950 dark:text-white">{{ $post->title }}</p>
                                                @if ($post->excerpt)
                                                    <p class="mt-1 line-clamp-2 text-sm text-gray-500 dark:text-gray-400">{{ $post->excerpt }}</p>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-4 py-4 text-gray-600 dark:text-gray-300">
                                            <div>{{ $post->author?->name ?? '-' }}</div>
                                            @if ($post->author?->email)
                                                <div class="mt-0.5 max-w-xs truncate text-xs text-gray-500 dark:text-gray-400">{{ $post->author->email }}</div>
                                            @endif
                                        </td>
                                        <td class="px-4 py-4">
                                            <span class="inline-flex items-center gap-1 rounded-md bg-sky-50 px-2 py-1 text-xs font-medium text-sky-700 ring-1 ring-inset ring-sky-600/20 dark:bg-sky-500/10 dark:text-sky-300 dark:ring-sky-400/20">
                                                <span class="h-1.5 w-1.5 rounded-full bg-sky-500"></span>
                                                En revue
                                            </span>
                                        </td>
                                        <td class="px-4 py-4 text-gray-600 dark:text-gray-300">
                                            <div>{{ $post->updated_at?->format('d/m/Y H:i') }}</div>
                                            <div class="mt-0.5 text-xs text-gray-500 dark:text-gray-400">{{ $post->updated_at?->diffForHumans() }}</div>
                                        </td>
                                        <td class="px-4 py-4">
                                            <div class="flex flex-wrap justify-end gap-2">
                                                <a href="{{ $this->postEditUrl($post) }}" class="inline-flex items-center gap-1.5 rounded-md border border-gray-300 px-3 py-1.5 text-sm font-medium text-gray-700 transition hover:bg-gray-50 dark:border-white/10 dark:text-gray-200 dark:hover:bg-white/5">
                                                    <x-filament::icon icon="heroicon-m-pencil-square" class="h-4 w-4" />
                                                    Ouvrir
                                                </a>
                                                <button
                                                    type="button"
                                                    wire:click="approvePost('{{ $post->id }}')"
                                                    wire:confirm="Publier cet article ?"
                                                    class="inline-flex items-center gap-1.5 rounded-md bg-emerald-600 px-3 py-1.5 text-sm font-medium text-white transition hover:bg-emerald-700"
                                                >
                                                    <x-filament::icon icon="heroicon-m-check-circle" class="h-4 w-4" />
                                                    Valider
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </x-filament::section>
    </div>
</x-filament::page>
