<?php

namespace App\Providers;

use App\Models\User;
use App\Policies\UserPolicy;
// Other imports...

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // Register the User model with its policy
        User::class => UserPolicy::class,
        // Other model-policy mappings...
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Other gate definitions...
    }
}
