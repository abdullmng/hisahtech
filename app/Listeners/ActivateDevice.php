<?php

namespace App\Listeners;

use App\Events\InvoicePaid;
use App\Models\Device;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ActivateDevice
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
    public function handle(InvoicePaid $event): void
    {
        $invoice = $event->invoice;
        info("Invoice => ", [$invoice]);
        if ($invoice->item_type == "device")
        {
            $device = Device::where('id', $invoice->item_id)->first();
            $device->update([
                "status" => 'active'
            ]);
        }
    }
}
