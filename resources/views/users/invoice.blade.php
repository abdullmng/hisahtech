@extends('layouts.app')
@section('title', 'Invoice')
@section('content')
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">#{{ $invoice->invoice_number }}</h4>
      </div>
      <div class="card-body">
        <div class="mb-4">
          <h2>Status: <span class="{{ $invoice->status == 'unpaid' ? 'text-danger' : 'text-success' }}">{{ $invoice->status }}</span></h2>
        </div>
        <div class="table-responsive mb-4">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>SN</th>
                <th>Item</th>
                <th>Description</th>
                <th>Amount</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1.</td>
                <td>{{ $invoice->item->name }}</td>
                <td>{{ $invoice->description }}</td>
                <td>NGN {{ number_format($invoice->amount, 2) }}</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="mb-4">
            @if ($invoice->status != 'paid')
                <form action="" id="pay-form">
                    <input type="hidden" value="{{ $invoice->amount }}" id="amount">
                    <input type="hidden" value="{{ $invoice->invoice_number }}" id="ref">
                    <button type="submit" class="btn btn-success" id="pay-btn">Pay Now</button>
                </form>
            @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('scripts')
<script src="https://checkout.flutterwave.com/v3.js"></script>
<script>
  $('#pay-form').submit( function (e) {
    e.preventDefault()
    let amount = $('#amount').val()
    let ref = $('#ref').val()
    FlutterwaveCheckout({
      public_key: "{{ env('FLW_PUB') }}",
      tx_ref: ref,
      amount: amount,
      currency: "NGN",
      payment_options: "card, banktransfer, ussd",
      customer: {
        email: "{{ auth()->user()->email }}",
        phone_number: "{{ auth()->user()->phone_number }}",
        name: "{{ auth()->user()->name }}",
      },
      customizations: {
        title: "{{ $invoice->item->name }}",
        description: "{{ $invoice->description }}",
        logo: "https://checkout.flutterwave.com/assets/img/rave-logo.png",
      },
    });
  })
</script>
@endsection
