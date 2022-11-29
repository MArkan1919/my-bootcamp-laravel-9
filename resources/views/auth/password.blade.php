@extends('master')

@section('title', 'Halaman Ubah Password')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8">

                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if (session()->has('danger'))
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        {{ session('danger') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="card">
                    <div class="card-header">Change Password</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <form action="{{ route('update.password') }}" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label">Current Password</label>
                                    <input type="password" name="old_password" class="form-control @error('old_password') is-invalid @enderror">

                                    @error('old_password')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">New Password</label>
                                    <input type="password" name="new_password" class="form-control @error('new_password') is-invalid @enderror">

                                    @error('new_password')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Confirm Password</label>
                                    <input type="password" name="new_password_confirmation" class="form-control @error('new_password_confirmation') is-invalid @enderror">

                                    @error('new_password_confirmation')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-danger btn-block">Update Password</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
