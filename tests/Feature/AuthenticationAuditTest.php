<?php
// tests/Feature/AuthenticationAuditTest.php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\UserActionLog;

class AuthenticationAuditTest extends TestCase
{
    use RefreshDatabase;

    public function test_successful_login_is_logged()
    {
        $user = User::factory()->create([
            'email' => 'user@example.com',
            'password' => bcrypt('password'),
        ]);

        $this->post('/login', [
            'email' => 'user@example.com',
            'password' => 'password',
        ]);

        $this->assertAuthenticatedAs($user);

        $this->assertDatabaseHas('user_action_logs', [
            'user_id' => $user->id,
            'action' => 'login',
        ]);
    }

    public function test_failed_login_is_logged()
    {
        $user = User::factory()->create([
            'email' => 'user@example.com',
        ]);

        $this->post('/login', [
            'email' => 'user@example.com',
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();

        $this->assertDatabaseHas('user_action_logs', [
            'user_id' => $user->id,
            'action' => 'failed_login',
        ]);
    }
}
