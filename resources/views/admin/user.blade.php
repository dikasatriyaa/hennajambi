@extends('admin.layout.main')

@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-account-multiple"></i>
            </span> Daftar Pengguna
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
                        <h4 class="card-title">Data Pengguna</h4>
                    </div>

                    <table class="table table-striped" id="userTable">
                        <thead>
                            <tr>
                                <th> Nama </th>
                                <th> Email </th>
                                <th> Nomor Telepon </th>
                                <th> Alamat </th>
                                <th> Role </th>
                                <th> Aksi </th>
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

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/print-js/1.6.0/print.min.js"></script>
<script>
    $(document).ready(function() {
        function loadUsers() {
            $.ajax({
                url: '{{ route('users.get') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    console.log(data); // Menampilkan data di konsol untuk debugging
                    var tableBody = $('#userTable tbody');
                    tableBody.empty();
                    
                    $.each(data, function(index, user) {
                        var row = '<tr>' +
                            '<td>' + user.name + '</td>' +
                            '<td>' + user.email + '</td>' +
                            '<td>' + user.phone_number + '</td>' +
                            '<td>' + user.alamat + '</td>' +
                            '<td>' + user.role + '</td>' +
                            '<td><button class="btn btn-primary btn-sm print-button" data-id="' + user.id + '">Cetak Data</button></td>' +
                        '</tr>';
                        tableBody.append(row);
                    });

                    // Handle print button click
                    $(document).on('click', '.print-button', function() {
                        var userId = $(this).data('id');
                        var userData = data.find(user => user.id == userId);

                        // Buat konten yang akan dicetak
                        var printContent = `
                            <div>
                                <h2>Data Pengguna</h2>
                                <p>Nama: ${userData.name}</p>
                                <p>Email: ${userData.email}</p>
                                <p>Nomor Telepon: ${userData.phone_number}</p>
                                <p>Alamat: ${userData.alamat}</p>
                                <p>Role: ${userData.role}</p>
                            </div>
                        `;

                        // Cetak data pengguna menggunakan print.js
                        printJS({
                            printable: printContent,
                            type: 'raw-html',
                            style: 'body { font-family: Arial, sans-serif; }'
                        });
                    });
                },
                error: function(xhr) {
                    console.log(xhr); // Menampilkan kesalahan di konsol untuk debugging
                }
            });
        }

        // Load users when the document is ready
        loadUsers();
    });
</script>
@endsection
@endsection
