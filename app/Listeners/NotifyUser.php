<?php

namespace App\Listeners;

use App\Events\UserCreatedAdmin;
use App\Notifications\AccountCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyUser
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
    public function handle(UserCreatedAdmin $event): void
    {
        $user = $event->user;
        $user->notify(new AccountCreated($user));
    }
}
