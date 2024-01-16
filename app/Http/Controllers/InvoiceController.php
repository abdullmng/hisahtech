<?php

namespace App\Http\Controllers;

use App\Events\InvoicePaid;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function handleWebhook(Request $request)
    {
        if ($request->header('verif-hash') != env('FLW_HASH'))
        {
            return response("Invalid request");
        }
        $data = $request->data;
        $invoice = Invoice::where('invoice_number', $data['tx_ref'])->first();
        if ($data['status'] == 'successful' && $data['amount'] >= $invoice?->amount)
        {

            $invoice->update([
                'status' => 'paid',
                'paid_at' => now()
            ]);

            event(new InvoicePaid($invoice));
        }
        return response("ok", 200);
    }
}
