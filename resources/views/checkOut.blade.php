@extends('layouts.app')

@section('content')
<!-- breadcrumb -->
<div class="container" style="margin-top: 100px">
    <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
        <a href="index.html" class="stext-109 cl8 hov-cl1 trans-04">
            Home
            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>
        <span class="stext-109 cl4">Shopping Cart</span>
    </div>
</div>

<!-- Shopping Cart -->
<form class="bg0 p-t-75 p-b-85" id="shopping-cart-form">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                <div class="m-l-25 m-r--38 m-lr-0-xl">
                    <div class="wrap-table-shopping-cart">
                        <table class="table-shopping-cart" id="cart-items-table">
                            <tr class="table_head">
                                <th class="column-1">Product</th>
                                <th class="column-2"></th>
                                <th class="column-3">Price</th>
                                <th class="column-4">Quantity</th>
                                <th class="column-5">Total</th>
                            </tr>
                            <!-- Rows will be populated by JavaScript -->
                        </table>
                    </div>
                </div>

                <div class="m-l-25 m-r--38 m-lr-0-xl">
                    <div class="bor10 p-t-30 m-t-30 p-lr-40">
                        <h4 class="mtext-109 cl2 p-b-30">Data Pemesanan</h4>

                        <div class="flex-w flex-t bor12 p-t-15 p-b-30">
                            <div class="size-208 w-full-ssm">
                                <span class="stext-110 cl2">Pilih Tanggal</span>
                            </div>
                            <div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
                                <input type="date" id="booking-date" class="cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5">
                                <input type="text" id="invoice_code" class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5" hidden>
                                <input type="text" id="status_pesanan" value="Konfirmasi" hidden>
                            </div>

                            <div class="size-208 w-full-ssm">
                                <span class="stext-110 cl2">Nama</span>
                            </div>
                            <div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
                                <input type="text" id="nama" name="nama" class="cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5" placeholder="Nama">
                            </div>

                            <!-- Waktu Pemesanan -->
                            <div class="size-208 w-full-ssm">
                                <span class="stext-110 cl2">Waktu Acara</span>
                            </div>
                            <div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
                                <input type="time" id="waktu" name="waktu" class="cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5">
                            </div>

                            <!-- Nomor HP -->
                            <div class="size-208 w-full-ssm">
                                <span class="stext-110 cl2">Nomor HP</span>
                            </div>
                            <div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
                                <input type="text" id="no_hp" name="no_hp" class="cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5" placeholder="Nomor HP">
                            </div>

                            <!-- Alamat -->
                            <div class="size-208 w-full-ssm">
                                <span class="stext-110 cl2">Alamat</span>
                            </div>
                            <div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
                                <input type="text" id="alamat" name="alamat" class="cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5" placeholder="Alamat">
                            </div>

                            <!-- Patokan -->
                            <div class="size-208 w-full-ssm">
                                <span class="stext-110 cl2">Patokan</span>
                            </div>
                            <div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
                                <input type="text" id="patokan" name="patokan" class="cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5" placeholder="Patokan">
                            </div>

                            <!-- Kecamatan -->
                            <div class="size-208 w-full-ssm">
                                <span class="stext-110 cl2">Kecamatan</span>
                            </div>
                            <div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
                                <input type="text" id="kec" name="kec" class="cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5" placeholder="Kecamatan">
                            </div>

                            <!-- Kelurahan -->
                            <div class="size-208 w-full-ssm">
                                <span class="stext-110 cl2">Kelurahan</span>
                            </div>
                            <div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
                                <input type="text" id="kel" name="kel" class="cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5" placeholder="Kelurahan">
                            </div>

                            <!-- Provinsi (Jambi) -->
                            <div class="size-208 w-full-ssm">
                                <span class="stext-110 cl2">Provinsi</span>
                            </div>
                            <div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
                                <select id="prov" name="prov" class="cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5">
                                    <option value="Jambi">Jambi</option>
                                </select>
                            </div>

                            <!-- Kota (Kota Jambi) -->
                            <div class="size-208 w-full-ssm">
                                <span class="stext-110 cl2">Kota</span>
                            </div>
                            <div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
                                <select id="kota" name="kota" class="cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5">
                                    <option value="Kota Jambi">Kota Jambi</option>
                                </select>
                            </div>


                            <div class="size-208 w-full-ssm">
                                <div class="p-t-15">
                                    <span class="stext-110 cl2">Cari Lokasi</span>
                                </div>
                            </div>
                            <div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
                                <div>
                                    <input type="text" id="search" class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5" placeholder="Cari Lokasi">
                                </div>
                            </div>
                        </div>
                        <div class="mtext-109 cl2 p-b-30">
                            <div id="map" style="height: 400px; margin-top: 10px;"></div>
                            <input type="hidden" id="lat" name="user_lat">
                            <input type="hidden" id="long" name="user_long">
                            <div class="flex-w">
    
                            </div>
                        </div>
    
                        <div class="flex-w flex-t p-t-27 p-b-33">
                            <div class="size-208">
                                <span class="mtext-101 cl2">Jarak:</span>
                            </div>
                            <div class="size-209 p-t-1">
                                <div id="cart-distance" class="cart-distance mtext-110 cl2"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
                <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                    
                    <h4 class="mtext-109 cl2 p-b-30">Cart Totals</h4>
                    <div class="flex-w flex-t bor12 p-b-13">
                        <div class="size-208">
                            <span class="stext-110 cl2">Subtotal:</span>
                        </div>
                        <div class="size-209">
                            <span class="mtext-110 cl2" id="cart-subtotal"> <!-- Subtotal will be populated by JavaScript --> </span>
                        </div>
                        <div class="size-208">
                            <span class="mtext-101 cl2">Total:</span>
                        </div>
                        <div class="size-209 p-t-1">
                            <span class="mtext-110 cl2" id="cart-total"> <!-- Total will be populated by JavaScript --> </span>
                        </div>
                    </div>

                    <input type="text" id="user_id" value="{{ auth()->user()->id }}" hidden>

                    <button class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer" id="proceed-to-checkout">
                        Proceed to Checkout
                    </button>
                </div>
            </div>
        </div>

        
    </div>
