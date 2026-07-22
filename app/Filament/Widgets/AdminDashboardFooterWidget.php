<?php

namespace App\Filament\Widgets;

use App\Filament\Pages\SupportConversations;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Route;

class AdminDashboardFooterWidget extends Widget
{
    protected static ?int $sort = 100;

    protected string $view = 'filament.widgets.admin-dashboard-footer-widget';

    protected int|string|array $columnSpan = 'full';

    protected function getViewData(): array
    {
        return [
            'supportUrl' => SupportConversations::getUrl(),
            'aboutUrl' => Route::has('pourquoi') ? route('pourquoi') : url('/'),
            'privacyUrl' => Route::has('privacy') ? route('privacy') : url('/'),
            'termsUrl' => Route::has('legal') ? route('legal') : url('/'),
            'securityUrl' => Route::has('privacy') ? route('privacy') : url('/'),
            'documentationUrl' => Route::has('pages.blog.index') ? route('pages.blog.index') : url('/'),
        ];
    }

    public static function canView(): bool
    {
        return auth()->user()?->isSuperAdmin() ?? false;
    }
}
