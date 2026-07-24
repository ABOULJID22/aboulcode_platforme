<?php

namespace App\Http\Controllers;

use App\Models\Noservice;
use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\View\View;

class GlobalSearchController extends Controller
{
    public function __invoke(Request $request): View
    {
        $query = $this->normalizeQuery((string) $request->query('q', ''));
        $hasQuery = mb_strlen($query) >= 2;

        $sections = collect([
            'posts' => [
                'label' => 'Articles',
                'description' => 'Conseils, actualites et guides ABOULCODE.',
                'items' => collect(),
            ],
            'resources' => [
                'label' => 'Ressources',
                'description' => 'PDF, videos, guides et contenus pedagogiques.',
                'items' => collect(),
            ],
            'services' => [
                'label' => 'Services',
                'description' => 'Accompagnement et parcours ABOULCODE.',
                'items' => collect(),
            ],
            'pages' => [
                'label' => 'Pages',
                'description' => 'Acces rapide aux pages principales.',
                'items' => collect(),
            ],
        ]);

        if ($hasQuery) {
            $sections = $sections->replace([
                'posts' => array_merge($sections['posts'], ['items' => $this->searchPosts($query)]),
                'resources' => array_merge($sections['resources'], ['items' => $this->searchResources($query)]),
                'services' => array_merge($sections['services'], ['items' => $this->searchServices($query)]),
                'pages' => array_merge($sections['pages'], ['items' => $this->searchStaticPages($query)]),
            ]);
        }

        $totalResults = $sections->sum(fn (array $section): int => $section['items']->count());
        $quickLinks = collect([
            ['label' => 'Blog', 'url' => route('pages.blog.index')],
            ['label' => 'Services', 'url' => route('noservices')],
            ['label' => 'Contact', 'url' => route('contact.create')],
        ]);

        return view('pages.search', [
            'query' => $query,
            'hasQuery' => $hasQuery,
            'sections' => $sections,
            'totalResults' => $totalResults,
            'quickLinks' => $quickLinks,
        ]);
    }

    private function searchPosts(string $term): Collection
    {
        if (! Schema::hasTable('posts')) {
            return collect();
        }

        $columns = $this->existingColumns('posts', ['title', 'excerpt', 'content', 'seo_title', 'seo_description']);

        return Post::query()
            ->published()
            ->with(['category', 'translations'])
            ->where(function (Builder $query) use ($term, $columns): void {
                $this->orWhereLike($query, $columns, $term);

                if (Schema::hasTable('post_translations')) {
                    $query->orWhereHas('translations', function (Builder $query) use ($term): void {
                        $this->orWhereLike($query, ['title', 'content'], $term);
                    });
                }
            })
            ->latest('published_at')
            ->limit(8)
            ->get()
            ->map(fn (Post $post): array => [
                'title' => $post->translation()?->title ?? $post->title,
                'summary' => $this->excerpt($post->translation()?->content ?? $post->content ?? $post->excerpt),
                'url' => route('pages.blog.show', $post),
                'meta' => trim(($post->category?->name ? $post->category->name.' · ' : '').optional($post->published_at)->format('d/m/Y')),
                'badge' => 'Article',
            ]);
    }

    

    private function searchServices(string $term): Collection
    {
        if (! Schema::hasTable('noservices')) {
            return collect();
        }

        $columns = $this->existingColumns('noservices', [
            'title',
            'subtitle',
            'details',
            'result',
            'titre',
            'soustitre',
            'detalserivces',
            'resultats',
        ]);

        if ($columns === []) {
            return collect();
        }

        return Noservice::query()
            ->where(fn (Builder $query) => $this->orWhereLike($query, $columns, $term))
            ->orderBy('id')
            ->limit(6)
            ->get()
            ->map(function (Noservice $service): array {
                $title = $service->titre ?: $service->title ?: 'Service ABOULCODE';
                $summary = $service->soustitre ?: $service->subtitle ?: $service->resultats ?: $service->result;

                return [
                    'title' => $title,
                    'summary' => $this->excerpt($summary),
                    'url' => route('noservices'),
                    'meta' => 'ABOULCODE',
                    'badge' => 'Service',
                ];
            });
    }

    private function searchStaticPages(string $term): Collection
    {
        $needle = Str::lower($term);

        return collect([
            [
                'title' => 'Accueil',
                'summary' => 'Presentation de la plateforme, parcours, ressources et contact.',
                'url' => route('home'),
                'meta' => 'Page principale',
                'badge' => 'Page',
                'keywords' => 'accueil orientation tech plateforme etudiant ia rapport diagnostic ikigai',
            ],
            [
                'title' => 'Services',
                'summary' => 'Accompagnement, diagnostic, orientation et parcours personnalise.',
                'url' => route('noservices'),
                'meta' => 'ABOULCODE',
                'badge' => 'Page',
                'keywords' => 'services accompagnement orientation diagnostic conseil eleve',
            ],

            [
                'title' => 'Blog',
                'summary' => 'Articles, conseils et actualites pour mieux choisir son parcours.',
                'url' => route('pages.blog.index'),
                'meta' => 'Publications',
                'badge' => 'Page',
                'keywords' => 'blog article actualite guide conseil orientation',
            ],
            [
                'title' => 'Contact',
                'summary' => 'Contacter l equipe ABOULCODE.',
                'url' => route('contact.create'),
                'meta' => 'Support',
                'badge' => 'Page',
                'keywords' => 'contact support message aide question',
            ],
            [
                'title' => 'Politique de confidentialite',
                'summary' => 'Informations sur la protection des donnees et la confidentialite.',
                'url' => route('privacy'),
                'meta' => 'Legal',
                'badge' => 'Page',
                'keywords' => 'confidentialite donnees securite privacy legal',
            ],
        ])
            ->filter(function (array $page) use ($needle): bool {
                return Str::contains(Str::lower($page['title'].' '.$page['summary'].' '.$page['keywords']), $needle);
            })
            ->map(fn (array $page): array => collect($page)->except('keywords')->all())
            ->values();
    }

    private function normalizeQuery(string $query): string
    {
        return mb_substr((string) Str::of($query)->stripTags()->squish(), 0, 120);
    }

    private function existingColumns(string $table, array $columns): array
    {
        return collect($columns)
            ->filter(fn (string $column): bool => Schema::hasColumn($table, $column))
            ->values()
            ->all();
    }

    private function orWhereLike(Builder $query, array $columns, string $term): void
    {
        foreach ($columns as $column) {
            $query->orWhere($column, 'like', "%{$term}%");
        }
    }

    private function orWhereTranslatedLike(Builder $query, array $columns, string $term, array $locales): void
    {
        foreach ($columns as $column) {
            foreach ($locales as $locale) {
                $query->orWhere("{$column}->{$locale}", 'like', "%{$term}%");
            }

            $query->orWhere($column, 'like', "%{$term}%");
        }
    }

    private function excerpt(?string $value, int $limit = 170): string
    {
        $text = trim(preg_replace('/\s+/', ' ', strip_tags((string) $value)) ?: '');

        return $text !== '' ? Str::limit($text, $limit) : 'Contenu disponible sur ABOULCODE.';
    }

    private function locales(): array
    {
        return array_keys(config('ABOULCODE.supported_locales', ['fr' => 'Francais', 'en' => 'English']));
    }
}