</form>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

    <script>

            var cartData = @json($cartItems); // Laravel variable passed to JavaScript
            var tokoId = cartData.length > 0 ? cartData[0].toko_id : null;

            document.addEventListener('DOMContentLoaded', function() {
                function generateRandomString(length) {
                    const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
                    let result = '';
                    const charactersLength = characters.length;
                    for (let i = 0; i < length; i++) {
                        result += characters.charAt(Math.floor(Math.random() * charactersLength));
                    }
                    return result;
                }
                document.getElementById('invoice_code').value = generateRandomString(8);

            // Proses Check Out Midtrans
            $('#proceed-to-checkout').click(function(event) {
             event.preventDefault();

                $.ajax({
                    url: '{{ route("checkout") }}',
                    method: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        user_id: $('#user_id').val(),
                        toko_id: $('#toko_id').val(),
                        service_id: $('#service_id').val(),
                        tanggal_booking: $('#booking-date').val(),
                        user_lat: $('#lat').val(),
                        user_long: $('#long').val(),
                        jumlah_pesanan: $('#jumlah_pesanan').val(),
                        total_bayar: $('#total_pembayaran').val(),
                        invoice_code: $('#invoice_code').val() 
                    },
                    success: function(response) {
                        // console.log(response)
                        snap.pay(response.snapToken, {
                            onSuccess: function(result) {
                                // Tampilkan notifikasi berhasil
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Pembayaran Berhasil',
                                    text: 'Terima kasih telah melakukan pembayaran!',
                                    confirmButtonText: 'OK'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        // Hapus barang dari keranjang
                                        $.ajax({
                                        url: '/user/pembayaran',
                                        method: 'POST',
                                        data: {
                                            user_id: $('#user_id').val(),
                                            toko_id: $('#toko_id').val(),
                                            service_id: $('#service_id').val(),
                                            tanggal_booking: $('#booking-date').val(),
                                            waktu: $('#waktu').val(),  // Waktu pemesanan
                                            nama: $('#nama').val(),  // Nama pelanggan
                                            no_hp: $('#no_hp').val(),  // Nomor HP
                                            alamat: $('#alamat').val(),  // Alamat pelanggan
                                            patokan: $('#patokan').val(),  // Patokan lokasi
                                            kec: $('#kec').val(),  // Kecamatan
                                            kel: $('#kel').val(),  // Kelurahan
                                            prov: 'Jambi',  // Provinsi Jambi (hardcoded)
                                            kota: 'Kota Jambi',  // Kota Jambi (hardcoded)
                                            user_lat: $('#lat').val(),
                                            user_long: $('#long').val(),
                                            status_pesanan: $('#status_pesanan').val(),
                                            jumlah_pesanan: $('#jumlah_pesanan').val(),
                                            total_bayar: $('#cart-total').text().replace('Rp ', '').replace('.', ''),  // Total bayar (tanpa format Rupiah)
                                            invoice_code: $('#invoice_code').val(),
                                            status: 'paid'
                                        },

                                        success: function(response) {
                                            console.log(response)
                                            $.ajax({
                                            url: '{{ route("cart.clear") }}',
                                            method: 'POST',
                                            data: {
                                                _token: $('meta[name="csrf-token"]').attr('content')
                                            },
                                            success: function() {
                                                window.location.href = "{{ route('homepage') }}";
                                            },
                                            error: function() {
                                                alert('Terjadi kesalahan saat menghapus barang dari keranjang.');
                                            }
                                        });

                                        },
                                        error: function(xhr) {
                                            console.log(xhr); // Untuk debugging error
                                        }
                                    });
                                    }
                                });
                            },
                            onPending: function(result) {
                                // Handle onPending result
                                console.log(result);
                            },
                            onError: function(result) {
                                // Handle onError result
                                console.log(result);
                            },
                            onClose: function() {
                                // Handle onClose action
                                console.log('Customer closed the popup without finishing the payment');
                            }
                        });
                    },
                    error: function(response) {
                        alert('Terjadi kesalahan, silakan coba lagi');
                        console.log(response);
                    }
                    });
            });

            // Inisialisasi lat, long
            var map = L.map('map').setView([-1.6226, 103.5727], 13); // Set initial view to a default location

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
            }).addTo(map);

            if (tokoId) {
            fetch(`/api/toko/${tokoId}`)
            .then(response => response.json())
            .then(toko => {
                var tokoLatLng = [parseFloat(toko.lat), parseFloat(toko.long)];
                var tokoMarker = L.marker(tokoLatLng).addTo(map);
                
                tokoMarker.bindPopup('Toko: ' + toko.name).openPopup();

                // Menambahkan marker untuk lokasi pengguna
                var userMarker;
                map.on('click', function(e) {
                    if (userMarker) {
                        map.removeLayer(userMarker);
                    }
                    userMarker = L.marker(e.latlng).addTo(map);
                    document.getElementById('lat').value = e.latlng.lat;
                    document.getElementById('long').value = e.latlng.lng;
                    
                    updatePrice()
                });

                function updatePrice() {
                    var userLat = parseFloat(document.getElementById('lat').value);
                    var userLong = parseFloat(document.getElementById('long').value);
                    if (tokoLatLng) {
                        var tokoLat = tokoLatLng[0];
                        var tokoLong = tokoLatLng[1];

                        if (!isNaN(userLat) && !isNaN(userLong) && !isNaN(tokoLat) && !isNaN(tokoLong)) {
                            var userLatLng = L.latLng(userLat, userLong);
                            var tokoLatLngObj = L.latLng(tokoLat, tokoLong);
                            var distance = userLatLng.distanceTo(tokoLatLngObj) / 1000; // Jarak dalam km
                            // Tampilkan jarak dalam elemen cart-distance
                            document.getElementById('cart-distance').innerText =  distance.toFixed(2) + ' km';

                            // Menghitung biaya perjalanan berdasarkan jarak
                            var biayaPerKm = 2000;
                            var biayaPerjalanan = distance * biayaPerKm;

                            var subtotal = parseFloat(document.getElementById('cart-subtotal').innerText.replace('Rp ', '').replace(/\./g, '').replace(',', '.'));
                            var totalBiaya = subtotal + biayaPerjalanan;
                            var totalBiaya2 = Math.floor(totalBiaya)

                            document.getElementById('cart-subtotal').innerText = 'Rp ' + subtotal.toLocaleString('id-ID');
                            document.getElementById('cart-total').innerText = 'Rp ' + totalBiaya2.toLocaleString('id-ID');
                            document.getElementById('total_pembayaran').value = totalBiaya2;
                        } else {
                            alert('Mohon pastikan lokasi pengguna dan toko sudah diisi dengan benar.');
                        }
                        } else {
                            alert('Lokasi toko belum tersedia.');
                        }
                }

                // Inisialisasi geocoder
                var geocoder = L.Control.Geocoder.nominatim();
                L.Control.geocoder({
                    geocoder: geocoder
                }).addTo(map);

                // Pencarian lokasi dari input
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

                // var searchInput = document.getElementById('search');
                // searchInput.addEventListener('keypress', function(event) {
                //     if (event.key === 'Enter') {
                //         var query = searchInput.value;
                //         geocoder.geocode(query, function(results) {
                //             var result = results[0];
                //             if (result) {
                //                 map.setView(result.center, 13);
                //                 L.marker(result.center).addTo(map)
                //                     .bindPopup(result.name)
                //                     .openPopup();
                //             }
                //         });
                //     }
                // });

                // Hitung jarak saat tombol diklik

                });
            }

            

        });


    $(document).ready(function() {
    var tokoId = $('#toko_id').val(); // Ambil toko_id dari elemen yang sesuai

    // Fungsi untuk mendapatkan tanggal yang sudah dibooking
    function getBookedDates(tokoId) {
        return $.ajax({
            url: '/get-booked-dates', // Ganti dengan URL endpoint yang sesuai
            method: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                toko_id: tokoId
            }
        });
    }

    // Fungsi untuk menonaktifkan tanggal
    function disableBookedDates(bookedDates) {
        var dateInput = document.getElementById('booking-date');
        var today = new Date().toISOString().split('T')[0];
        dateInput.setAttribute('min', today);

        dateInput.addEventListener('input', function() {
            var selectedDate = dateInput.value;
            if (bookedDates.includes(selectedDate)) {
                alert('Tanggal ini sudah dibooking. Silakan pilih tanggal lain.');
                dateInput.value = '';
            }
        });

        dateInput.addEventListener('click', function() {
            var currentDate = new Date(dateInput.value);
            var popup = document.createElement('div');
            popup.className = 'date-popup';
            bookedDates.forEach(function(date) {
                
                var bookedDate = new Date(date);
                if (bookedDate >= currentDate) {
                    var day = bookedDate.getDate().toString().padStart(2, '0');
                    var month = (bookedDate.getMonth() + 1).toString().padStart(2, '0');
                    var year = bookedDate.getFullYear();
                    var dateStr = year + '-' + month + '-' + day;
                    if (dateStr >= today) {
                        var item = document.createElement('div');
                        item.className = 'date-popup-item';
                        item.innerHTML = dateStr;
                        item.style.color = 'red';
                        popup.appendChild(item);
                    }
                }
            });
            dateInput.parentNode.appendChild(popup);
        });
    }

    // Dapatkan tanggal yang sudah dibooking dan nonaktifkan tanggal tersebut
    getBookedDates(tokoId).done(function(response) {
        var bookedDates = response.booked_dates; // Sesuaikan dengan struktur data yang diterima
        disableBookedDates(bookedDates);
    });
});



    </script>
@endsection
