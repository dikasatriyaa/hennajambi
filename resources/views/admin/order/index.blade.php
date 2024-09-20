@extends('admin.layout.main')

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-cash"></i>
            </span> Daftar Pembayaran
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
                        <h4 class="card-title">Data Pembayaran</h4>
                    </div>

                    <div class="table-responsive">

                        <table class="table table-striped" id="pembayaranTable">
                            <thead>
                                <tr>
                                    <th> Nomor Pembayaran </th>
                                    <th> Nama Pesanan </th>
                                    <th> Jumlah Bayar </th>
                                    <th> Tanggal Booking </th>
                                    <th> Status </th>
                                    <th> Status Pesanan </th>
                                    <th> Cetak Nota </th>
                                    <th> Konfirmasi </th>
                                    <th> Kontak </th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Data akan dimuat menggunakan AJAX -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/print-js/1.6.0/print.min.js"></script>

<script>
$(document).ready(function() {
    function loadPembayarans() {
        $.ajax({
            url: '/get-order',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                id: {{ Auth::id() }} // Menggunakan ID pengguna yang sedang login
            },
            success: function(data) {
                var tableBody = $('#pembayaranTable tbody');
                tableBody.empty();

                $.each(data, function(index, item) {
                    var row = '<tr>' +
                        '<td>' + item.invoice_code + '</td>' +
                        '<td>' + item.service.name + '</td>' +
                        '<td>' + item.total_bayar + '</td>' +
                        '<td>' + item.tanggal_booking + '</td>' +
                        '<td>' + item.status + '</td>' +
                        '<td>' + item.status_pesanan + '</td>' +
                        '<td><button class="btn btn-primary btn-sm print-button" data-id="' + item.id + '">Cetak Nota</button></td>' +
                        '<td>' +
                            '<button class="btn btn-sm ' + (item.konfirmasi === 'Selesai' ? 'btn-success' : 'btn-danger') + ' confirm-button" data-id="' + item.id + '" ' + (item.konfirmasi === 'Selesai' ? 'disabled' : '') + '>' +
                            (item.konfirmasi === 'Selesai' ? 'Selesai' : 'Belum Selesai') +
                            '</button>' +
                        '</td>' +
                        '<td>' +
            '<a href="https://wa.me/' + item.no_hp + '" target="_blank" class="btn btn-sm btn-success">' +
            '<i class="fa fa-whatsapp"></i> WhatsApp' +
            '</a>' +
        '</td>' +
                    '</tr>';
                    tableBody.append(row);
                });

                // Attach click event handler to the confirmation buttons
                $(document).on('click', '.confirm-button', function() {
                    var paymentId = $(this).data('id');
                    var button = $(this);

                    if (button.text() === 'Belum Selesai') {
                        if (confirm('Anda Yakin Bahwa Pesanan Anda Telah Selesai Dikerjakan oleh Penyedia Jasa?')) {
                            $.ajax({
                                url: '/pembayarans/konfirmasi/' + paymentId,
                                method: 'PUT',
                                data: {
                                    _token: '{{ csrf_token() }}',
                                    konfirmasi: 'Selesai'
                                },
                                success: function(response) {
                                    button.text('Selesai').removeClass('btn-danger').addClass('btn-success').attr('disabled', true);
                                    alert('Pesanan telah dikonfirmasi selesai.');
                                },
                                error: function(xhr) {
                                    console.log('Error updating confirmation:', xhr.responseText);
                                }
                            });
                        }
                    }
                });

                // Attach click event handler to the print buttons
                $(document).on('click', '.print-button', function() {
                    var paymentId = $(this).data('id');
                    var paymentData = data.find(item => item.id == paymentId);

                    // Buat konten nota yang akan dicetak
                    var notaContent = `
    <div style="max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ccc; font-family: 'Arial', sans-serif;">
        <div style="text-align: center; margin-bottom: 20px;">
            <h1 style="font-size: 24px; margin: 0; color: #333;">Nota Pembayaran</h1>
            <p style="font-size: 14px; margin: 5px 0;">Kode Invoice: <strong>${paymentData.invoice_code}</strong></p>
            <p style="font-size: 14px; margin: 5px 0;">Tanggal Booking: <strong>${paymentData.tanggal_booking}</strong></p>
        </div>
        <hr style="border: none; border-top: 1px solid #eee; margin: 20px 0;">
        <div style="margin-bottom: 20px;">
            <h2 style="font-size: 20px; color: #333;">Detail Pesanan</h2>
            <p style="font-size: 14px; margin: 5px 0;">Nama Pesanan: <strong>${paymentData.service.name}</strong></p>
            <p style="font-size: 14px; margin: 5px 0;">Total Bayar: <strong>Rp ${paymentData.total_bayar}</strong></p>
        </div>
        <hr style="border: none; border-top: 1px solid #eee; margin: 20px 0;">
        <div style="text-align: center;">
            <p style="font-size: 14px; color: #555;">Terima kasih atas kepercayaan Anda!</p>
            <p style="font-size: 14px; color: #555;">Status: <strong>${paymentData.status}</strong></p>
        </div>
    </div>
`;

// Cetak nota menggunakan print.js
printJS({
    printable: notaContent,
    type: 'raw-html',
    style: `
        body { font-family: Arial, sans-serif; color: #333; }
        h1, h2, h3, h4, h5, h6 { margin: 0; padding: 0; }
        p { margin: 0 0 10px; padding: 0; }
        .nota-header { text-align: center; margin-bottom: 20px; }
        .nota-header h1 { font-size: 24px; }
        .nota-header p { font-size: 14px; }
        .nota-section { margin-bottom: 20px; }
        .nota-section h2 { font-size: 20px; color: #333; }
        .nota-section p { font-size: 14px; }
        hr { border: none; border-top: 1px solid #eee; margin: 20px 0; }
        .nota-footer { text-align: center; }
        .nota-footer p { font-size: 14px; color: #555; }
    `
});

                });
            },
            error: function(xhr) {
                console.log('Error loading orders:', xhr.responseText);
            }
        });
    }

    // Load pembayarans when the document is ready
    loadPembayarans();
});
</script>
@endsection
@endsection
