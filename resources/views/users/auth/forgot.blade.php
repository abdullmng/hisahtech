@extends('layouts.auth')
@section('title', 'Forgot')
@section('content')
    <div class="col-sm-8 col-md-6 col-xl-9">
        <h2 class="mb-3 fs-7 fw-bolder">Forgot your password?</h2>
        <p class=" mb-9">Enter your email address as you used to sign up and we will send you steps to reset your password</p>
        <form method="POST">
            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp">
                @if ($errors->has('email'))
                    <span class="text-small text-sm text-danger">{{ $errors->first('email') }}</span>
                @endif
            </div>
            <div>
                @if(session()->has('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif
            </div>
            <button type="submit" class="btn btn-primary w-100 py-8 mb-4 rounded-2">Proceed</button>
            <div class="d-flex align-items-center">
                <p class="fs-4 mb-0 text-dark">Remember your password?</p>
                <a class="text-primary fw-medium ms-2" href="{{ route('user.login') }}">Sign In</a>
            </div>
        </form>
    </div>
@endsection
