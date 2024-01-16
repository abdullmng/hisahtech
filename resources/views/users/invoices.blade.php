@extends('layouts.app')
@section('title', 'Invoices')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                    <div class="mb-3 mb-sm-0">
                        <h5 class="card-title fw-semibold">My Invoices</h5>
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
                                        <th scope="col" class="ps-0">Item</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="border-top">
                                    @foreach ($invoices as $invoice)
                                    <tr>
                                        <td class="ps-0">
                                            {{ $invoice->item->name }}
                                        </td>
                                        <td>
                                            {{ $invoice->description }}
                                        </td>
                                        <td>
                                            <p class="mb-0 fs-3">{{ $invoice->amount }}</p>
                                        </td>
                                        <td>
                                            <span class="badge fw-semibold py-1 w-85 {{ $invoice->status == 'paid' ? 'bg-light-success text-success' : 'bg-light-danger text-danger'  }}">{{ ucfirst($invoice->status) }}</span>
                                        </td>
                                        <td>
                                            <a href="/user/invoices/{{ $invoice->id }}" class="btn btn-sm btn-primary">View invoice</a>
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
