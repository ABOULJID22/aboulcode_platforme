<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class OrientationStartController extends Controller
{
    public const ACCOUNT_COOKIE = 'ABOULCODE_has_account';

    public function __invoke(Request $request): RedirectResponse
    {
        $user = $request->user();

        if ($user instanceof User) {
            if (! $user->is_active) {
                return redirect()
                    ->route('home')
                    ->with('status', 'Votre compte est en attente de validation.');
            }

            if ($user->isStudent() && ! $user->configuration_compt_eleve) {
                return redirect()->route('student-profile.show');
            }

            if ($user->isSuperAdmin() || $user->isTeacher() || $user->isStudent()) {
                return redirect()->route('filament.admin.pages.admin-dashboard');
            }

            return redirect()
                ->route('home')
                ->with('status', 'Votre compte ne donne pas encore acces au panel.');
        }

        return redirect()->route(
            $request->cookies->has(self::ACCOUNT_COOKIE) ? 'login' : 'register'
        );
    }
}
