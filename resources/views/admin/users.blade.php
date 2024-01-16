@extends('layouts.app')
@section('title', 'Users')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card w-100">
            <div class="card-body">
                <div class="mb-4">
                    <h4 class="card-title">Manage Users</h4>
                </div>

                <div class="mb-4">
                    <a href="{{ route('admin.user_form') }}" class="btn btn-primary">Add User +</a>
                </div>
                @foreach ($errors->all() as $err)
                    <div class="alert alert-danger">{{ $err }}</div>
                @endforeach
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <div class="table-responsive">
                    <table class="table table-bordered table-striped dt">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Name</th>
                                <th>Phone Number</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->phone_number }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td><a href="{{ route('admin.get_user', $user->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>  <a href="{{ route('admin.delete_user', $user->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('are you sure you want to delete this user?')"><i class="fa fa-trash"></i> Delete</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
