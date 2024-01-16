@extends('layouts.auth')
@section('title', 'Reset Password')
@section('content')
    <div class="col-sm-8 col-md-6 col-xl-9">
        <h2 class="mb-3 fs-7 fw-bolder">Password Reset</h2>
        <p class=" mb-9">Please create a new password</p>
        <form method="POST">
            @csrf
            <div class="mb-3">
                <input type="hidden" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" value="{{ request()->email }}">
                <input type="hidden" name="token" value="{{ request()->token }}">
            </div>
            <div class="mb-4">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="exampleInputPassword1">
                @if ($errors->has('password'))
                    <span class="text-small text-sm text-danger">{{ $errors->first('password') }}</span>
                @endif
            </div>
            <div class="mb-4">
                <label for="exampleInputPassword2" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" name="password_confirmation" id="exampleInputPassword2">
                @if ($errors->has('password_confirmation'))
                    <span class="text-small text-sm text-danger">{{ $errors->first('password_confirmation') }}</span>
                @endif
            </div>

            <button type="submit" class="btn btn-primary w-100 py-8 mb-4 rounded-2">Reset Password</button>
            <div class="d-flex align-items-center">
                <p class="fs-4 mb-0 text-dark">Remember password?</p>
                <a class="text-primary fw-medium ms-2" href="{{ route('user.login') }}">Sign In</a>
            </div>
        </form>
    </div>
@endsection
