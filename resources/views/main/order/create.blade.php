@extends('layouts.main.index')

@section('title', 'Tambah Pesanan')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Tambah Pesanan</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('data-order.index') }}">Data Pesanan</a></li>
                    <li class="breadcrumb-item active">Tambah Pesanan</li>
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
                <!-- card -->
                <div class="card">
                    <!-- card-body -->
                    <div class="card-body">
                        <!-- form start -->
                        <form class="form-horizontal" method="POST" action="{{ route('data-order.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="desain" class="col-sm-2 col-form-label text-sm-right">Desain</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control @error('desain') is-invalid @enderror" id="desain" name="desain" value="{{ old('desain') }}">
                                        @error('desain')
                                        <span class="invalid-feedback" role="alert">
                                            <small>{{ $message }}</small>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="ukuran" class="col-sm-2 col-form-label text-sm-right">Ukuran</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('ukuran') is-invalid @enderror" id="ukuran" name="ukuran" value="{{ old('ukuran') }}">
                                        @error('ukuran')
                                        <span class="invalid-feedback" role="alert">
                                            <small>{{ $message }}</small>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="keterangan" class="col-sm-2 col-form-label text-sm-right">Keterangan</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan">{{ old('keterangan') }}</textarea>
                                        @error('keterangan')
                                        <span class="invalid-feedback" role="alert">
                                            <small>{{ $message }}</small>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="harga" class="col-sm-2 col-form-label text-sm-right">Harga</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" value="{{ old('harga') }}">
                                        @error('harga')
                                        <span class="invalid-feedback" role="alert">
                                            <small>{{ $message }}</small>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="status_pembayaran" class="col-sm-2 col-form-label text-sm-right">Status Pembayaran</label>
                                    <div class="col-sm-10">
                                        <select class="form-control @error('status_pembayaran') is-invalid @enderror" id="status_pembayaran" name="status_pembayaran">
                                            <option selected disabled>Pilih Status Pembayaran</option>
                                            <option value="Belum Bayar">Belum Bayar</option>
                                            <option value="Lunas">Lunas</option>
                                        </select>
                                        @error('status_pembayaran')
                                        <span class="invalid-feedback" role="alert">
                                            <small>{{ $message }}</small>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nama" class="col-sm-2 col-form-label text-sm-right">Nama</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') }}">
                                        @error('nama')
                                        <span class="invalid-feedback" role="alert">
                                            <small>{{ $message }}</small>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="telepon" class="col-sm-2 col-form-label text-sm-right">No. HP</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control @error('telepon') is-invalid @enderror" id="telepon" name="telepon" value="{{ old('telepon') }}">
                                        @error('telepon')
                                        <span class="invalid-feedback" role="alert">
                                            <small>{{ $message }}</small>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <a href="{{ route('data-order.index') }}" class="btn btn-danger">Batal</a>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
