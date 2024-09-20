@extends('admin.layout.main')

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-cash"></i>
            </span> Tambah Pembayaran
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Tambah Pembayaran <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
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
                    <h4 class="card-title">Form Tambah Pembayaran</h4>
                    <form action="{{ route('pembayarans.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="user_id">Pelanggan</label>
                                    <select id="user_id" name="user_id" class="form-control" required>
                                        <option value="">Pilih Pelanggan</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="toko_id">Toko</label>
                                    <input type="text" id="toko_id" name="toko_id" class="form-control" value="{{ auth()->user()->toko->id }}" readonly>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="service_id">Layanan</label>
                                    <select id="service_id" name="service_id" class="form-control" required>
                                        <option value="">Pilih Layanan</option>
                                        @foreach($services as $service)
                                            <option value="{{ $service->id }}">{{ $service->name }} ({{ $service->price }})</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="invoice_code">Kode Invoice</label>
                                    <input type="text" id="invoice_code" name="invoice_code" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jumlah_pesanan">Jumlah Pesanan</label>
                                    <input type="number" id="jumlah_pesanan" name="jumlah_pesanan" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="total_bayar">Total Bayar</label>
                                    <input type="number" id="total_bayar" name="total_bayar" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tanggal_booking">Tanggal Booking</label>
                                    <input type="date" id="tanggal_booking" name="tanggal_booking" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select id="status" name="status" class="form-control" required>
                                        <option value="pending">Pending</option>
                                        <option value="paid">Paid</option>
                                        <option value="cancelled">Cancelled</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <button type="submit" class="btn btn-gradient-primary btn-fw">Simpan</button>
                                <a href="{{ route('pembayaran.index') }}" class="btn btn-light">Batal</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
