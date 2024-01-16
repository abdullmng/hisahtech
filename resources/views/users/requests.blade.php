@extends('layouts.app')
@section('title', 'Repair Requests')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="mb-4">
                    <h4 class="card-title">Repair/Service Requests</h4>
                </div>
                <div class="mb-4">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#request-modal">New Request</button>
                </div>
                <div class="mb-4">
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">{{ $error }}</div>
                    @endforeach
                    @if (session()->has('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                </div>
                <div class="mb-4 table-responsive">
                    <table class="table table-striped dt">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Device</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($requests as $request)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $request->device->name }}</td>
                                    <td><span class="badge fw-semibold py-1 w-85 {{ $request->status == 'pending' ? 'bg-light-danger text-danger' : ($request->status == 'attending' ? 'bg-light-warning text-warning' : 'bg-light-success text-success')  }}">{{ ucfirst($request->status) }}</span></td>
                                    <td><a href="/user/requests/{{ $request->id }}" class="btn btn-info btn-sm">View Details</a></td>
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
@section('modals')
    <div class="modal fade" id="request-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">New Repair/Service request</h4>
                    <a href="#" data-bs-dismiss="modal" class="btn-close"></a>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        @csrf
                        <div class="mb-4">
                            <label for="device">Select Device</label>
                            <select name="device_id" id="device" class="form-control form-select">
                                <option value="">Select Device</option>
                                @foreach ($devices as $device)
                                    <option value="{{ $device->id }}">{{ $device->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="issue">Issue</label>
                            <textarea name="issue" id="issue" class="summernote" placeholder="Describe Issue here"></textarea>
                        </div>
                        <div class="mb-4">
                            <button type="submit" class="btn btn-primary">Submit Request</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $('.summernote').summernote()
    </script>
@endsection
