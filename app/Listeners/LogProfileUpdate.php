<?php

namespace App\Listeners;

use App\Events\ProfileUpdated;
use App\Models\UserActionLog;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class LogProfileUpdate
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
     *
     * @param  \App\Events\ProfileUpdated  $event
     * @return void
     */
    public function handle(ProfileUpdated $event)
    {
        // Log the profile update
        Log::info("User ID {$event->user->id} updated their profile.", [
            'changes' => $event->changes,
        ]);

        UserActionLog::create([
            'user_id' => $event->user->id,
            'action' => 'profile_update',
            'description' => 'User updated their profile information.',
            'ip_address' => request()->ip(),
            'changes' => json_encode($event->changes),
        ]);

        // Additional actions can be performed here, such as sending notifications
    }
}
