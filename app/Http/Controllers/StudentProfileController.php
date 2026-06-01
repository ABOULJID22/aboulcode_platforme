<?php

namespace App\Http\Controllers;

use App\Models\StudentProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentProfileController extends Controller
{
    /**
     * Show the student profile configuration form
     */
    public function show(Request $request)
    {
        $user = Auth::user();

        if (!$user || $user->user_type !== 'student') {
            return redirect('/dashboard');
        }

        // Get or create student profile
        $profile = $user->studentProfile ?? new StudentProfile(['user_id' => $user->id]);

        return view('profile.student-config', [
            'profile' => $profile,
            'user' => $user,
        ]);
    }

    /**
     * Store/update the student profile
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        if (!$user || $user->user_type !== 'student') {
            return redirect('/dashboard');
        }

        $validated = $request->validate([
            'education_level' => 'required|string',
            'bac_type' => 'nullable|in:marocain,mission',
            'bac_field' => 'nullable|string',
            'school_name' => 'required|string|max:255',
            'school_type' => 'required|in:public,private',
            'preferred_school_types' => 'required|array|min:1',
            'interested_services' => 'nullable|array',
            'birth_date' => 'required|date',
            'gender' => 'required|in:masculine,feminine',
            'city' => 'required|string|max:255',
            'consent_contact' => 'required|boolean',
        ]);

        // Create or update profile
        $profile = $user->studentProfile ?? new StudentProfile(['user_id' => $user->id]);
        $profile->fill($validated);
        $profile->is_complete = true;
        $profile->save();

        // Mark user configuration as complete
        $user->update(['configuration_compt_eleve' => true]);

        return redirect()->route('filament.admin.pages.dashboard')
            ->with('success', 'Votre profil étudiant a été configuré avec succès !');
    }

    /**
     * Redirect based on user type after registration
     */
    public static function redirectAfterRegister($user)
    {
        if ($user->user_type === 'student' && !$user->configuration_compt_eleve) {
            return redirect()->route('student-profile.show')
                ->with('alert', 'Veuillez compléter votre profil étudiant pour accéder à la plateforme.');
        }

        return redirect()->route('filament.admin.pages.dashboard');
    }
}
