@extends('layouts.main.index')

@section('title', 'Profile Information')

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
                <h1>Profile Information</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Profile Information</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3">
                <!-- Profile Image -->
                <div class="card">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle"
                                src="dist/img/avatar.png"
                                alt="User profile picture">
                        </div>

                        <p class="text-muted text-center">Administrator</p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Email</b> <a class="float-right">{{ Auth::user()->email }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Name</b> <a class="float-right">{{ Auth::user()->name }}</a>
                            </li>
                        </ul>

                        <a href="{{ route('update-password') }}" class="btn btn-warning text-white btn-block"><b>Update Password</b></a>
                        <a class="btn btn-danger btn-block" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><b>Logout</b></a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-sm-9">
                <!-- Horizontal Form -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Form Profile Information Edit</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form class="form-horizontal" method="POST" action="{{ route('user-profile-information.update') }}">
                        @method('PUT')
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control @error('email', 'updateProfileInformation') is-invalid @enderror" id="email" name="email" value="{{ old('email') ?? Auth::user()->email }}">
                                    @error('email', 'updateProfileInformation')
                                    <span class="invalid-feedback" role="alert">
                                        <small>{{ $message }}</small>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control @error('name', 'updateProfileInformation') is-invalid @enderror" id="name" name="name" value="{{ old('name') ?? Auth::user()->name }}">
                                    @error('name', 'updateProfileInformation')
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
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
