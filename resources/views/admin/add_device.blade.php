@extends('layouts.app')
@section('title', 'Add Device')
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
                                    <label for="name" class="form-label">Device Name</label>
                                    <input type="text" class="form-control" id="name" name="name" aria-describedby="textHelp">
                                    @if ($errors->has('name'))
                                        <span class="text-small text-sm text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="brand" class="form-label">Brand</label>
                                    <input type="text" class="form-control" id="brand" name="brand" aria-describedby="emailHelp">
                                    @if ($errors->has('brand'))
                                        <span class="text-small text-sm text-danger">{{ $errors->first('brand') }}</span>
                                    @endif
                                </div>
                                <div class="mb-4">
                                    <label for="model" class="form-label">Model</label>
                                    <input type="text" name="model" id="model" class="form-control">
                                    @if ($errors->has('model'))
                                        <span class="text-small text-sm text-danger">{{ $errors->first('model') }}</span>
                                    @endif
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label for="ram_size" class="form-label">Ram Size (GB)</label>
                                            <input type="number" name="ram_size" id="ram_size" class="form-control">
                                            @if ($errors->has('ram_size'))
                                                <span class="text-small text-sm text-danger">{{ $errors->first('ram_size') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label for="storage_size" class="form-label">Storage Size (GB)</label>
                                            <input type="number" name="storage_size" id="storage_size" class="form-control">
                                            @if ($errors->has('storage_size'))
                                                <span class="text-small text-sm text-danger">{{ $errors->first('storage_size') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label for="user" class="form-label">User</label>
                                    <select name="user_id" id="user" class="form-control form-select">
                                        <option value="">Select User</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                                        @endforeach
                                    </select>
                                </div>
                                @if (session('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                @endif
                                <button type="submit" class="btn btn-primary w-100 py-8 mb-4 rounded-2">Add Device</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
