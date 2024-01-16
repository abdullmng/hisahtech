@extends('layouts.app')
@section('title', 'Edit User')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="mb-4">
                    <h4 class="card-title">@yield('title')</h4>
                </div>
                <div class="mb-4">
                    <form action="" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="exampleInputtext" name="name" aria-describedby="textHelp" value="{{ $user->name }}">
                                    @if ($errors->has('name'))
                                        <span class="text-small text-sm text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                                    <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" value="{{ $user->email }}" readonly>
                                    @if ($errors->has('email'))
                                        <span class="text-small text-sm text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="phone_number">Phone Number</label>
                                    <input type="tel" name="phone_number" id="phone_number" class="form-control" value="{{ $user->phone_number }}">
                                    @if ($errors->has('phone_number'))
                                        <span class="text-small text-sm text-danger">{{ $errors->first('phone_number') }}</span>
                                    @endif
                                </div>
                                @if (session('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                @endif
                                <button type="submit" class="btn btn-primary w-100 py-8 mb-4 rounded-2">Update Info </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
