<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_new_users_can_register(): void
    {
        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('/', absolute: false));
    }

    public function test_teacher_registration_waits_for_admin_validation(): void
    {
        $this->createRoles();

        $response = $this->post('/register', [
            'name' => 'Teacher User',
            'email' => 'teacher@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'user_type' => User::ROLE_TEACHER,
        ]);

        $response->assertRedirect(route('login', absolute: false));
        $this->assertGuest();

        $teacher = User::where('email', 'teacher@example.com')->firstOrFail();

        $this->assertFalse($teacher->is_active);
        $this->assertTrue($teacher->isTeacher());
    }

    public function test_inactive_teacher_cannot_login_until_validated(): void
    {
        $this->createRoles();

        $teacher = User::factory()->create([
            'email' => 'teacher@example.com',
            'is_active' => false,
        ]);
        $teacher->assignRole(User::ROLE_TEACHER);

        $response = $this->post('/login', [
            'email' => 'teacher@example.com',
            'password' => 'password',
        ]);

        $this->assertGuest();
        $response->assertSessionHasErrors([
            'email' => 'Votre compte est en attente de validation par un administrateur.',
        ]);

        $teacher->update(['is_active' => true]);

        $this->post('/login', [
            'email' => 'teacher@example.com',
            'password' => 'password',
        ]);

        $this->assertAuthenticatedAs($teacher);
    }

    private function createRoles(): void
    {
        foreach ([User::ROLE_SUPER_ADMIN, User::ROLE_TEACHER, User::ROLE_STUDENT, User::ROLE_USER] as $role) {
            Role::firstOrCreate(['name' => $role, 'guard_name' => 'web']);
        }
    }
}
