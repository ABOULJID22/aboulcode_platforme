<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'user_type' => ['required', 'in:student,teacher'],
        ]);

        $newUser = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_type' => $request->user_type,
            'configuration_compt_eleve' => false,
        ]);

        // Assign role based on user type
        try {
            if ($request->user_type === 'student') {
                $newUser->assignRole(User::ROLE_STUDENT);
            } elseif ($request->user_type === 'teacher') {
                $newUser->assignRole(User::ROLE_TEACHER);
            }
        } catch (\Throwable $e) {}

        event(new Registered($newUser));

        Auth::login($newUser);

        // update last login timestamp for the freshly registered user
        $newUser->update(['last_login_at' => now()]);

        // Redirect based on user type
        if ($request->user_type === 'student') {
            return redirect()->route('student-profile.show');
        }

        return redirect()->route('filament.admin.pages.dashboard');
    }
}
