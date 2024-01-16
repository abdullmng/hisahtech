<?php

namespace App\Providers;

use App\Events\UserRegistered;
use App\Events\DeviceCreated;
use App\Events\InvoiceCreated;
use App\Events\InvoicePaid;
use App\Events\ServiceRequested;
use App\Events\ServiceUpdated;
use App\Events\UserCreatedAdmin;
use App\Listeners\SendWelcomeEmail;
use App\Listeners\NotifyParties;
use App\Listeners\GenerateDeviceInvoice;
use App\Listeners\ActivateDevice;
use App\Listeners\NotifyAdmin;
use App\Listeners\SendInvoiceCreatedNotification;
use App\Listeners\SendServiceUpdatedNotification;
use App\Listeners\NotifyUser;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        UserRegistered::class => [
            SendWelcomeEmail::class,
        ],
        DeviceCreated::class => [
            GenerateDeviceInvoice::class,
        ],
        InvoiceCreated::class => [
            SendInvoiceCreatedNotification::class,
        ],
        InvoicePaid::class => [
            ActivateDevice::class,
            NotifyAdmin::class,
        ],
        ServiceRequested::class => [
            NotifyParties::class,
        ],
        UserCreatedAdmin::class => [
            NotifyUser::class,
        ],
        ServiceUpdated::class => [
            SendServiceUpdatedNotification::class,
        ]
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
