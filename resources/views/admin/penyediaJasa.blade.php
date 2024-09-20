@extends('admin.layout.main')

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-account-multiple"></i>
            </span> Daftar Penyedia Jasa
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                </li>
            </ul>
        </nav>
    </div>

    {{-- Notifikasi Pesan Berhasil Atau Gagal --}}
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="card-title">Data Penyedia Jasa</h4>
                    </div>

                    <table class="table table-striped" id="userTable">
                        <thead>
                            <tr>
                                <th> Nama Toko </th>
                                <th> Nama Pemilik </th>
                                <th> Nomor Rekening </th>
                                <th> Pendapatan </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($toko as $item)
                            <tr>
                                <td>{{$item->name}}</td>
                                <td>{{$item->user->name}}</td>
                                <td>{{$item->no_rekening}}</td>
                                <td>Rp {{ number_format($item->pembayarans->sum('total_bayar'), 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/print-js/1.6.0/print.min.js"></script>

@endsection
@endsection
