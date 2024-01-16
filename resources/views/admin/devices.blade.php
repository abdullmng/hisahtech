@extends('layouts.app')
@section('title', 'Devices')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                    <div class="mb-3 mb-sm-0">
                        <h5 class="card-title fw-semibold">Devices</h5>
                    </div>
                    <!--<div>
                        <select class="form-select">
                            <option value="1">March 2023</option>
                            <option value="2">April 2023</option>
                            <option value="3">May 2023</option>
                            <option value="4">June 2023</option>
                        </select>
                    </div>-->
                </div>
                <div class="mb-3">
                    <a href="{{ route('admin.add_device') }}" class="btn btn-primary">Add a new device</a>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="mb-4">
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger">{{ $error }}</div>
                            @endforeach
                            @if (session()->has('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif
                        </div>
                        <div class="table-responsive">
                            <table class="table align-middle text-nowrap mb-0 dt">
                                <thead>
                                    <tr class="text-muted fw-semibold">
                                        <th>S/N</th>
                                        <th>User</th>
                                        <th scope="col" class="ps-0">Name</th>
                                        <th scope="col">Brand</th>
                                        <th scope="col">Model</th>
                                        <th scope="col">Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="border-top">
                                    @foreach ($devices as $device)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $device->user->name }}</td>
                                        <td class="ps-0">
                                            {{ $device->name }}
                                        </td>
                                        <td>
                                            <p class="mb-0 fs-3">{{ $device->brand }}</p>
                                        </td>
                                        <td>
                                            {{ $device->model }}
                                        </td>
                                        <td>
                                            <span class="badge fw-semibold py-1 w-85 {{ $device->status == 'active' ? 'bg-light-success text-success' : 'bg-light-danger text-danger'  }}">{{ ucfirst($device->status) }}</span>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.get_device', $device->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                            <a href="{{ route('admin.delete_device', $device->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('are you sure you want to delete this device?')">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('modals')
<div class="modal fade" id="deviceModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add a Device</h4>
                <a href="javascript:void" data-bs-dismiss="modal" class="btn-close"></a>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    @csrf
                    <div class="mb-4">
                        <label for="name">Device Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control">
                    </div>
                    <div class="mb-4">
                        <label for="brand">Brand <span class="text-danger">*</span></label>
                        <input type="text" name="brand" id="brand" class="form-control">
                    </div>
                    <div class="mb-4">
                        <label for="model">Model <span class="text-danger">*</span></label>
                        <input type="text" name="model" id="model" class="form-control">
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-4">
                                <label for="ram_size">Ram size</label>
                                <input type="number" name="ram_size" id="ram_size" class="form-control">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-4">
                                <label for="storage_size">Storage/Harddisk size</label>
                                <input type="number" name="storage_size" id="storage_size" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary w-100">Add Device</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
