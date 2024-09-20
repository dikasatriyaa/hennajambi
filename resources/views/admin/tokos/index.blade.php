@extends('admin.layout.main')

@section('content')

<div class="content-wrapper">
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
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> User /</span> Profile Toko</h4>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Profile Toko</h5>
                    <!-- Account -->
                    <form id="toko-data" action="{{ isset($tokos) ? route('toko.update', $tokos->id) : route('toko.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if (isset($tokos))
                            @method('PUT')
                        @endif

                        <input type="hidden" name="user_id" id="user_id" value="{{ auth()->user()->id }}">

                        <div class="card-body">
                            <div class="row">
                                <div class="mb-3 col-md-12">
                                    <label for="name" class="form-label">Nama Toko</label>
                                    <input class="form-control" type="text" id="name" name="name" value="{{ isset($tokos->name) ? $tokos->name : '' }}" autofocus>
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label for="deskripsi" class="form-label">Deskripsi</label>
                                    <input class="form-control" type="text" id="deskripsi" name="deskripsi" value="{{ isset($tokos->deskripsi) ? $tokos->deskripsi : '' }}">
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <textarea class="form-control" id="alamat" name="alamat" rows="3">{{ isset($tokos->alamat) ? $tokos->alamat : '' }}</textarea>
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label for="map" class="form-label">Lokasi Toko</label>
                                    <div id="map" style="height: 400px;"></div>
                                    <input type="hidden" id="lat" name="lat" >
                                    <input type="hidden" id="long" name="long">
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label for="search" class="form-label">Cari Lokasi</label>
                                    <input class="form-control" type="text" id="search" placeholder="Masukkan lokasi...">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="kec" class="form-label">Kecamatan</label>
                                    <input class="form-control" type="text" id="kec" name="kec" value="{{ isset($tokos->kec) ? $tokos->kec : '' }}">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="kel" class="form-label">Kelurahan</label>
                                    <input class="form-control" type="text" id="kel" name="kel" value="{{ isset($tokos->kel) ? $tokos->kel : '' }}">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="provinsi" class="form-label">Provinsi</label>
                                    <input class="form-control" type="text" id="provinsi" name="provinsi" value="{{ isset($tokos->provinsi) ? $tokos->provinsi : '' }}">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="phone_number" class="form-label">Nomor HP</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text">ID (+62)</span>
                                        <input type="text" id="phone_number" name="phone_number" class="form-control" placeholder="823 7171 0725" value="{{ isset($tokos->phone_number) ? $tokos->phone_number : '' }}">
                                    </div>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="no_rekening" class="form-label">Nomor Rekening</label>
                                    <input class="form-control" type="text" id="no_rekening" name="no_rekening" placeholder="Nomor Rekening" value="{{ isset($tokos->no_rekening) ? $tokos->no_rekening : '' }}">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="nama_bank" class="form-label">Nama Bank</label>
                                    <input class="form-control" type="text" id="nama_bank" name="nama_bank" placeholder="Nama Bank" value="{{ isset($tokos->nama_bank) ? $tokos->nama_bank : '' }}">
                                </div>
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2" {{ isset($toko) ? 'Update' : 'Save changes' }}>Submit</button>
                                <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                            </div>
                        </div>
                    </form>
                    <!-- /Account -->
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // AJAX Request to check and fetch toko data
        var userId = document.getElementById('user_id').value;
        $.ajax({
            url: '{{ route('toko.getToko') }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                user_id: userId
            },
            success: function(response) {
                console.log(response)
                if (response.length > 0) {
                    var toko = response[0]; // Assuming there is only one record

                    // Convert string to float
                    var latitude = parseFloat(toko.lat);
                    var longitude = parseFloat(toko.long);

                    // Update form fields
                    document.getElementById('name').value = toko.name || '';
                    document.getElementById('deskripsi').value = toko.deskripsi || '';
                    document.getElementById('alamat').value = toko.alamat || '';
                    document.getElementById('lat').value = latitude;
                    document.getElementById('long').value = longitude;
                    document.getElementById('kec').value = toko.kec || '';
                    document.getElementById('kel').value = toko.kel || '';
                    document.getElementById('provinsi').value = toko.provinsi || '';
                    document.getElementById('phone_number').value = toko.phone_number || '';
                    document.getElementById('no_rekening').value = toko.no_rekening || '';
                    document.getElementById('nama_bank').value = toko.nama_bank || '';

                    // Update the form action and button text
                    var form = document.getElementById('toko-data');
                    form.action = "{{ route('toko.update2', '') }}/" + toko.id;
                    form.querySelector('button[type="submit"]').textContent = 'Update';

                    // Initialize Map with fetched coordinates
                    var map = L.map('map').setView([latitude, longitude], 13);

                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                    }).addTo(map);

                    var marker = L.marker([latitude, longitude], {
                        draggable: true
                    }).addTo(map);

                    marker.on('dragend', function (e) {
                        document.getElementById('lat').value = marker.getLatLng().lat;
                        document.getElementById('long').value = marker.getLatLng().lng;
                    });

                    var geocoder = L.Control.Geocoder.nominatim();
                    var control = L.Control.geocoder({
                        geocoder: geocoder,
                        defaultMarkGeocode: false
                    }).on('markgeocode', function(e) {
                        var bbox = e.geocode.bbox;
                        var poly = L.polygon([
                            bbox.getSouthEast(),
                            bbox.getNorthEast(),
                            bbox.getNorthWest(),
                            bbox.getSouthWest()
                        ]).addTo(map);
                        map.fitBounds(poly.getBounds());
                        marker.setLatLng(e.geocode.center);
                        document.getElementById('lat').value = e.geocode.center.lat;
                        document.getElementById('long').value = e.geocode.center.lng;
                    }).addTo(map);

                    document.getElementById('search').addEventListener('keypress', function(e) {
                        if (e.key === 'Enter') {
                            e.preventDefault();
                            geocoder.geocode(this.value, function(results) {
                                var result = results[0];
                                if (result) {
                                    map.fitBounds(result.bbox);
                                    marker.setLatLng(result.center);
                                    document.getElementById('lat').value = result.center.lat;
                                    document.getElementById('long').value = result.center.lng;
                                }
                            });
                        }
                    });
                }
            },
            error: function(xhr) {
                console.log('AJAX Error:', xhr);
            }
        });
    });
</script>


@endsection