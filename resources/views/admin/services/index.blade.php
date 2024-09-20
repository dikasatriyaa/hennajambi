@extends('admin.layout.main')

@section('content')
<style>
    /* Mengatur tabel agar lebar kolom tetap dan tidak melebar */
    #serviceTable {
        width: 100%; /* Menyesuaikan lebar tabel dengan kontainer */
        table-layout: fixed; /* Menetapkan lebar kolom tetap */
    }

    #serviceTable th, #serviceTable td {
        padding: 8px; /* Memberikan padding di dalam sel */
        overflow: hidden; /* Menyembunyikan teks yang melampaui lebar kolom */
        white-space: nowrap; /* Mencegah teks melompat ke baris berikutnya */
        text-overflow: ellipsis; /* Menambahkan elipsis (...) jika teks terlalu panjang */
    }

    #serviceTable td {
        text-align: left; /* Mengatur teks pada kolom rata kiri */
    }

    /* Mengatur lebar spesifik untuk kolom deskripsi */
    #serviceTable td.description-column {
        max-width: 150px; /* Menentukan lebar maksimum untuk kolom deskripsi */
    }

    /* Menyesuaikan tampilan tabel pada layar kecil */
    @media (max-width: 768px) {
        #serviceTable {
            display: block;
            overflow-x: auto;
            white-space: nowrap;
        }

        #serviceTable th, #serviceTable td {
            display: block; /* Menampilkan kolom secara blok pada layar kecil */
            width: 100%; /* Menyesuaikan lebar sel dengan kontainer */
        }
    }
</style>

<div class="content-wrapper">
    <!-- ... Bagian lainnya tetap sama ... -->
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
                        <h4 class="card-title">Data Jasa Ditawarkan</h4>
                        <div class="ml-auto">
                            <a href="/add-service" class="btn btn-gradient-success btn-fw">Tambah Data</a>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped" id="serviceTable">
                            <thead>
                                <tr>
                                    <th> Nama </th>
                                    <th> Harga </th>
                                    <th> Kategori </th>
                                    <th> Deskripsi </th>
                                    <th> Image </th>
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
</div>

<!-- Modal jika ada -->
<div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadModalLabel">Upload Data Santri</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Konten modal jika ada -->
        </div>
    </div>
</div>

@section('script')
<script>
    $(document).ready(function() {
        // Fungsi untuk memuat data menggunakan AJAX
        function loadServices() {
            $.ajax({
                url: '{{ route('services.get') }}',
                method: 'GET',
                success: function(data) {
                    console.log(data)
                    var tableBody = $('#serviceTable tbody');
                    tableBody.empty();
                    
                    $.each(data, function(index, item) {
                        var imageUrl = '{{ asset('storage') }}/' + item.image[0];
                        var row = '<tr>' +
                            '<td>' + item.name + '</td>' +
                            '<td>' + item.price + '</td>' +
                            '<td>' + item.category + '</td>' +
                            '<td class="description-column">' + item.deskripsi + '</td>' +
                            '<td><img src="' + imageUrl + '" alt="Image" width="100"></td>' +
                            '<td>' +
                                '<form action="/service/' + item.id + '" method="POST" style="display: inline-block;">' +
                                    '@csrf @method('DELETE')' +
                                    '<button type="submit" class="btn btn-danger btn-sm">Hapus</button>' +
                                '</form>' +
                            '</td>' +
                        '</tr>';
                        tableBody.append(row);
                    });
                },
                error: function(xhr) {
                    console.log('Error:', xhr.responseText);
                }
            });
        }

        // Load services when the document is ready
        loadServices();
    });
</script>
@endsection
@endsection
