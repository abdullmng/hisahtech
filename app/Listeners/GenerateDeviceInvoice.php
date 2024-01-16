<?php

namespace App\Listeners;

use App\Events\DeviceCreated;
use App\Events\InvoiceCreated;
use App\Models\Configuration;
use App\Models\Invoice;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class GenerateDeviceInvoice
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
    public function handle(DeviceCreated $event): void
    {
        $device = $event->device;
        $user = $event->user;
        $isAdmin = $event->admin;
        $status = 'unpaid';
        if ($isAdmin)
        {
            $status = 'paid';
        }

        $invoice = Invoice::create([
            'user_id' => $user->id,
            'item_id' => $device->id,
            'item_type' => 'device',
            'invoice_number' => $this->generateInvoiceNumber(),
            'description' => 'Device registration',
            'amount' => Configuration::where('name', 'device_registration_amount')->first()->value,
            'status' => $status
        ]);

        event(new InvoiceCreated($invoice, $user));
    }

    protected function generateInvoiceNumber()
    {
        return date('ismyhd');
    }
}
