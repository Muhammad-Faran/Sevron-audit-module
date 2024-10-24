<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProfileUpdated
{
    use Dispatchable, SerializesModels;

    public $user;
    public $changes;

    /**
     * Create a new event instance.
     *
     * @param \App\Models\User $user
     * @param array $changes
     * @return void
     */
    public function __construct(User $user, array $changes)
    {
        $this->user = $user;
        $this->changes = $changes;
    }
}
