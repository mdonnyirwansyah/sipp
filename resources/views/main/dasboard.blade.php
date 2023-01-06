@extends('layouts.main.index')

@section('title', 'Dashboard')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="media">
                            <img src="{{ asset('dist/img/logo.png') }}" style="width: 64px" class="mr-3" alt="Logo">
                            <div class="media-body">
                                <h5 class="mt-0"><strong>CV. Al Harits Corp</strong></h5>
                                <p class="text-justify">Didirikan oleh Sandy Prastiady pada tahun 2022, bergerak dalam bidang periklanan, kimia air, dan konstruksi. Berawal dari berakhirnya masa kerja pemilik pada suatu perusahaan. Setelah itu beliau mendapat ide untuk menyalurkannya untuk di komersilkan. Pertama kali hasil produksi tersebut dijual hand to hand, dari teman, saudara.</p>
                            </div>
                        </div>
                        <div>
                            <h6><strong>Visi dan Misi Perusahaan</strong></h6>
                            <ul>
                                <li>Visi Perusahaan</li>
                                <ul>
                                    <li>Menjadi perusahaan terbesar dan terbaik dikalangannya</li>
                                    <li>Berkembang maju dan berkomitmen kuat serta konsisten dalam memenuhi kebutuhan klien</li>
                                </ul>
                                <li>Misi Perusahaan</li>
                                <ul>
                                    <li>Meningkatkan sumberdaya manusia secara berkesinambungan</li>
                                    <li>Inovasi teknologi dibidang perdagangan besar terutama periklanan, bahan kimia air, dan konstruksi</li>
                                    <li>Memperluas jaringan dengan industry dan masyarakat</li>
                                </ul>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /.content -->
@endsection
