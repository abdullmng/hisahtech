@extends('layouts.auth')
@section('title', 'Login')
@section('content')
    <div class="col-sm-8 col-md-6 col-xl-9">
        <h2 class="mb-3 fs-7 fw-bolder">Welcome back</h2>
        <p class=" mb-9">Sign in to continue</p>
        <form method="POST">
            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp">
                @if ($errors->has('email'))
                    <span class="text-small text-sm text-danger">{{ $errors->first('email') }}</span>
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
                  <input class="form-check-input primary" type="checkbox" name="remember" id="flexCheckChecked">
                  <label class="form-check-label text-dark" for="flexCheckChecked">
                    Remeber this Device
                  </label>
                </div>
                <a class="text-primary fw-medium" href="{{ route('user.forgot') }}">Forgot Password ?</a>
            </div>
            <div>
                @if(session()->has('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif
            </div>
            <button type="submit" class="btn btn-primary w-100 py-8 mb-4 rounded-2">Sign In</button>
            <div class="d-flex align-items-center">
                <p class="fs-4 mb-0 text-dark">Don't have an Account?</p>
                <a class="text-primary fw-medium ms-2" href="{{ route('user.register') }}">Sign Up</a>
            </div>
        </form>
    </div>
@endsection
