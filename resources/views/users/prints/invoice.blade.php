<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
</head>
<body>
    <div style="text-align: center; margin-bottom: 15px;">
        <h1 >{{ config('app.name') }}</h1>
        <h4>Invoice</h4>
    </div>

    <div>
        <p>Item(s): {{ $invoice->item_type == 'device' ? $invoice->item->name : $invoice->item->device->name }}</p>
        <p>Description: {{ $invoice->description }}</p>
        <p>Status: {{ ucwords($invoice->status) }}</p>
        <p>Amount: NGN {{ number_format($invoice->amount, 2) }}</p>
        <p>Date: {{ $invoice->created_at->format('Y-m-d') }}</p>
        <p>Paid at: {{ !is_null($invoice->paid_at) ? $invoice->paid_at->format('Y-m-d') : $invoice->paid_at }}</p>
    </div>
</body>
</html>
