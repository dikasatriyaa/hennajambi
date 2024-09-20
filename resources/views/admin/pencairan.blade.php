@extends('admin.layout.main')

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-file-document"></i>
            </span> Daftar Pengajuan Pencairan
        </h3>
    </div>

    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Pengajuan Pencairan</h4>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th> Invoice Code </th>
                                    <th> Service </th>
                                    <th> Jumlah Pesanan </th>
                                    <th> Nomor Rekening </th>
                                    <th> Nama Bank </th>
                                    <th> Total Bayar </th>
                                    {{-- <th> Tanggal Booking </th> --}}
                                    <th> Bukti Pencairan </th>
                                    <th> Aksi </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pengajuan as $item)
                                <tr>
                                    <td>{{ $item->invoice_code }}</td>
                                    <td>{{ $item->service->name }}</td>
                                    <td>{{ $item->jumlah_pesanan }}</td>
                                    <td>{{ $item->toko->no_rekening }}</td>
                                    <td>{{ $item->toko->nama_bank }}</td>
                                    <td>Rp {{ number_format($item->total_bayar,0, ',', '.') }}</td>
                                    {{-- <td>{{ $item->tanggal_booking }}</td> --}}
                                    <td>
                                        @if($item->bukti_pencairan)
                                            <a href="{{ asset('storage/'.$item->bukti_pencairan) }}" target="_blank">View</a>
                                        @else
                                            Tidak ada bukti
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.pengajuan.konfirmasi', $item->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="mb-3">
                                                <input type="file" name="bukti_pencairan" class="form-control">
                                            </div>
                                            <button type="submit" class="btn btn-success">Konfirmasi</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
