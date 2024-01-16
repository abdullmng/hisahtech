<?php

namespace App\Listeners;

use App\Events\ServiceRequested;
use App\Models\Admin;
use App\Notifications\ServiceRequested as ServiceRequestedNotification;
use App\Notifications\ServiceRequestedAdmin;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class NotifyParties
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
    public function handle(ServiceRequested $event): void
    {
        $service = $event->service;
        $user = $service->user;
        $device = $service->device;
        $admins = Admin::all();

        $user->notify(new ServiceRequestedNotification($service));
        Notification::send($admins, new ServiceRequestedAdmin($service));
    }
}
