@extends('layouts.main.index')

@section('title', 'Update Status Pesanan')

@push('javascript')
<script>
$(document).ready(function() {
    $( "#form-update" ).submit(function( event ) {
        event.preventDefault();
        $('#btn').attr('disabled', true);

        $.ajax({
            url: $(this).attr('action'),
            type: 'PUT',
            data: {
                status: $('#status').val()
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                if(response.success) {
                    toastr.success(response.success, 'Pemberitahuan,');
                    $('#btn').attr('disabled', false);
                } else {
                    swal('Pemberitahuan', response.error);
                    $('#btn').attr('disabled', false);
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + '\n' + xhr.responseText + '\n' + thrownError);
            }
        });
    });

    $('#search').change(function (e) {
        let route = $('#search').attr('route');
        let id = $('#search').val();

        $.ajax({
            url: route,
            type: 'GET',
            data: {
                id: id,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                if (response.success) {
                    let result = response.success;
                    let badge = result.payment_status == 'Belum Lunas' ? '<span class="text-muted badge badge-danger text-white">Belum Lunas</span>' : '<span class="text-muted badge badge-success text-white">Lunas</span>';

                    $('#has_result').attr( "style", "display: block !important;" );
                    $('#has_error').attr( "style", "display: none !important;" );
                    $('#form-update').attr('action', result.routes.update_status);
                    $('#order_id').html('ID Pesanan: ' + result.id);
                    $('#design').attr('src', '{{ asset("storage/design/") }}/' + result.design);
                    $('#date').html(result.date);
                    $('#size').html(result.size);
                    $('#description').html(result.description);
                    $('#payment-status').append(badge);
                    $('#name').html(result.customer_info.name);
                    $('#phone').html(result.customer_info.phone);
                    $('#status').val(result.status);
                } else if (response.error) {
                    let result = response.error;

                    $('#has_error').attr( "style", "display: block !important;" );
                    $('#has_result').attr( "style", "display: none !important;" );
                    $('#error').html(result);
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + '\n' + xhr.responseText + '\n' + thrownError);
            }
        });
    });
});
</script>
@endpush

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Update Status Pesanan</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Update Status Pesanan</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6 offset-sm-3">
                <!-- card -->
                <div class="card p-0">
                    <!-- card-body -->
                    <div class="card-body p-0">
                        <div class="input-group">
                            <input type="text" class="form-control form-control-lg" id="search" name="search" route="{{ route('data-order.show') }}" placeholder="Tulis ID Pesanan">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-lg btn-default">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 offset-sm-3">
                <div id="has_result" style="display: none !important;" class="card card-widget collapsed-card">
                    <div class="card-header">
                        <div class="user-block">
                            <span class="username ml-0" id="order_id"></span>
                        </div>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-plus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-center align-items-center">
                            <img class="img-fluid pad" id="design" alt="Design">
                        </div>
                    </div>
                    <div class="card-footer card-comments">
                        <h5 class="username">Info Pesanan:</h5>
                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label py-0">Ukuran</label>
                            <div class="col-sm-7">
                                <p class="text-sm-right mb-0" id="size"></p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label py-0">Keterangan</label>
                            <div class="col-sm-7">
                                <div class="text-sm-right mb-0"><p class="text-justify" id="description"></p></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label py-0">Status Pembayaran</label>
                            <div class="col-sm-7">
                                <p class="text-sm-right mb-0" id="payment-status"></p>
                            </div>
                        </div>
                        <h5 class="username mt-1">Info Pelanggan:</h5>
                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label py-0">Nama</label>
                            <div class="col-sm-7">
                                <p class="text-sm-right mb-0" id="name"></p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label py-0">Telepon</label>
                            <div class="col-sm-7">
                                <p class="text-sm-right mb-0" id="phone"></p>
                            </div>
                        </div>
                        <hr>
                        <form id="form-update">
                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">Status</span>
                                </div>
                                <select class="form-control" id="status" name="status">
                                    <option value="Pesanan Dibuat">Pesanan Dibuat</option>
                                    <option value="Pesanan Diproses">Pesana Diproses</option>
                                    <option value="Pesanan Selesai">Pesanan Selesai</option>
                                </select>
                            </div>
                            <button type="submit" id="btn" class="btn btn-sm btn-primary mr-1">Simpan Perubahan</button>
                            <a href="{{ route('update.status') }}" class="btn btn-sm btn-danger ml-1">Batal</a>
                        </form>
                    </div>
                </div>
                <div id="has_error" style="display: none !important;" class="card">
                    <div class="card-body">
                        <p class="text-center" id="error"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
