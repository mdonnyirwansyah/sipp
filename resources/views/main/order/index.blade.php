@extends('layouts.main.index')

@section('title', 'Data Pesanan')

@push('stylesheet')
<!-- Sweetaler2 -->
<link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-rowreorder/css/rowReorder.bootstrap4.min.css') }}">
@endpush

@push('javascript')
<!-- Sweetaler2 -->
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<!-- DataTables -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script>
$(document).ready(function() {
    $('#orders-table').DataTable({
        processing: true,
        serverSide: true,
        paging: true,
        lengthChange: true,
        searching: true,
        ordering: true,
        info: true,
        autoWidth: false,
        responsive: true,
        rowReorder: true,
        ajax: {
            url: '{{ route('data-order.get-data') }}',
            type: 'GET',
        },
        columns: [
            {
                data: 'DT_RowIndex',
                width: 50,
                orderable: false,
                searchable: false
            },
            {data: 'date', name: 'date'},
            {data: 'order_id', name: 'order_id'},
            {data: 'order_name', name: 'order_name'},
            {data: 'customer_name', name: 'customer_name'},
            {data: 'price', name: 'price'},
            {data: 'status', name: 'status'},
            {data: 'payment_status', name: 'payment_status'},
            {
                data: 'action',
                name: 'action',
                width: 75,
                orderable: false,
                searchable: false
            }
        ]
    });
});
</script>

<script>
function handleDelete(id) {
    let route = $(`#${id}`).attr('route');
    Swal.fire({
        title: 'Apakah anda yakin?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: route,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    if (response.success) {
                        $('#orders-table').DataTable().draw();
                        toastr.success(response.success, 'Pemberitahuan,');
                    } else {
                        toastr.error('Something when wrong...');
                    }
                },
            });
        }
    })
}
</script>

@if($message = Session::get('success'))
<script>
  toastr.success('{{ $message }}', 'Pemberitahuan,');
</script>
@endif
@endpush

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Data Pesanan</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Data Pesanan</li>
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
                        <a href="{{ route('data-order.create') }}" class="btn btn-primary">Tambah Pesanan</a>
                        <hr>
                        <div class="table-responsive">
                            <table id="orders-table" class="table table-bordered table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">No</th>
                                        <th>Tanggal</th>
                                        <th>ID Pesanan</th>
                                        <th>Nama Pesanan</th>
                                        <th>Nama Pelanggan</th>
                                        <th>Harga</th>
                                        <th>Status Pesanan</th>
                                        <th>Status Pembayaran</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>


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
