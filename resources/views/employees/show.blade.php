@extends('master')

@section('title', 'Halaman Show')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="mb-3 text-center">
                                <img src="{{ asset('storage/' . $employee->image) }}" class="rounded" width="50%">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" value="{{ $employee->name }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="text" class="form-control" name="email" value="{{ $employee->email }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Gender</label>
                                <input type="text" class="form-control" name="gender" value="{{ $employee->gender }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Address</label>
                                <input type="text" class="form-control" name="address" value="{{ $employee->address }}" readonly>
                            </div>
                            <hr>
                            <a href="{{ route('employees.index') }}" class="btn btn-danger btn-block">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
