@extends('layouts.app')
@section('title', 'Service Requests')
@section('content')
    <div class="row mb-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="mb-4"><h4 class="card-title">Pending Requests</h4></div>
                    <div class="table-responsive">
                        <table class="table table-striped dt">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>User</th>
                                    <th>Device</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pending_requests as $pending_request)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $pending_request->user->name }}</td>
                                        <td>{{ $pending_request->device->name }}</td>
                                        <td><span class="badge fw-semibold py-1 w-85 {{ $pending_request->status == 'pending' ? 'bg-light-danger text-danger' : ($pending_request->status == 'attending' ? 'bg-light-warning text-warning' : 'bg-light-success text-success')  }}">{{ ucfirst($pending_request->status) }}</span></td>
                                        <td>{{ $pending_request->created_at->format('Y-m-d') }}</td>
                                        <td><a href="/admin/service/requests/{{ $pending_request->id }}" class="btn btn-info btn-sm">View Details</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="mb-4"><h4 class="card-title">Attending Requests</h4></div>
                    <div class="table-responsive">
                        <table class="table table-striped dt">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>User</th>
                                    <th>Device</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($attending_requests as $attending_request)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $attending_request->user->name }}</td>
                                        <td>{{ $attending_request->device->name }}</td>
                                        <td><span class="badge fw-semibold py-1 w-85 {{ $attending_request->status == 'pending' ? 'bg-light-danger text-danger' : ($attending_request->status == 'attending' ? 'bg-light-warning text-warning' : 'bg-light-success text-success')  }}">{{ ucfirst($attending_request->status) }}</span></td>
                                        <td>{{ $attending_request->created_at->format('Y-m-d') }}</td>
                                        <td><a href="/admin/service/requests/{{ $attending_request->id }}" class="btn btn-info btn-sm">View Details</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="mb-4"><h4 class="card-title">Completed Requests</h4></div>
                    <div class="table-responsive">
                        <table class="table table-striped dt">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>User</th>
                                    <th>Device</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($completed_requests as $completed_request)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $completed_request->user->name }}</td>
                                        <td>{{ $completed_request->device->name }}</td>
                                        <td><span class="badge fw-semibold py-1 w-85 {{ $completed_request->status == 'pending' ? 'bg-light-danger text-danger' : ($completed_request->status == 'attending' ? 'bg-light-warning text-warning' : 'bg-light-success text-success')  }}">{{ ucfirst($completed_request->status) }}</span></td>
                                        <td>{{ $completed_request->created_at->format('Y-m-d') }}</td>
                                        <td><a href="/admin/service/requests/{{ $completed_request->id }}" class="btn btn-info btn-sm">View Details</a></td>
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
