@extends('layouts.app')
@section('title', 'Service Request')
@section('content')
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Service Request</h4>
      </div>
      <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="mb-4">
          <h2>Status: <span class="{{ $service->status == 'pending' ? 'text-danger' : ($service->status == 'attending' ? 'text-warning': 'text-success') }}">{{ $service->status }}</span></h2>
        </div>
        <div class="row">
            <div class="col-md-4">
                <form action="{{ route('admin.update_request_status') }}" method="post">
                    @csrf
                    <input type="hidden" name="request_id" value="{{ $service->id }}">
                    <div class="mb-4">
                        <label for="status">Status</label>
                        <div class="input-group">
                            <select name="status" id="status" class="form-control form-select">
                                <option value="">Select status</option>
                                @php
                                    $statuses = ['pending', 'attending', 'completed'];
                                @endphp
                                @foreach ($statuses as $status)
                                    <option value="{{ $status }}" {{ $service->status == $status ? 'selected' : '' }}>{{ ucwords($status) }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                    <div class="alert alert-info">
                        <strong>Note:</strong> status update will notify user.
                    </div>
                </form>
            </div>
        </div>
        <div class="table-responsive mb-4">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>SN</th>
                <th>User</th>
                <th>Device</th>
                <th>Model</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1.</td>
                <th>{{ $service->user->name }}</th>
                <td>{{ $service->device->name }}</td>
                <td>{{ $service->device->model }}</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="mb-4">
                    <h4>Additional Device Info</h4>
                    <p>Ram Size (GB): {{ $service->device->ram_size }}</p>
                    <p>Storage (GB): {{ $service->device->storage_size }}</p>
                </div>
                <div class="mb-4">
                    <h4>Issue</h4>
                </div>
                <div class="mb-4">
                    <blockquote class="blockquote">
                        {!! $service->issue !!}
                    </blockquote>
                </div>
            </div>
            <div class="col-md-4">
                <h4>Send Invoice</h4>
                <form action="{{ route('admin.generate_service_invoice') }}" method="post">
                    @csrf
                    <input type="hidden" name="request_id" value="{{ $service->id }}">
                    <div class="mb-4">
                        <label for="amount">Amount</label>
                        <input type="number" name="amount" id="amount" class="form-control" placeholder="Enter Service Charge.">
                    </div>
                    <div class="mb-4">
                        <button type="submit" class="btn btn-primary">Generate & Send Invoice</button>
                    </div>
                </form>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
