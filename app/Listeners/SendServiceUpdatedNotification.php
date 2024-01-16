<?php

namespace App\Listeners;

use App\Events\ServiceUpdated;
use App\Notifications\ServiceUpdatedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendServiceUpdatedNotification
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
    public function handle(ServiceUpdated $event): void
    {
        $user = $event->service->user;
        $user->notify(new ServiceUpdatedNotification($event->service));
    }
}
