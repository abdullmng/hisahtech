@extends('layouts.auth')
@section('title', 'Register')
@section('content')
<div class="col-sm-8 col-md-6 col-xl-9">
    <h2 class="mb-3 fs-7 fw-bolder">Welcome to {{ config('app.name') }}</h2>
    <p class=" mb-9">Fill the form below to sign up</p>
    <form method="POST">
        @csrf
        <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Name</label>
        <input type="text" class="form-control" id="exampleInputtext" name="name" aria-describedby="textHelp">
        @if ($errors->has('name'))
            <span class="text-small text-sm text-danger">{{ $errors->first('name') }}</span>
        @endif
        </div>
        <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp">
        @if ($errors->has('email'))
            <span class="text-small text-sm text-danger">{{ $errors->first('email') }}</span>
        @endif
        </div>
        <div class="mb-3">
            <label for="phone_number">Phone Number</label>
            <input type="tel" name="phone_number" id="phone_number" class="form-control">
            @if ($errors->has('phone_number'))
                <span class="text-small text-sm text-danger">{{ $errors->first('phone_number') }}</span>
            @endif
        </div>
        <div class="mb-4">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control" name="password" id="exampleInputPassword1">
        @if ($errors->has('password'))
            <span class="text-small text-sm text-danger">{{ $errors->first('password') }}</span>
        @endif
        </div>
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="form-check">
              <input class="form-check-input primary" type="checkbox" name="terms" id="flexCheckChecked">
              <label class="form-check-label text-dark" for="flexCheckChecked">
                Please read and accept our <a href="javascript:void" data-bs-toggle="modal" data-bs-target="#termsModal">Terms of use</a> to proceed
              </label>
            </div>
        </div>
        @if ($errors->has('terms'))
            <div class="alert alert-danger">You must accept our terms of use to sign up</div>
        @endif
        <button type="submit" class="btn btn-primary w-100 py-8 mb-4 rounded-2">Sign Up</button>
        <div class="d-flex align-items-center">
        <p class="fs-4 mb-0 text-dark">Already have an Account?</p>
        <a class="text-primary fw-medium ms-2" href="{{ route('user.login') }}">Sign In</a>
        </div>
    </form>
</div>
@endsection

@section('modals')
    <div class="modal fade" id="termsModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Terms of Use</h4>
                    <a href="#" data-bs-dismiss="modal" class="btn-close"></a>
                </div>
                <div class="modal-body">
                    <p>
                        By registering your computer for repair services, you agree to comply with the following terms and conditions.
                    </p>
                    <p>By registering your computer, you must pay the registration fee to complete the registration process. The fee is non-refundable.</p>
                    <p>By registering your computer for repair, you authorize our technicians to access and examine your device to diagnose and perform necessary repairs.</p>
                    <p>Payment for repair services is due upon completion. Failure to make payment within the specified timeframe may result in additional charges or the withholding of your repaired computer.</p>
                    <p>It is your responsibility to back up your data before submitting your computer for repair. We are not liable for any loss of data during the repair process.</p>
                    <p>While we strive to complete repairs promptly, the actual turnaround time may vary. We will provide an estimated completion date and inform you of any delays.</p>
                    <p>A limited warranty covers repairs. If you experience issues related to the repaired components within the warranty period, we will address them at no additional cost. The warranty does not cover new issues or external damage.</p>
                    <p>Refunds are only applicable if we are unable to complete the requested repairs. No refunds will be provided once the repair process has started.</p>
                    <p>Devices left unclaimed for a specified period may be considered abandoned and may be subject to disposal or recycling. We will make reasonable efforts to contact you before taking such actions.</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const phoneInputField = document.querySelector("#phone_number");
        const phoneInput = window.intlTelInput(phoneInputField, {
            initialCountry: "ng",
            utilsScript:
            "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
        });
    </script>
@endsection
