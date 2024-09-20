@extends('admin.layout.main')

@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Profile Setting</h4>
        
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
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Profile Information</h5>
                    <form id="profile-form" action="/user/profile" method="POST">
                        @csrf
                        @if (isset($user))
                        @method('PUT')
                    @endif
    
                        <div class="card-body">
                            <div class="row">
                                <div class="mb-3 col-md-12">
                                    <label for="name" class="form-label">Name</label>
                                    <input class="form-control" type="text" id="name" name="name" value="{{ old('name', $user->name) }}" autofocus>
                                    <input class="form-control" type="text" id="id" name="id" value="{{Auth()->user()->id}}" hidden>
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label for="email" class="form-label">Email</label>
                                    <input class="form-control" type="email" id="email" name="email" value="{{ old('email', $user->email) }}">
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label for="phone_number" class="form-label">Phone Number</label>
                                    <input class="form-control" type="text" id="phone_number" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}">
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <textarea class="form-control" id="alamat" name="alamat" rows="3">{{ old('alamat', $user->alamat) }}</textarea>
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label for="map" class="form-label">Lokasi</label>
                                    <div id="map" style="height: 400px;"></div>
                                    <input type="hidden" id="lat" name="lat" value="{{ old('lat', $user->lat) }}">
                                    <input type="hidden" id="long" name="long" value="{{ old('long', $user->long) }}">
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label for="search" class="form-label">Cari Lokasi</label>
                                    <input class="form-control" type="text" id="search" placeholder="Masukkan lokasi...">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="kec" class="form-label">Kecamatan</label>
                                    <input class="form-control" type="text" id="kec" name="kec" value="{{ old('kec', $user->kec) }}">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="kel" class="form-label">Kelurahan</label>
                                    <input class="form-control" type="text" id="kel" name="kel" value="{{ old('kel', $user->kel) }}">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="provinsi" class="form-label">Provinsi</label>
                                    <input class="form-control" type="text" id="provinsi" name="provinsi" value="{{ old('provinsi', $user->provinsi) }}">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="no_rekening" class="form-label">Nomor Rekening</label>
                                    <input class="form-control" type="text" id="no_rekening" name="no_rekening" value="{{ old('no_rekening', $user->no_rekening) }}">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="nama_bank" class="form-label">Nama Bank</label>
                                    <input class="form-control" type="text" id="nama_bank" name="nama_bank" value="{{ old('nama_bank', $user->nama_bank) }}">
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label for="password" class="form-label">Password</label>
                                    <input class="form-control" type="password" id="password" name="password">
                                </div>
                                <div class="mb-3 col-md-12">
                                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                                    <input class="form-control" type="password" id="password_confirmation" name="password_confirmation">
                                </div>
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Update Profile</button>
                                <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Initialize Map
        var latitude = {{ old('lat', $user->lat) }};
        var longitude = {{ old('long', $user->long) }};

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
    });
</script>

@endsection
