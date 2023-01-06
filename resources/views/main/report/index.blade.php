@extends('layouts.main.index')

@section('title', 'Laporan')

@push('stylesheet')
<!-- Sweetaler2 -->
<link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-rowreorder/css/rowReorder.bootstrap4.min.css') }}">
@endpush

@push('javascript')
<!-- DataTables -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script>
$(document).ready(function() {
    $('#report-table').DataTable( {
        paging: true,
        lengthChange: true,
        searching: true,
        ordering: true,
        info: true,
        autoWidth: false,
        responsive: true,
        rowReorder: true
    } );
} );
</script>
@endpush

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Laporan</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Laporan</li>
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
                        <a href="{{ route('report.print') }}" target="blank" class="btn btn-primary">Cetak</a>
                        <hr>
                        <div class="table-responsive">
                            <table id="report-table" class="table table-bordered table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">No</th>
                                        <th>Tanggal</th>
                                        <th>ID Pesanan</th>
                                        <th>Nama Pesanan</th>
                                        <th>Nama Pelanggan</th>
                                        <th>Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $index => $report)
                                        <tr>
                                            <td>{{ $index + 1}}</td>
                                            <td>{{ $report['date'] }}</td>
                                            <td>{{ $report['order_id'] }}</td>
                                            <td>{{ $report['order_name'] }}</td>
                                            <td>{{ $report['customer_name'] }}</td>
                                            <td>{{ $report['price'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
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
