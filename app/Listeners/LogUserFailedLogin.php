<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Auth\Events\Failed;
use App\Models\UserActionLog;

class LogUserFailedLogin
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Failed $event)
    {
        UserActionLog::create([
            'user_id' => optional($event->user)->id,
            'action' => 'failed_login',
            'ip_address' => request()->ip(),
        ]);
    }
}
