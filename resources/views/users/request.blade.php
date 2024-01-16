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
        <div class="mb-4">
          <h2>Status: <span class="{{ $service->status == 'pending' ? 'text-danger' : ($service->status == 'attending' ? 'text-warning': 'text-success') }}">{{ $service->status }}</span></h2>
        </div>
        <div class="table-responsive mb-4">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>SN</th>
                <th>Device</th>
                <th>Model</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1.</td>
                <td>{{ $service->device->name }}</td>
                <td>{{ $service->device->model }}</td>
              </tr>
            </tbody>
          </table>
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
    </div>
  </div>
</div>
@endsection
