<?php
// tests/Feature/UserAuditTest.php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use OwenIt\Auditing\Models\Audit;

class UserAuditTest extends TestCase
{
    use RefreshDatabase;

    // tests/Feature/UserAuditTest.php

    // tests/Feature/UserAuditTest.php

    public function user_update_is_audited()
    {
        // Create a user with initial 'name' and 'sensitive_data'
        $user = User::factory()->create([
            'name' => 'Original Name',
            'sensitive_data' => 'Original Sensitive Data',
        ]);

        // Act as the user and update the 'name' and 'sensitive_data'
        $response = $this->actingAs($user)
                         ->patch(route('profile.update'), [
                             'name' => 'New Name',
                             'sensitive_data' => 'New Sensitive Data',
                         ]);

        // Assert redirection (optional, based on controller behavior)
        $response->assertRedirect();

        // Assert that an audit record was created
        $audit = Audit::where('auditable_type', User::class)
                      ->where('auditable_id', $user->id)
                      ->latest()
                      ->first();

        $this->assertNotNull($audit, 'Audit record was not created.');

        $this->assertEquals('updated', $audit->event, 'Audit event is not "updated".');

        // Verify 'name' changes
        $this->assertEquals('Original Name', $audit->old_values['name'], 'Old name does not match.');
        $this->assertEquals('New Name', $audit->new_values['name'], 'New name does not match.');

        // Verify 'sensitive_data' changes
        $this->assertEquals('Original Sensitive Data', $audit->old_values['sensitive_data'], 'Old sensitive data does not match.');
        $this->assertEquals('New Sensitive Data', $audit->new_values['sensitive_data'], 'New sensitive data does not match.');
    }


}
