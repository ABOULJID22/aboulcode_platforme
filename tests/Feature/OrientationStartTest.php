<?php

namespace Tests\Feature;

use App\Http\Controllers\OrientationStartController;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Tests\TestCase;

class OrientationStartTest extends TestCase
{
    use RefreshDatabase;

    public function test_new_guest_is_sent_to_registration(): void
    {
        $this->get(route('orientation.start'))
            ->assertRedirect(route('register', absolute: false));
    }

    public function test_known_guest_without_session_is_sent_to_login(): void
    {
        $this->withCookie(OrientationStartController::ACCOUNT_COOKIE, '1')
            ->get(route('orientation.start'))
            ->assertRedirect(route('login', absolute: false));
    }

    public function test_successful_login_remembers_known_account_browser(): void
    {
        $user = User::factory()->create(['is_active' => true]);

        $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'password',
        ])->assertCookie(OrientationStartController::ACCOUNT_COOKIE);
    }

    public function test_registration_remembers_known_account_browser(): void
    {
        $this->createRoles();

        $this->post(route('register'), [
            'name' => 'Test Student',
            'email' => 'student@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ])->assertCookie(OrientationStartController::ACCOUNT_COOKIE);
    }

    public function test_complete_student_is_sent_to_filament_panel(): void
    {
        $this->createRoles();

        $student = User::factory()->create([
            'is_active' => true,
            'configuration_compt_eleve' => true,
        ]);
        $student->assignRole(User::ROLE_STUDENT);

        $this->actingAs($student)
            ->get(route('orientation.start'))
            ->assertRedirect(route('filament.admin.pages.admin-dashboard', absolute: false));
    }

    public function test_incomplete_student_is_sent_to_profile_configuration(): void
    {
        $this->createRoles();

        $student = User::factory()->create([
            'is_active' => true,
            'configuration_compt_eleve' => false,
        ]);
        $student->assignRole(User::ROLE_STUDENT);

        $this->actingAs($student)
            ->get(route('orientation.start'))
            ->assertRedirect(route('student-profile.show', absolute: false));
    }

    private function createRoles(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        foreach ([User::ROLE_SUPER_ADMIN, User::ROLE_TEACHER, User::ROLE_STUDENT, User::ROLE_USER] as $role) {
            Role::firstOrCreate(['name' => $role, 'guard_name' => 'web']);
        }
    }
}
