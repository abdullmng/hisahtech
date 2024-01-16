@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<h2>Users</h2>
<div class="row">
    <div class="col-md-4">
        <div class="card w-100">
            <div class="card-body bg-light-primary border-0 p-2  rounded">
                <div class="text-center">
                    <i class="ti ti-users mb-3 text-warning" style="font-size: 40px;"></i>
                    <p class="fw-semibold fs-3 text-primary mb-1"> Users </p>
                    <h5 class="fw-semibold text-primary mb-0">{{ $stats['users'] }}</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card w-100">
            <div class="card-body bg-light-warning border-0 p-2  rounded">
                <div class="text-center">
                    <i class="ti ti-users mb-3 text-danger" style="font-size: 40px;"></i>
                    <p class="fw-semibold fs-3 text-primary mb-1"> Admins </p>
                    <h5 class="fw-semibold text-primary mb-0">{{ $stats['admins'] }}</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card w-100">
            <div class="card-body bg-light-success border-0 p-2  rounded">
                <div class="text-center">
                    <i class="ti ti-users mb-3 text-primary" style="font-size: 40px;"></i>
                    <p class="fw-semibold fs-3 text-primary mb-1">Total Users </p>
                    <h5 class="fw-semibold text-primary mb-0">{{ $stats['users'] + $stats['admins'] }}</h5>
                </div>
            </div>
        </div>
    </div>
</div>

<h2>Devices</h2>
<div class="row">
    <div class="col-md-4">
        <div class="card w-100">
            <div class="card-body bg-light-primary border-0 p-2  rounded">
                <div class="text-center">
                    <i class="ti ti-device-analytics mb-3 text-warning" style="font-size: 40px;"></i>
                    <p class="fw-semibold fs-3 text-primary mb-1"> Total Devices </p>
                    <h5 class="fw-semibold text-primary mb-0">{{ $stats['devices'] }}</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card w-100">
            <div class="card-body bg-light-success border-0 p-2  rounded">
                <div class="text-center">
                    <i class="ti ti-device-analytics mb-3 text-primary" style="font-size: 40px;"></i>
                    <p class="fw-semibold fs-3 text-primary mb-1"> Active Devices </p>
                    <h5 class="fw-semibold text-primary mb-0">{{ $stats['active_devices'] }}</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card w-100">
            <div class="card-body bg-light-warning border-0 p-2  rounded">
                <div class="text-center">
                    <i class="ti ti-device-analytics mb-3 text-danger" style="font-size: 40px;"></i>
                    <p class="fw-semibold fs-3 text-primary mb-1">Inactive Devices </p>
                    <h5 class="fw-semibold text-primary mb-0">{{ $stats['inactive_devices'] }}</h5>
                </div>
            </div>
        </div>
    </div>
</div>

<h2>Service Requests</h2>
<div class="row">
    <div class="col-md-4">
        <div class="card w-100">
            <div class="card-body bg-light-danger border-0 p-2  rounded">
                <div class="text-center">
                    <i class="ti ti-table-options mb-3 text-warning" style="font-size: 40px;"></i>
                    <p class="fw-semibold fs-3 text-primary mb-1"> Pending Requests </p>
                    <h5 class="fw-semibold text-primary mb-0">{{ $stats['pending_requests'] }}</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card w-100">
            <div class="card-body bg-light-warning border-0 p-2  rounded">
                <div class="text-center">
                    <i class="ti ti-table-options mb-3 text-primary" style="font-size: 40px;"></i>
                    <p class="fw-semibold fs-3 text-primary mb-1"> Attending Requests </p>
                    <h5 class="fw-semibold text-primary mb-0">{{ $stats['attending_requests'] }}</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card w-100">
            <div class="card-body bg-light-success border-0 p-2  rounded">
                <div class="text-center">
                    <i class="ti ti-table-options mb-3 text-info" style="font-size: 40px;"></i>
                    <p class="fw-semibold fs-3 text-primary mb-1">Completed Requests </p>
                    <h5 class="fw-semibold text-primary mb-0">{{ $stats['completed_requests'] }}</h5>
                </div>
            </div>
        </div>
    </div>
</div>

<h2>Finance</h2>
<div class="row">
    <div class="col-md-6">
        <div class="card w-100">
            <div class="card-body bg-light-success border-0 p-2  rounded">
                <div class="text-center">
                    <i class="ti ti-cash mb-3 text-warning" style="font-size: 40px;"></i>
                    <p class="fw-semibold fs-3 text-primary mb-1"> Paid Invoices</p>
                    <h5 class="fw-semibold text-primary mb-0">NGN {{ $stats['total_paid'] }}</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card w-100">
            <div class="card-body bg-light-danger border-0 p-2  rounded">
                <div class="text-center">
                    <i class="ti ti-cash mb-3 text-primary" style="font-size: 40px;"></i>
                    <p class="fw-semibold fs-3 text-primary mb-1"> Unpaid Invoices </p>
                    <h5 class="fw-semibold text-primary mb-0">NGN {{ $stats['total_unpaid'] }}</h5>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
