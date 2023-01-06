@extends('layouts.main.index')

@section('title', 'Update Password')

@push('javascript')
@if(session()->has('status'))
<script>
  toastr.success("{{ __('Successfully saved!') }}", 'Notification,');
</script>
@endif
@endpush

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Update Password</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('profile-information') }}">Profile Information</a></li>
                    <li class="breadcrumb-item active">Update Password</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Form Update Password</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form class="form-horizontal" method="POST" action="{{ route('user-password.update') }}">
                        @method('PUT')
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="current_password" class="col-sm-2 col-form-label">Current Password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" name="current_password" id="current_password">
                                    @error('current_password', 'updatePassword')
                                    <span class="invalid-feedback" role="alert">
                                        <small>{{ $message }}</small>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control @error('password', 'updatePassword') is-invalid @enderror" name="password" id="password">
                                    @error('password', 'updatePassword')
                                    <span class="invalid-feedback" role="alert">
                                        <small>{{ $message }}</small>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password_confirmation" class="col-sm-2 col-form-label">Password Confirmation</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror" name="password_confirmation" id="password_confirmation">
                                    @error('password_confirmation', 'updatePassword')
                                    <span class="invalid-feedback" role="alert">
                                        <small>{{ $message }}</small>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </form>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
