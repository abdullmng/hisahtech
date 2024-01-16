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
        <button type="submit" class="btn btn-primary w-100 py-8 mb-4 rounded-2">Sign Up</button>
        <div class="d-flex align-items-center">
        <p class="fs-4 mb-0 text-dark">Already have an Account?</p>
        <a class="text-primary fw-medium ms-2" href="{{ route('user.login') }}">Sign In</a>
        </div>
    </form>
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
