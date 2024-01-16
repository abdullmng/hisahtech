@extends('layouts.app')
@section('title', 'Settings')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="mb-4">
                        <h4 class="card-title">@yield('title')</h4>
                    </div>

                    <div class="mb-4">
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">{{ $error }}</div>
                        @endforeach
                        @if (session()->has('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                    </div>

                    <form action="" method="post">
                        @csrf
                        <div class="table-responsive mb-4">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Settings Name</th>
                                        <th>Current value</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($configurations as $configuration)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $configuration->title }}</td>
                                            <td>{{ $configuration->value }}</td>
                                            <td>
                                                <input type="hidden" name="names[]" value="{{ $configuration->name }}">
                                                @if ($configuration->field_type == 'input')
                                                    <input type="text" name="values[]" id="values" value="{{ $configuration->value }}">
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mb-4"><button type="submit" class="btn btn-primary">Save</button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
