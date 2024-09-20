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
                                    <th> Invoice Code </th>
                                    <th> Service </th>
                                    <th> Jumlah Pesanan </th>
                                    <th> Total Bayar </th>
                                    <th> Tanggal Booking </th>
                                    <th> Status </th>
                                    <th> Status Pesanan </th>
                                    <th> Konfirmasi </th>
                                    <th> Status Pencairan </th>
                                    <th> Bukti Pencairan </th>
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
<script>
$(document).ready(function() {
    // Fungsi untuk memuat data menggunakan AJAX
    function loadPembayarans() {
        $.ajax({
            url: '{{ route('pembayarans.getByToko') }}',
            method: 'GET',
            success: function(data) {
                var tableBody = $('#pembayaranTable tbody');
                tableBody.empty();
                
                $.each(data, function(index, item) {
                    var statusPesananSelect = '<select class="form-control status-pesanan-select" data-id="' + item.id + '">' +
                        '<option value="Diterima"' + (item.status_pesanan === 'Diterima' ? ' selected' : '') + '>Diterima</option>' +
                        '<option value="Dalam Perjalanan"' + (item.status_pesanan === 'Dalam Perjalanan' ? ' selected' : '') + '>Dalam Perjalanan</option>' +
                        '<option value="Pengerjaan"' + (item.status_pesanan === 'Pengerjaan' ? ' selected' : '') + '>Pengerjaan</option>' +
                        '<option value="Selesai"' + (item.status_pesanan === 'Selesai' ? ' selected' : '') + '>Selesai</option>' +
                        '</select>';
                    
                    var konfirmasiButton = '<button class="btn btn-sm ' + (item.konfirmasi === 'Selesai' ? 'btn-success' : 'btn-danger') + ' confirm-button" data-id="' + item.id + '" ' + (item.konfirmasi === 'Selesai' ? 'disabled' : '') + '>' +
                            (item.konfirmasi === 'Selesai' ? 'Selesai' : 'Belum Selesai') +
                            '</button>';
                    
                            var statusPencairanButton;
                            if (item.status_pencairan === 'Diajukan') {
                                statusPencairanButton = '<button class="btn btn-sm btn-warning" disabled>' + item.status_pencairan + '</button>';
                            } else if (item.status_pencairan === 'Dikonfirmasi') {
                                statusPencairanButton = '<button class="btn btn-sm btn-success" disabled>' + item.status_pencairan + '</button>';
                            }
                            else {
                                statusPencairanButton = '<button class="btn btn-sm ' + (item.status_pesanan === 'Selesai' && item.konfirmasi === 'Selesai' ? 'btn-primary' : 'btn-secondary') + ' ajukan-button" data-id="' + item.id + '" ' + (item.status_pesanan === 'Selesai' && item.konfirmasi === 'Selesai' ? '' : 'disabled') + '>' +
                                        'Ajukan' +
                                        '</button>';
                            }
                            var buktiPencairan = item.bukti_pencairan ? '<a href="' + '{{ asset('storage') }}/' + item.bukti_pencairan + '" target="_blank">' +
                                              '<img src="' + '{{ asset('storage') }}/' + item.bukti_pencairan + '" alt="Bukti Pencairan" style="width: 50px; height: 50px;">' +
                                              '</a>' : 'Tidak Ada';

                    var row = '<tr>' +
                        '<td>' + item.invoice_code + '</td>' +
                        '<td>' + item.service.name + '</td>' +
                        '<td>' + item.jumlah_pesanan + '</td>' +
                        '<td>' + item.total_bayar + '</td>' +
                        '<td>' + item.tanggal_booking + '</td>' +
                        '<td>' + item.status + '</td>' +
                        '<td>' + statusPesananSelect + '</td>' +
                        '<td>' + item.konfirmasi + '</td>' +
                        '<td>' + statusPencairanButton + '</td>' +
                        '<td>' + buktiPencairan + '</td>' +
                    '</tr>';
                    tableBody.append(row);
                });

                // Handle status pesanan change
                $(document).on('change', '.status-pesanan-select', function() {
                    var paymentId = $(this).data('id');
                    var newStatusPesanan = $(this).val();
                    var button = $(this).closest('tr').find('.ajukan-button');

                    $.ajax({
                        url: '/pembayarans/status-pesanan/' + paymentId,
                        method: 'PUT',
                        data: {
                            _token: '{{ csrf_token() }}',
                            status_pesanan: newStatusPesanan
                        },
                        success: function(response) {
                            if (newStatusPesanan === 'Selesai') {
                                if (button.siblings('.confirm-button').text() === 'Selesai') {
                                    button.removeClass('btn-secondary').addClass('btn-primary').removeAttr('disabled');
                                }
                            } else {
                                button.removeClass('btn-primary').addClass('btn-secondary').attr('disabled', true);
                            }
                        },
                        error: function(xhr) {
                            console.log('Error updating status pesanan:', xhr.responseText);
                        }
                    });
                });

                // Handle konfirmasi button click
                $(document).on('click', '.confirm-button', function() {
                    var paymentId = $(this).data('id');
                    var button = $(this);
                    var ajukanButton = button.closest('tr').find('.ajukan-button');

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
                                    if (button.closest('tr').find('.status-pesanan-select').val() === 'Selesai') {
                                        ajukanButton.removeClass('btn-secondary').addClass('btn-primary').removeAttr('disabled');
                                    }
                                    alert('Pesanan telah dikonfirmasi selesai.');
                                },
                                error: function(xhr) {
                                    console.log('Error updating confirmation:', xhr.responseText);
                                }
                            });
                        }
                    }
                });

                // Handle ajukan button click
                $(document).on('click', '.ajukan-button', function() {
                    var paymentId = $(this).data('id');
                    var button = $(this);

                    if (button.text() === 'Ajukan') {
                        if (confirm('Anda yakin ingin mengajukan pencairan?')) {
                            $.ajax({
                                url: '/pembayarans/ajukan-pencairan/' + paymentId,
                                method: 'POST',
                                data: {
                                    _token: '{{ csrf_token() }}'
                                },
                                success: function(response) {
                                    button.text('Diajukan').removeClass('btn-primary').addClass('btn-warning').attr('disabled', true);
                                    alert('Pencairan telah diajukan.');
                                },
                                error: function(xhr) {
                                    console.log('Error submitting pencairan:', xhr.responseText);
                                }
                            });
                        }
                    }
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
