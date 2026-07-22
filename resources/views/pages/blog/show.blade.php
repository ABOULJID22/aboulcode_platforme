<!DOCTYPE html>
<html lang="{{ str_replace('_','-',app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $post->translation()?->title ?? $post->title }} · OrientationTech</title>
  @include('layouts.theme-init')
  @vite(['resources/css/app.css', 'resources/js/app.js'])

  @include('layouts.favicon')

</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100">
 @include('layouts.navbar')

  <main class="min-h-screen py-10 sm:py-14">
    <div class="max-w-5xl mx-auto px-6 lg:px-8">

      <!-- Fil d'Ariane -->
      <nav aria-label="{{ __('site.aria.breadcrumb') }}" class="mb-8 text-sm text-gray-500 dark:text-gray-400">
        <ol class="flex items-center gap-2">
          <li>
            <a href="{{ route('pages.blog.index') }}" class="link-underline-soft">
              {{ __('site.nav.blog') }}
            </a>
          </li>
          <li class="opacity-60">/</li>
          <li class="line-clamp-1">{{ $post->title }}</li>
        </ol>
      </nav>

      @php
        $shareHeading = __('site.blog.share.facebook');
        $shareHeading = $shareHeading === 'site.blog.share.facebook' ? 'Partager' : $shareHeading;
      @endphp
      <!-- Image principale -->
      @php
        $img = $post->cover_image ? Storage::url($post->cover_image) : asset('images/img1.jpg');
      @endphp
      <figure class="relative overflow-hidden rounded-[2.5rem] shadow-soft ring-1 ring-gray-200/70 dark:ring-gray-800/60 mb-12 group">
  <img src="{{ $img }}" alt="{{ $post->translation()?->title ?? $post->title }}" loading="lazy" decoding="async"
             class="w-full aspect-[21/9] object-cover transition-transform duration-500 group-hover:scale-[1.02]">
        <div class="pointer-events-none absolute inset-0 bg-gradient-to-t from-black/30 via-black/0 to-transparent"></div>
        @if($post->category)
          <figcaption class="absolute bottom-3 left-3 text-white/90 text-xs md:backdrop-blur-sm px-2 py-1 rounded">
            {{ $post->category->name }}
          </figcaption>
        @endif
      </figure>

      <section class="mb-10 space-y-4">
        <div class="flex flex-wrap items-center gap-3">
          @if($post->category)
            <a href="{{ route('pages.blog.index', ['category' => $post->category->slug]) }}" class="badge-pill">
              {{ $post->category->name }}
            </a>
          @endif

          @if(!empty($post->reading_time))
            <span class="stat-pill">
              {{ trans_choice('site.blog.reading_minutes', (int) $post->reading_time, ['count' => (int) $post->reading_time]) }}
            </span>
          @endif
        </div>

        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-gray-900 dark:text-white">
          {{ $post->translation()?->title ?? $post->title }}
        </h1>

        <div class="flex flex-wrap items-center gap-3 text-sm text-gray-600 dark:text-gray-300">
          <span class="inline-flex items-center gap-2">
            <svg class="h-4 w-4 text-primary-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
              <polyline points="6 9 12 15 18 9" />
              <path d="M19.5 12a7.5 7.5 0 1 1-15 0 7.5 7.5 0 0 1 15 0Z" />
            </svg>
            <span>{{ __('site.blog.Publishedon') }}</span>
            <span class="font-semibold text-gray-900 dark:text-white">{{ $post->published_at->format('F j, Y') }}</span>
          </span>
          <span class="stat-pill">{{ number_format((int) $post->views_count) }} vues</span>
          <span class="stat-pill">{{ number_format((int) $post->likes_count) }} likes</span>
          <span class="stat-pill">{{ number_format((int) $post->comments_count) }} commentaires</span>
          <span class="inline-flex items-center gap-2">
            @auth
              <form method="POST" action="{{ route('pages.blog.like', $post) }}" class="inline-flex">
                @csrf
                <button type="submit" aria-label="{{ $likedByCurrentUser ? 'Retirer mon like' : 'Aimer cet article' }}" title="{{ $likedByCurrentUser ? 'Retirer mon like' : 'Aimer cet article' }}" class="flex h-10 w-10 items-center justify-center rounded-full border p-0 leading-none shadow-sm transition hover:-translate-y-0.5 hover:shadow-md {{ $likedByCurrentUser ? 'border-red-500 bg-red-50 text-red-600 dark:bg-red-500/10 dark:text-red-300' : 'border-[#bfdbfe] bg-white text-gray-700 hover:border-red-300 hover:text-red-600 dark:border-white/10 dark:bg-gray-800 dark:text-gray-200 dark:hover:text-red-300' }}">
                  <svg class="block h-5 w-5 shrink-0" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M12 21s-7.2-4.55-9.45-9.15C.78 8.23 2.4 4.5 6.25 4.5c2.08 0 3.55 1.1 4.42 2.27.28.38.78.38 1.06 0C12.6 5.6 14.07 4.5 16.15 4.5c3.85 0 5.47 3.73 3.7 7.35C17.6 16.45 12 21 12 21Z" fill="{{ $likedByCurrentUser ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
                </button>
              </form>
              <form method="POST" action="{{ route('pages.blog.favorite', $post) }}" class="inline-flex">
                @csrf
                <button type="submit" aria-label="{{ $favoritedByCurrentUser ? 'Retirer des favoris' : 'Sauvegarder cet article' }}" title="{{ $favoritedByCurrentUser ? 'Retirer des favoris' : 'Sauvegarder cet article' }}" class="flex h-10 w-10 items-center justify-center rounded-full border p-0 leading-none shadow-sm transition hover:-translate-y-0.5 hover:shadow-md {{ $favoritedByCurrentUser ? 'border-[#2563eb] bg-[#eff6ff] text-[#2563eb] dark:bg-blue-500/10 dark:text-blue-300' : 'border-[#bfdbfe] bg-white text-gray-700 hover:border-[#93c5fd] hover:text-[#2563eb] dark:border-white/10 dark:bg-gray-800 dark:text-gray-200 dark:hover:text-blue-300' }}">
                  <svg class="block h-5 w-5 shrink-0" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M6.5 4.75A2.25 2.25 0 0 1 8.75 2.5h6.5a2.25 2.25 0 0 1 2.25 2.25v16.1a.65.65 0 0 1-1.02.53L12 18.25l-4.48 3.13a.65.65 0 0 1-1.02-.53V4.75Z" fill="{{ $favoritedByCurrentUser ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" />
                  </svg>
                </button>
              </form>
            @else
              <a href="{{ route('login') }}" aria-label="Se connecter pour aimer" title="Se connecter pour aimer" class="flex h-10 w-10 items-center justify-center rounded-full border border-[#bfdbfe] bg-white p-0 leading-none text-gray-700 shadow-sm transition hover:-translate-y-0.5 hover:border-red-300 hover:text-red-600 hover:shadow-md dark:border-white/10 dark:bg-gray-800 dark:text-gray-200 dark:hover:text-red-300">
                <svg class="block h-5 w-5 shrink-0" viewBox="0 0 24 24" aria-hidden="true">
                  <path d="M12 21s-7.2-4.55-9.45-9.15C.78 8.23 2.4 4.5 6.25 4.5c2.08 0 3.55 1.1 4.42 2.27.28.38.78.38 1.06 0C12.6 5.6 14.07 4.5 16.15 4.5c3.85 0 5.47 3.73 3.7 7.35C17.6 16.45 12 21 12 21Z" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
              </a>
              <a href="{{ route('login') }}" aria-label="Se connecter pour sauvegarder" title="Se connecter pour sauvegarder" class="flex h-10 w-10 items-center justify-center rounded-full border border-[#bfdbfe] bg-white p-0 leading-none text-gray-700 shadow-sm transition hover:-translate-y-0.5 hover:border-[#93c5fd] hover:text-[#2563eb] hover:shadow-md dark:border-white/10 dark:bg-gray-800 dark:text-gray-200 dark:hover:text-blue-300">
                <svg class="block h-5 w-5 shrink-0" viewBox="0 0 24 24" aria-hidden="true">
                  <path d="M6.5 4.75A2.25 2.25 0 0 1 8.75 2.5h6.5a2.25 2.25 0 0 1 2.25 2.25v16.1a.65.65 0 0 1-1.02.53L12 18.25l-4.48 3.13a.65.65 0 0 1-1.02-.53V4.75Z" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" />
                </svg>
              </a>
            @endauth
          </span>
        </div>

        <div class="hidden">
          @auth
            <form method="POST" action="{{ route('pages.blog.like', $post) }}">
              @csrf
              <button
                type="submit"
                aria-label="{{ $likedByCurrentUser ? 'Retirer mon like' : 'Aimer cet article' }}"
                title="{{ $likedByCurrentUser ? 'Retirer mon like' : 'Aimer cet article' }}"
                class="group inline-flex items-center gap-3 rounded-full border px-4 py-2 text-sm font-bold shadow-sm transition hover:-translate-y-0.5 hover:shadow-md {{ $likedByCurrentUser ? 'border-red-500 bg-red-50 text-red-600 dark:bg-red-500/10 dark:text-red-300' : 'border-[#bfdbfe] bg-white text-gray-700 hover:border-red-300 hover:text-red-600 dark:border-white/10 dark:bg-gray-800 dark:text-gray-200 dark:hover:text-red-300' }}"
              >
                <span class="grid h-10 w-10 place-items-center rounded-full {{ $likedByCurrentUser ? 'bg-red-500 text-white' : 'bg-[#eff6ff] text-gray-500 group-hover:bg-red-50 group-hover:text-red-500 dark:bg-white/10' }} transition">
                  <svg class="h-6 w-6 transition duration-200 group-hover:scale-110 {{ $likedByCurrentUser ? 'scale-110' : '' }}" viewBox="0 0 24 24" aria-hidden="true">
                    <path
                      d="M12 21s-7.2-4.55-9.45-9.15C.78 8.23 2.4 4.5 6.25 4.5c2.08 0 3.55 1.1 4.42 2.27.28.38.78.38 1.06 0C12.6 5.6 14.07 4.5 16.15 4.5c3.85 0 5.47 3.73 3.7 7.35C17.6 16.45 12 21 12 21Z"
                      fill="{{ $likedByCurrentUser ? 'currentColor' : 'none' }}"
                      stroke="currentColor"
                      stroke-width="1.8"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                    />
                  </svg>
                </span>
                <span class="leading-tight">
                  {{ $likedByCurrentUser ? 'Aimé' : 'Aimer' }}
                  <span class="block text-xs font-semibold opacity-70">{{ number_format((int) $post->likes_count) }} likes</span>
                </span>
              </button>
            </form>
            <form method="POST" action="{{ route('pages.blog.favorite', $post) }}" class="mt-3">
              @csrf
              <button
                type="submit"
                aria-label="{{ $favoritedByCurrentUser ? 'Retirer des favoris' : 'Sauvegarder cet article' }}"
                title="{{ $favoritedByCurrentUser ? 'Retirer des favoris' : 'Sauvegarder cet article' }}"
                class="flex h-12 w-12 items-center justify-center rounded-full border p-0 leading-none shadow-sm transition hover:-translate-y-0.5 hover:shadow-md {{ $favoritedByCurrentUser ? 'border-[#2563eb] bg-[#eff6ff] text-[#2563eb] dark:bg-blue-500/10 dark:text-blue-300' : 'border-[#bfdbfe] bg-white text-gray-700 hover:border-[#93c5fd] hover:text-[#2563eb] dark:border-white/10 dark:bg-gray-800 dark:text-gray-200 dark:hover:text-blue-300' }}"
              >
                <svg class="block h-6 w-6 shrink-0" viewBox="0 0 24 24" aria-hidden="true">
                  <path d="M6.5 4.75A2.25 2.25 0 0 1 8.75 2.5h6.5a2.25 2.25 0 0 1 2.25 2.25v16.1a.65.65 0 0 1-1.02.53L12 18.25l-4.48 3.13a.65.65 0 0 1-1.02-.53V4.75Z" fill="{{ $favoritedByCurrentUser ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round" />
                </svg>
              </button>
            </form>
          @else
            <a href="{{ route('login') }}" class="inline-flex items-center rounded-full bg-[#2563eb] px-5 py-2 text-sm font-bold text-white shadow-sm hover:bg-[#1d4ed8]">
              Connecte-toi pour aimer et commenter
            </a>
          @endauth
        </div>
      </section>

      <!-- Contenu -->
      @php
        $content = $post->translation()?->content ?? $post->content;
      @endphp
      @if($content)
        @php
          $renderedContent = \Filament\Forms\Components\RichEditor\RichContentRenderer::make($content)->toHtml();
        @endphp
        <article class="prose prose-slate dark:prose-invert fi-prose max-w-none prose-headings:scroll-mt-24">
          {!! $renderedContent !!}
        </article>
      @else
        <div class="bg-gray-100 dark:bg-gray-800 rounded-2xl p-8 text-center">
          <p class="text-gray-500 dark:text-white italic">
            {{ __('site.blog.no_content') }}
          </p>
        </div>
      @endif

      <!-- Tags (activer si relation tags existe) -->
      @isset($post->tags)
        @if($post->tags->count())
          <div class="mt-10 flex flex-wrap gap-2">
            @foreach ($post->tags as $tag)
              <a href="{{ route('pages.blog.index', ['search' => $tag->name]) }}"
                 class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold bg-gray-100 text-gray-700 hover:bg-primary-500 hover:text-white transition-colors dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-primary-400">
                #{{ $tag->name }}
              </a>
            @endforeach
          </div>
        @endif
      @endisset

      <section
        x-data="{
          deleteModalOpen: false,
          deleteForm: null,
          deleteTitle: '',
          deleteMessage: '',
          openDeleteModal(form, title, message) {
            this.deleteForm = form;
            this.deleteTitle = title;
            this.deleteMessage = message;
            this.deleteModalOpen = true;
          },
          confirmDelete() {
            if (this.deleteForm) {
              this.deleteForm.submit();
            }
          }
        }"
        x-on:keydown.escape.window="deleteModalOpen = false"
        class="mt-12 rounded-2xl bg-white p-5 shadow-sm ring-1 ring-gray-200 sm:p-6 dark:bg-gray-800 dark:ring-white/10"
      >
        <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
          <div>
            <h2 class="mb-0 text-2xl font-bold text-gray-950 dark:text-white">Commentaires</h2>
            <p class="mb-0 mt-1 text-sm text-gray-500 dark:text-gray-400">Pose une question, partage ton avis ou reponds a un autre eleve.</p>
          </div>
          <span class="inline-flex w-fit items-center rounded-full bg-[#eff6ff] px-3 py-1 text-sm font-bold text-[#2563eb] dark:bg-blue-500/10 dark:text-blue-200">
            {{ number_format((int) $post->comments_count) }}
          </span>
        </div>

        @if(session('success'))
          <div class="mb-5 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-700 dark:border-emerald-500/20 dark:bg-emerald-500/10 dark:text-emerald-300">
            {{ session('success') }}
          </div>
        @endif

        @auth
          @php
            $currentUserName = auth()->user()?->name ?? 'Utilisateur';
            $currentUserInitials = strtoupper(collect(preg_split('/\s+/', trim($currentUserName), -1, PREG_SPLIT_NO_EMPTY))->map(fn ($part) => mb_substr($part, 0, 1))->take(2)->implode('')) ?: 'U';
          @endphp
          <form method="POST" action="{{ route('pages.blog.comments.store', $post) }}" class="mb-8 rounded-lg border border-gray-200 bg-gray-50/70 p-4 dark:border-white/10 dark:bg-gray-900/60">
            @csrf
            <div class="flex gap-3">
              <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-[#2563eb] text-sm font-extrabold text-white shadow-sm">
                {{ $currentUserInitials }}
              </div>
              <div class="min-w-0 flex-1">
                <label for="comment-content" class="sr-only">Ajouter un commentaire</label>
                <textarea id="comment-content" name="content" rows="4" required maxlength="2000" class="min-h-28 w-full resize-y rounded-lg border border-gray-200 bg-white p-4 text-sm leading-6 text-gray-900 shadow-sm transition focus:border-[#2563eb] focus:outline-none focus:ring-4 focus:ring-[#2563eb]/10 dark:border-white/10 dark:bg-gray-800 dark:text-white" placeholder="Ecris ton commentaire...">{{ old('content') }}</textarea>
                @error('content')<p class="mb-0 mt-2 text-sm text-red-600">{{ $message }}</p>@enderror
                <div class="mt-3 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                  <p class="mb-0 text-xs font-medium text-gray-500 dark:text-gray-400">Session : {{ $currentUserName }}</p>
                  <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-lg bg-[#2563eb] px-4 py-2.5 text-sm font-bold text-white shadow-sm transition hover:bg-[#1d4ed8] focus:outline-none focus:ring-4 focus:ring-[#2563eb]/20">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                      <path d="m22 2-7 20-4-9-9-4 20-7Z" />
                      <path d="M22 2 11 13" />
                    </svg>
                    Publier
                  </button>
                </div>
              </div>
            </div>
          </form>
        @else
          <div class="mb-8 rounded-lg border border-[#bfdbfe] bg-[#eff6ff] p-4 text-sm font-semibold text-[#1e40af] dark:border-blue-400/20 dark:bg-blue-500/10 dark:text-blue-200">
            Connecte-toi pour ajouter un commentaire ou repondre.
          </div>
        @endauth

        <div class="space-y-4">
          @forelse($comments as $comment)
            @php
              $commentAuthor = $comment->user?->name ?? 'Utilisateur';
              $commentInitials = strtoupper(collect(preg_split('/\s+/', trim($commentAuthor), -1, PREG_SPLIT_NO_EMPTY))->map(fn ($part) => mb_substr($part, 0, 1))->take(2)->implode('')) ?: 'U';
            @endphp
            <article x-data="{ panel: null }" class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm transition hover:border-[#bfdbfe] hover:shadow-md dark:border-white/10 dark:bg-gray-900/50 dark:hover:border-blue-400/30">
              <div class="flex gap-3">
                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-[#eff6ff] text-sm font-extrabold text-[#2563eb] ring-1 ring-[#bfdbfe] dark:bg-blue-500/10 dark:text-blue-200 dark:ring-blue-400/20">
                  {{ $commentInitials }}
                </div>
                <div class="min-w-0 flex-1">
                  <div class="flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between">
                    <p class="mb-0 text-sm font-extrabold text-gray-950 dark:text-white">{{ $commentAuthor }}</p>
                    <time datetime="{{ $comment->created_at?->toIso8601String() }}" class="text-xs font-medium text-gray-500 dark:text-gray-400" title="{{ $comment->created_at?->format('d/m/Y H:i') }}">
                      {{ $comment->created_at?->diffForHumans() }}
                    </time>
                  </div>

                  <p class="mb-0 mt-3 whitespace-pre-line text-[15px] leading-7 text-gray-700 dark:text-gray-200">{{ $comment->content }}</p>

                  @auth
                    <div class="mt-4 flex flex-wrap items-center gap-2 border-t border-gray-100 pt-3 dark:border-white/10">
                      <button type="button" x-on:click="panel = panel === 'reply' ? null : 'reply'" class="inline-flex items-center gap-2 rounded-full px-3 py-2 text-sm font-bold text-[#2563eb] transition hover:bg-[#eff6ff] dark:text-blue-200 dark:hover:bg-blue-500/10">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                          <path d="M21 15a4 4 0 0 1-4 4H8l-5 3V7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4v8Z" />
                        </svg>
                        Repondre
                      </button>

                      @if(auth()->id() === $comment->user_id || auth()->user()?->isSuperAdmin())
                        <button type="button" x-on:click="panel = panel === 'edit' ? null : 'edit'" class="inline-flex items-center gap-2 rounded-full px-3 py-2 text-sm font-bold text-gray-700 transition hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-white/10">
                          <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M12 20h9" />
                            <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5Z" />
                          </svg>
                          Modifier
                        </button>
                      @endif

                      @if(auth()->id() !== $comment->user_id)
                        <button type="button" x-on:click="panel = panel === 'report' ? null : 'report'" class="inline-flex items-center gap-2 rounded-full px-3 py-2 text-sm font-bold text-amber-700 transition hover:bg-amber-50 dark:text-amber-300 dark:hover:bg-amber-500/10">
                          <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V4s-1 1-4 1-5-2-8-2-4 1-4 1v18" />
                          </svg>
                          Signaler
                        </button>
                      @endif

                      @if(auth()->id() === $comment->user_id || auth()->user()?->isSuperAdmin() || (auth()->user()?->isTeacher() && $post->author_id === auth()->id()))
                        <form method="POST" action="{{ route('pages.blog.comments.delete', $comment) }}" class="inline-flex">
                          @csrf
                          @method('DELETE')
                          <button
                            type="button"
                            x-on:click="openDeleteModal($el.closest('form'), 'Supprimer ce commentaire ?', 'Cette action est definitive. Le commentaire sera retire de la discussion.')"
                            class="inline-flex items-center gap-2 rounded-full px-3 py-2 text-sm font-bold text-red-600 transition hover:bg-red-50 dark:text-red-300 dark:hover:bg-red-500/10"
                          >
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                              <path d="M3 6h18" />
                              <path d="M8 6V4h8v2" />
                              <path d="M19 6 18 20H6L5 6" />
                              <path d="M10 11v5" />
                              <path d="M14 11v5" />
                            </svg>
                            Supprimer
                          </button>
                        </form>
                      @endif
                    </div>

                    <div class="mt-3 space-y-3">
                      <form x-cloak x-show="panel === 'reply'" x-transition method="POST" action="{{ route('pages.blog.comments.store', $post) }}" class="rounded-lg border border-[#bfdbfe] bg-[#eff6ff]/70 p-3 dark:border-blue-400/20 dark:bg-blue-500/10">
                        @csrf
                        <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                        <label for="reply-{{ $comment->id }}" class="sr-only">Repondre a {{ $commentAuthor }}</label>
                        <textarea id="reply-{{ $comment->id }}" name="content" rows="3" required maxlength="2000" class="w-full resize-y rounded-lg border border-gray-200 bg-white p-3 text-sm leading-6 text-gray-900 shadow-sm focus:border-[#2563eb] focus:outline-none focus:ring-4 focus:ring-[#2563eb]/10 dark:border-white/10 dark:bg-gray-800 dark:text-white" placeholder="Ecris une reponse..."></textarea>
                        <div class="mt-3 flex justify-end gap-2">
                          <button type="button" x-on:click="panel = null" class="rounded-lg px-3 py-2 text-sm font-bold text-gray-600 transition hover:bg-white dark:text-gray-300 dark:hover:bg-white/10">Annuler</button>
                          <button type="submit" class="rounded-lg bg-[#2563eb] px-4 py-2 text-sm font-bold text-white transition hover:bg-[#1d4ed8]">Envoyer</button>
                        </div>
                      </form>

                      @if(auth()->id() === $comment->user_id || auth()->user()?->isSuperAdmin())
                        <form x-cloak x-show="panel === 'edit'" x-transition method="POST" action="{{ route('pages.blog.comments.update', $comment) }}" class="rounded-lg border border-gray-200 bg-gray-50 p-3 dark:border-white/10 dark:bg-gray-800">
                          @csrf
                          @method('PATCH')
                          <label for="edit-comment-{{ $comment->id }}" class="sr-only">Modifier le commentaire</label>
                          <textarea id="edit-comment-{{ $comment->id }}" name="content" rows="3" required maxlength="2000" class="w-full resize-y rounded-lg border border-gray-200 bg-white p-3 text-sm leading-6 text-gray-900 shadow-sm focus:border-[#2563eb] focus:outline-none focus:ring-4 focus:ring-[#2563eb]/10 dark:border-white/10 dark:bg-gray-900 dark:text-white">{{ $comment->content }}</textarea>
                          <div class="mt-3 flex justify-end gap-2">
                            <button type="button" x-on:click="panel = null" class="rounded-lg px-3 py-2 text-sm font-bold text-gray-600 transition hover:bg-white dark:text-gray-300 dark:hover:bg-white/10">Annuler</button>
                            <button type="submit" class="rounded-lg bg-gray-950 px-4 py-2 text-sm font-bold text-white transition hover:bg-gray-800 dark:bg-white dark:text-gray-950 dark:hover:bg-gray-200">Enregistrer</button>
                          </div>
                        </form>
                      @endif

                      @if(auth()->id() !== $comment->user_id)
                        <form x-cloak x-show="panel === 'report'" x-transition method="POST" action="{{ route('pages.blog.comments.report', $comment) }}" class="rounded-lg border border-amber-200 bg-amber-50 p-3 dark:border-amber-400/20 dark:bg-amber-500/10">
                          @csrf
                          <label for="report-comment-{{ $comment->id }}" class="sr-only">Motif du signalement</label>
                          <input id="report-comment-{{ $comment->id }}" name="reason" required maxlength="120" class="w-full rounded-lg border border-amber-200 bg-white p-3 text-sm text-gray-900 shadow-sm focus:border-amber-500 focus:outline-none focus:ring-4 focus:ring-amber-500/10 dark:border-amber-400/20 dark:bg-gray-900 dark:text-white" placeholder="Motif du signalement">
                          <textarea name="details" rows="2" maxlength="1000" class="mt-2 w-full resize-y rounded-lg border border-amber-200 bg-white p-3 text-sm text-gray-900 shadow-sm focus:border-amber-500 focus:outline-none focus:ring-4 focus:ring-amber-500/10 dark:border-amber-400/20 dark:bg-gray-900 dark:text-white" placeholder="Details optionnels"></textarea>
                          <div class="mt-3 flex justify-end gap-2">
                            <button type="button" x-on:click="panel = null" class="rounded-lg px-3 py-2 text-sm font-bold text-amber-800 transition hover:bg-white dark:text-amber-200 dark:hover:bg-white/10">Annuler</button>
                            <button type="submit" class="rounded-lg bg-amber-600 px-4 py-2 text-sm font-bold text-white transition hover:bg-amber-700">Envoyer</button>
                          </div>
                        </form>
                      @endif
                    </div>
                  @endauth
                </div>
              </div>

              @if($comment->replies->count())
                <div class="mt-5 space-y-3 border-l border-[#bfdbfe] pl-4 sm:ml-5 sm:pl-6 dark:border-blue-400/30">
                  @foreach($comment->replies as $reply)
                    @php
                      $replyAuthor = $reply->user?->name ?? 'Utilisateur';
                      $replyInitials = strtoupper(collect(preg_split('/\s+/', trim($replyAuthor), -1, PREG_SPLIT_NO_EMPTY))->map(fn ($part) => mb_substr($part, 0, 1))->take(2)->implode('')) ?: 'U';
                    @endphp
                    <article x-data="{ panel: null }" class="rounded-lg bg-gray-50 p-3 ring-1 ring-gray-100 dark:bg-gray-800/80 dark:ring-white/10">
                      <div class="flex gap-3">
                        <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-white text-xs font-extrabold text-[#2563eb] ring-1 ring-[#bfdbfe] dark:bg-gray-900 dark:text-blue-200 dark:ring-blue-400/20">
                          {{ $replyInitials }}
                        </div>
                        <div class="min-w-0 flex-1">
                          <div class="flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between">
                            <p class="mb-0 text-sm font-bold text-gray-950 dark:text-white">{{ $replyAuthor }}</p>
                            <time datetime="{{ $reply->created_at?->toIso8601String() }}" class="text-xs font-medium text-gray-500 dark:text-gray-400" title="{{ $reply->created_at?->format('d/m/Y H:i') }}">
                              {{ $reply->created_at?->diffForHumans() }}
                            </time>
                          </div>
                          <p class="mb-0 mt-2 whitespace-pre-line text-sm leading-6 text-gray-700 dark:text-gray-200">{{ $reply->content }}</p>

                          @auth
                            <div class="mt-3 flex flex-wrap items-center gap-2">
                              @if(auth()->id() === $reply->user_id || auth()->user()?->isSuperAdmin())
                                <button type="button" x-on:click="panel = panel === 'edit' ? null : 'edit'" class="inline-flex items-center gap-1.5 rounded-full px-2.5 py-1.5 text-xs font-bold text-gray-700 transition hover:bg-white dark:text-gray-200 dark:hover:bg-white/10">
                                  <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M12 20h9" />
                                    <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4 12.5-12.5Z" />
                                  </svg>
                                  Modifier
                                </button>
                              @endif

                              @if(auth()->id() !== $reply->user_id)
                                <button type="button" x-on:click="panel = panel === 'report' ? null : 'report'" class="inline-flex items-center gap-1.5 rounded-full px-2.5 py-1.5 text-xs font-bold text-amber-700 transition hover:bg-amber-50 dark:text-amber-300 dark:hover:bg-amber-500/10">
                                  <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M4 15s1-1 4-1 5 2 8 2 4-1 4-1V4s-1 1-4 1-5-2-8-2-4 1-4 1v18" />
                                  </svg>
                                  Signaler
                                </button>
                              @endif

                              @if(auth()->id() === $reply->user_id || auth()->user()?->isSuperAdmin() || (auth()->user()?->isTeacher() && $post->author_id === auth()->id()))
                                <form method="POST" action="{{ route('pages.blog.comments.delete', $reply) }}" class="inline-flex">
                                  @csrf
                                  @method('DELETE')
                                  <button
                                    type="button"
                                    x-on:click="openDeleteModal($el.closest('form'), 'Supprimer cette reponse ?', 'Cette action est definitive. La reponse sera retiree de la discussion.')"
                                    class="inline-flex items-center gap-1.5 rounded-full px-2.5 py-1.5 text-xs font-bold text-red-600 transition hover:bg-red-50 dark:text-red-300 dark:hover:bg-red-500/10"
                                  >
                                    <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                      <path d="M3 6h18" />
                                      <path d="M8 6V4h8v2" />
                                      <path d="M19 6 18 20H6L5 6" />
                                    </svg>
                                    Supprimer
                                  </button>
                                </form>
                              @endif
                            </div>

                            <div class="mt-3 space-y-3">
                              @if(auth()->id() === $reply->user_id || auth()->user()?->isSuperAdmin())
                                <form x-cloak x-show="panel === 'edit'" x-transition method="POST" action="{{ route('pages.blog.comments.update', $reply) }}" class="rounded-lg border border-gray-200 bg-white p-3 dark:border-white/10 dark:bg-gray-900">
                                  @csrf
                                  @method('PATCH')
                                  <label for="edit-reply-{{ $reply->id }}" class="sr-only">Modifier la reponse</label>
                                  <textarea id="edit-reply-{{ $reply->id }}" name="content" rows="2" required maxlength="2000" class="w-full resize-y rounded-lg border border-gray-200 bg-white p-3 text-sm leading-6 text-gray-900 shadow-sm focus:border-[#2563eb] focus:outline-none focus:ring-4 focus:ring-[#2563eb]/10 dark:border-white/10 dark:bg-gray-800 dark:text-white">{{ $reply->content }}</textarea>
                                  <div class="mt-3 flex justify-end gap-2">
                                    <button type="button" x-on:click="panel = null" class="rounded-lg px-3 py-2 text-xs font-bold text-gray-600 transition hover:bg-gray-50 dark:text-gray-300 dark:hover:bg-white/10">Annuler</button>
                                    <button type="submit" class="rounded-lg bg-gray-950 px-3 py-2 text-xs font-bold text-white transition hover:bg-gray-800 dark:bg-white dark:text-gray-950 dark:hover:bg-gray-200">Enregistrer</button>
                                  </div>
                                </form>
                              @endif

                              @if(auth()->id() !== $reply->user_id)
                                <form x-cloak x-show="panel === 'report'" x-transition method="POST" action="{{ route('pages.blog.comments.report', $reply) }}" class="rounded-lg border border-amber-200 bg-amber-50 p-3 dark:border-amber-400/20 dark:bg-amber-500/10">
                                  @csrf
                                  <label for="report-reply-{{ $reply->id }}" class="sr-only">Motif du signalement</label>
                                  <input id="report-reply-{{ $reply->id }}" name="reason" required maxlength="120" class="w-full rounded-lg border border-amber-200 bg-white p-3 text-sm text-gray-900 shadow-sm focus:border-amber-500 focus:outline-none focus:ring-4 focus:ring-amber-500/10 dark:border-amber-400/20 dark:bg-gray-900 dark:text-white" placeholder="Motif du signalement">
                                  <div class="mt-3 flex justify-end gap-2">
                                    <button type="button" x-on:click="panel = null" class="rounded-lg px-3 py-2 text-xs font-bold text-amber-800 transition hover:bg-white dark:text-amber-200 dark:hover:bg-white/10">Annuler</button>
                                    <button type="submit" class="rounded-lg bg-amber-600 px-3 py-2 text-xs font-bold text-white transition hover:bg-amber-700">Envoyer</button>
                                  </div>
                                </form>
                              @endif
                            </div>
                          @endauth
                        </div>
                      </div>
                    </article>
                  @endforeach
                </div>
              @endif
            </article>
          @empty
            <p class="mb-0 rounded-lg border border-dashed border-gray-200 bg-gray-50 p-6 text-center text-sm font-medium text-gray-500 dark:border-white/10 dark:bg-gray-900 dark:text-gray-400">Aucun commentaire pour le moment.</p>
          @endforelse
        </div>

        <div
          x-cloak
          x-show="deleteModalOpen"
          x-transition.opacity
          x-on:click.self="deleteModalOpen = false"
          class="fixed inset-0 z-[80] flex items-center justify-center bg-slate-950/60 px-4 py-6 backdrop-blur-sm"
          role="dialog"
          aria-modal="true"
          aria-labelledby="delete-comment-title"
        >
          <div
            x-show="deleteModalOpen"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="scale-95 opacity-0"
            x-transition:enter-end="scale-100 opacity-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="scale-100 opacity-100"
            x-transition:leave-end="scale-95 opacity-0"
            class="w-full max-w-md rounded-2xl bg-white p-5 shadow-2xl ring-1 ring-red-100 dark:bg-gray-900 dark:ring-red-500/20"
          >
            <div class="flex items-start gap-4">
              <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-red-50 text-red-600 ring-1 ring-red-100 dark:bg-red-500/10 dark:text-red-300 dark:ring-red-500/20">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                  <path d="M12 9v4" />
                  <path d="M12 17h.01" />
                  <path d="M10.3 3.6 2.5 18a2 2 0 0 0 1.75 3h15.5a2 2 0 0 0 1.75-3L13.7 3.6a2 2 0 0 0-3.4 0Z" />
                </svg>
              </div>
              <div class="min-w-0 flex-1">
                <h3 id="delete-comment-title" class="mb-0 text-lg font-extrabold text-gray-950 dark:text-white" x-text="deleteTitle"></h3>
                <p class="mb-0 mt-2 text-sm leading-6 text-gray-600 dark:text-gray-300" x-text="deleteMessage"></p>
              </div>
            </div>

            <div class="mt-6 flex flex-col-reverse gap-2 sm:flex-row sm:justify-end">
              <button
                type="button"
                x-on:click="deleteModalOpen = false"
                class="inline-flex items-center justify-center rounded-lg border border-gray-200 bg-white px-4 py-2.5 text-sm font-bold text-gray-700 transition hover:bg-gray-50 dark:border-white/10 dark:bg-gray-900 dark:text-gray-200 dark:hover:bg-white/10"
              >
                Annuler
              </button>
              <button
                type="button"
                x-on:click="confirmDelete()"
                class="inline-flex items-center justify-center rounded-lg bg-red-600 px-4 py-2.5 text-sm font-bold text-white shadow-sm transition hover:bg-red-700 focus:outline-none focus:ring-4 focus:ring-red-500/20"
              >
                Supprimer
              </button>
            </div>
          </div>
        </div>
      </section>

      <!-- Partage -->
      @php $url = route('pages.blog.show', $post); @endphp
      <div class="mt-12 border-t border-gray-200/60 dark:border-gray-800/70 pt-8">
        <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
          <a href="{{ route('pages.blog.index') }}" class="link-underline-soft text-sm text-gray-600 dark:text-gray-300">
            ← {{ __('site.nav.blog') }}
          </a>

          <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:gap-5">
            <span class="uppercase tracking-[0.2em] text-xs text-gray-500 dark:text-gray-400">{{ $shareHeading }}</span>
            <div class="flex flex-wrap gap-2 sm:gap-3">
             <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode($url) }}&text={{ urlencode($post->title) }}"
                 target="_blank" rel="noopener"
                 class="share-button bg-[#1da1f2] text-white w-full sm:w-auto">
                LinkedIn
              </a>
              <a href="https://twitter.com/intent/tweet?url={{ urlencode($url) }}&text={{ urlencode($post->title) }}"
                 target="_blank" rel="noopener"
                 class="share-button bg-[#1da1f2] text-white w-full sm:w-auto">
                X 
              </a>
              <a href="mailto:?subject={{ rawurlencode($post->title) }}&body={{ rawurlencode($url) }}"
                 class="share-button bg-primary-500/10 text-black dark:text-white dark:hover:text-white w-full sm:w-auto">
                {{ __('site.blog.share.email') }}
              </a>
              <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($url) }}"
                 target="_blank" rel="noopener"
                 class="share-button bg-[#3b5998] text-white w-full sm:w-auto">
                Facebook
              </a>
              <button type="button"
                x-data="{ copied: false }"
                x-on:click="navigator.clipboard.writeText('{{ $url }}').then(() => { copied = true; setTimeout(() => copied = false, 2000) })"
                class="share-button bg-gray-100 text-gray-800 hover:bg-primary-500 hover:text-[#4c51bf] dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-primary-500 w-full sm:w-auto">
                {{ __('site.blog.share.copy_link') }}
                <span x-show="copied" x-transition class="ml-2 inline-block text-sm text-green-600 dark:text-green-400" aria-live="polite">✔︎</span>
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- Navigation précédent / suivant -->
      <nav class="mt-14 grid gap-4 sm:grid-cols-2">
        @if($prev)
          <a href="{{ route('pages.blog.show', $prev) }}"
             class="group rounded-2xl border border-gray-200/70 dark:border-gray-800/60 p-5 hover:bg-gray-50 dark:hover:bg-gray-900 transition-colors">
            <div class="text-xs text-gray-500 dark:text-gray-400 mb-1">{{ __('site.blog.previous') }}</div>
            <div class="font-semibold text-gray-900 dark:text-white line-clamp-2 group-hover:text-primary-500 dark:group-hover:text-primary-300">
              {{ $prev->title }}
            </div>
          </a>
        @endif

        @if($next)
          <a href="{{ route('pages.blog.show', $next) }}"
             class="group rounded-2xl border border-gray-200/70 dark:border-gray-800/60 p-5 hover:bg-gray-50 dark:hover:bg-gray-900 transition-colors text-right">
            <div class="text-xs text-gray-500 dark:text-gray-400 mb-1">{{ __('site.blog.next') }}</div>
            <div class="font-semibold text-gray-900 dark:text-white line-clamp-2 group-hover:text-primary-500 dark:group-hover:text-primary-300">
              {{ $next->title }}
            </div>
          </a>
        @endif
      </nav>

      <!-- Articles récents -->
      @if($recent->count())
        <section class="mt-16">
          <h2 class="text-2xl sm:text-3xl font-bold mb-6 text-gray-900 dark:text-white">{{ __('site.blog.recent') }}</h2>
          <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ($recent as $r)
              @php $rimg = $r->cover_image ? Storage::url($r->cover_image) : asset('images/img1.jpg'); @endphp
              <a href="{{ route('pages.blog.show', $r) }}"
                 class="group bg-white dark:bg-gray-800 rounded-2xl shadow ring-1 ring-gray-200/70 dark:ring-gray-800/60 hover:shadow-lg transition-all overflow-hidden">
                <img src="{{ $rimg }}" loading="lazy" decoding="async" class="w-full object-cover transition-transform duration-300 group-hover:scale-[1.03]" alt="{{ $r->title }}">
                <div class="p-4">
                  <h3 class="text-base font-semibold text-gray-900 dark:text-white line-clamp-2 group-hover:text-primary-500 dark:group-hover:text-primary-300">
                    {{ $r->title }}
                  </h3>
                </div>
              </a>
            @endforeach
          </div>
        </section>
      @endif

    </div>
  </main>

  @include('layouts.footer')
</body>
</html>
