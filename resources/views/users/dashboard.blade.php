@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
    <!--  Owl carousel -->
    <div class="owl-carousel counter-carousel owl-theme">
        <div class="item">
            <div class="card border-0 zoom-in bg-light-primary shadow-none">
                <div class="card-body">
                    <div class="text-center">
                        <i class="ti ti-device-analytics mb-3 text-warning" style="font-size: 40px;"></i>
                        <p class="fw-semibold fs-3 text-primary mb-1"> Devices </p>
                        <h5 class="fw-semibold text-primary mb-0">{{ $stats['devices'] }}</h5>
                    </div>
                </div>
            </div>
        </div>
        {{--<div class="item">
            <div class="card border-0 zoom-in bg-light-warning shadow-none">
                <div class="card-body">
                    <div class="text-center">
                        <img src="/dist/images/svgs/icon-briefcase.svg" width="50" height="50" class="mb-3"
                            alt="" />
                        <p class="fw-semibold fs-3 text-warning mb-1">Total Invoices</p>
                        <h5 class="fw-semibold text-warning mb-0">0</h5>
                    </div>
                </div>
            </div>
        </div>--}}
        <div class="item">
            <div class="card border-0 zoom-in bg-light-info shadow-none">
                <div class="card-body">
                    <div class="text-center">
                        <i class="ti ti-cash mb-3 text-warning" style="font-size: 40px;"></i>
                        <p class="fw-semibold fs-3 text-info mb-1">Paid Invoices</p>
                        <h5 class="fw-semibold text-info mb-0">{{ $stats['paid'] }}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="card border-0 zoom-in bg-light-danger shadow-none">
                <div class="card-body">
                    <div class="text-center">
                        <i class="ti ti-cash-off mb-3 text-warning" style="font-size: 40px;"></i>
                        <p class="fw-semibold fs-3 text-danger mb-1">Unpaid Invoices</p>
                        <h5 class="fw-semibold text-danger mb-0">{{ $stats['unpaid'] }}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="card border-0 zoom-in bg-light-success shadow-none">
                <div class="card-body">
                    <div class="text-center">
                        <i class="ti ti-table-options mb-3 text-warning" style="font-size: 40px;"></i>
                        <p class="fw-semibold fs-3 text-success mb-1">Pending Service</p>
                        <h5 class="fw-semibold text-success mb-0">{{ $stats['pending'] }}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="card border-0 zoom-in bg-light-info shadow-none">
                <div class="card-body">
                    <div class="text-center">
                        <i class="ti ti-device-desktop-check mb-3 text-warning" style="font-size: 40px;"></i>
                        <p class="fw-semibold fs-2 text-info mb-1">Completed Service</p>
                        <h5 class="fw-semibold text-info mb-0">{{ $stats['completed'] }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  Row 1 -->
    <div class="row">
        <div class="col-lg-8 d-flex align-items-strech">
            <div class="card w-100">
                <div class="card-body">
                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                        <div class="mb-3 mb-sm-0">
                            <h5 class="card-title fw-semibold">My Devices</h5>
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
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="table-responsive">
                                <table class="table align-middle text-nowrap mb-0 dt">
                                    <thead>
                                        <tr class="text-muted fw-semibold">
                                            <th scope="col" class="ps-0">Name</th>
                                            <th scope="col">Brand</th>
                                            <th scope="col">Model</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="border-top">
                                        @foreach ($devices as $device)
                                        <tr>
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
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <p class="mt-4"><a href="/user/devices">View all</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="row">
                <div class="col-lg-12 col-md-6 col-sm-12">
                    <!-- Yearly Breakup -->
                    <div class="card overflow-hidden">
                        <div class="card-body">
                            <div class="row alig n-items-start">
                                <div class="col-8">
                                    <h5 class="card-title mb-9 fw-semibold"> Total Spent </h5>
                                    <h4 class="fw-semibold mb-3">NGN {{ number_format($stats['spent'], 2) }}</h4>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex justify-content-end">
                                        <div
                                            class="text-white bg-warning rounded-circle p-6 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-cash fs-6"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-6 col-sm-12">
                    <!-- Monthly Earnings -->
                    <div class="card">
                        <div class="card-body">
                            <div class="row alig n-items-start">
                                <div class="col-8">
                                    <h5 class="card-title mb-9 fw-semibold"> Total Invoice </h5>
                                    <h4 class="fw-semibold mb-3">NGN {{ number_format($stats['total_invoice'], 2) }}</h4>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex justify-content-end">
                                        <div
                                            class="text-white bg-danger rounded-circle p-6 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-cash fs-6"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  Row 2 -->
    <div class="row">
        <div class="col-lg-12 d-flex align-items-strech">
            <div class="card w-100">
                <div class="card-body">
                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-7">
                        <div class="mb-3 mb-sm-0">
                            <h5 class="card-title fw-semibold">Requests</h5>
                        </div>

                    </div>
                    <div class="table-responsive">
                        <table class="table align-middle text-nowrap mb-0 dt">
                            <thead>
                                <tr class="text-muted fw-semibold">
                                    <th scope="col" class="ps-0">Device</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody class="border-top">
                                @foreach ($requests as $request)
                                <tr>
                                    <td class="ps-0">
                                        <div class="d-flex align-items-center">
                                            {{ $request->device->name }}
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge fw-semibold py-1 w-85 {{ $request->status == 'pending' ? 'bg-light-danger text-danger' : ($request->status == 'attending' ? 'bg-light-warning text-warning' : 'bg-light-success text-success') }}">{{ ucfirst($request->status) }}</span>
                                    </td>
                                    <td>
                                        <p class="fs-3 text-dark mb-0"><a href="/user/requests/{{ $request->id }}" class="btn btn-sm btn-primary">View details</a></p>
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
@endsection
