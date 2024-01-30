<?php

namespace Tests\Feature\Welcome;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WelcomeTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    use RefreshDatabase;
    public function test_example(): void
    {
        $response = $this->get('/');
        $response->assertSee('Login Area');

        $response->assertStatus(200);
    }

    public function test_authenticated_admin_redirected_to_home(): void
    {
        $user = User::factory()->create([
            'level' => 'admin',
            'password' => bcrypt('laravel'),
            'is_aktif' => 1,
        ]);

        $this->actingAs($user);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'laravel',

        ]);

        $this->assertAuthenticatedAs($user);

        // Memeriksa bahwa pengguna admin dialihkan ke RouteServiceProvider::HOME
        // $response->assertRedirect(RouteServiceProvider::HOME);
    }

    public function test_authenticated_student_redirected_to_student_route(): void
    {
        $user = User::factory()->create([
            'level' => 'student',
            'password' => bcrypt('laravel'),
            'is_aktif' => 1,
        ]);

        $this->actingAs($user);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'laravel',

        ]);

        // Memastikan bahwa autentikasi berhasil
        $this->assertAuthenticatedAs($user);

        // Memeriksa bahwa pengguna student dialihkan ke RouteServiceProvider::STUDENT
        // $response->assertRedirect(RouteServiceProvider::STUDENT);
    }

    public function inactive_user_cannot_login(): void
    {
        $user = User::factory()->create([
            'level' => 'student',
            'password' => bcrypt('laravel'),
            'is_aktif' => 0,
        ]);

        $this->actingAs($user);
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'laravel',
        ]);

        $this->assertTrue(session()->has('errors'));

        $response->assertSessionHasErrors('email', __('Akun anda tidak aktif'));

        $this->assertGuest();

    }

}
