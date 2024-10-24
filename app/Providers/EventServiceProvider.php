<?php

namespace App\Providers;

use App\Events\ProfileUpdated;
use App\Listeners\LogProfileUpdate;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Failed;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Listeners\LogUserLogin;
use App\Listeners\LogUserFailedLogin;
use App\Listeners\LogUserLogout;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Login::class => [
            LogUserLogin::class,
        ],
        Failed::class => [
            LogUserFailedLogin::class,
        ],
        Logout::class => [
            LogUserLogout::class,
        ],
        ProfileUpdated::class => [ // Add the new event
            LogProfileUpdate::class,
        ],
        // Other events...
    ];

    public function boot()
    {
        parent::boot();
    }
}
