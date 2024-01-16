@extends('layouts.app')
@section('title', 'Add Admin')
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
                                <div class="mb-4">
                                    <label for="role">Role</label>
                                    <select name="role" id="role" class="form-control form-select">
                                        <option value="">select role</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role }}">{{ ucwords(str_replace("_", " ", $role)) }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('role'))
                                        <span class="text-small text-sm text-danger">{{ $errors->first('role') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="phone_number">Password</label>
                                    <input type="password" name="password" id="password" class="form-control">
                                    @if ($errors->has('password'))
                                        <span class="text-small text-sm text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                                @if (session('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                @endif
                                <button type="submit" class="btn btn-primary w-100 py-8 mb-4 rounded-2">Add Admin</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
