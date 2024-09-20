<!DOCTYPE html>
<html lang="en">
<head>
	<title>Home</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="{{asset('./style/images/icons/favicon.png')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('./style/vendor/bootstrap/css/bootstrap.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('./style/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('./style/fonts/iconic/css/material-design-iconic-font.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('./style/fonts/linearicons-v1.0.0/icon-font.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('./style/vendor/animate/animate.css')}}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{asset('./style/vendor/css-hamburgers/hamburgers.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('./style/vendor/animsition/css/animsition.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('./style/vendor/select2/select2.min.css')}}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{asset('./style/vendor/daterangepicker/daterangepicker.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('./style/vendor/slick/slick.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('./style/vendor/MagnificPopup/magnific-popup.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('./style/vendor/perfect-scrollbar/perfect-scrollbar.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('./style/css/util.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('./style/css/main.css')}}">
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
    crossorigin=""/>

	<link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
	<link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.css" />

	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

	<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-Vivql85mf5oQh8G_"></script>

<!--===============================================================================================-->
</head>
<body class="animsition">
	
	@include('layouts.header')
	@include('layouts.cart')
	@yield('content')

	<!-- Footer -->
	<footer class="bg3 p-t-75 p-b-32">
		<div class="container">

				<p class="stext-107 cl6 txt-center">
					<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a> &amp; distributed by <a href="https://themewagon.com" target="_blank">ThemeWagon</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->

				</p>
			</div>
		</div>
	</footer>


	<!-- Back to top -->
	<div class="btn-back-to-top" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="zmdi zmdi-chevron-up"></i>
		</span>
	</div>

	<!-- Modal1 -->
	<div class="wrap-modal1 js-modal1 p-t-60 p-b-20" id="productModal">
		<div class="overlay-modal1 js-hide-modal1"></div>

		<div class="container">
			<div class="bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent">
				<button class="how-pos3 hov3 trans-04 js-hide-modal1">
					<img src="{{asset('./style/images/icons/icon-close.png')}}" alt="CLOSE">
				</button>

				<div class="row">
					<div class="col-md-6 col-lg-7 p-b-30">
						<div class="p-l-25 p-r-30 p-lr-0-lg">
							<div class="wrap-slick3 flex-sb flex-w">
								<div class="wrap-slick3-dots"></div>
								<div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

								<div class="slick3 gallery-lb" id="productImagePreview">

								</div>
							</div>
						</div>
					</div>
					
					<div class="col-md-6 col-lg-5 p-b-30">
						<div class="p-r-50 p-t-5 p-lr-0-lg">
							<h4 class="mtext-105 cl2 js-name-detail " id="productName">
							</h4>
							<p id="namaToko" class="p-b-14"></p>

							<span class="mtext-106 cl2" id="productPrice">
							</span>

							<p class="stext-102 cl3 p-t-23" id="productDescription">
							</p>
							
							<!--  -->
							<div class="p-t-33">
								{{-- <div class="flex-w flex-r-m p-b-10">
									<div class="size-203 flex-c-m respon6">
										Size
									</div>

									<div class="size-204 respon6-next">
										<div class="rs1-select2 bor8 bg0">
											<select class="js-select2" name="time">
												<option>Choose an option</option>
												<option>Size S</option>
												<option>Size M</option>
												<option>Size L</option>
												<option>Size XL</option>
											</select>
											<div class="dropDownSelect2"></div>
										</div>
									</div>
								</div> --}}

								<div class="flex-w flex-r-m p-b-10">
									<div class="size-203 flex-c-m respon6">
										Color
									</div>

									<div class="size-204 respon6-next">
										<div class="rs1-select2 bor8 bg0">
											<select class="js-select2" name="time" id="colorSelect">
												<option>Choose an option</option>
												<option data-price="200000">Maroon - Tangan</option>
												<option data-price="100000">White - Tangan</option>
												<option data-price="150000">Latte - Tangan</option>
												<option data-price="250000">Maroon + Glitter - Tangan</option>
												<option data-price="300000">Maroon + Glitter - Tangan + Kaki</option>
												<option data-price="250000">Maroon - Tangan + Kaki</option>
											</select>
											<div class="dropDownSelect2"></div>
										</div>
									</div>
								</div>

								<div class="flex-w flex-r-m p-b-10">
									<div class="size-204 flex-w flex-m respon6-next">
										<div class="wrap-num-product flex-w m-r-20 m-tb-10">
											<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-minus"></i>
											</div>

											<input class="mtext-104 cl3 txt-center num-product" type="number" name="num-product" value="1">

											<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-plus"></i>
											</div>
										</div>

										<button class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
											Add to cart
										</button>
									</div>
								</div>	
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<!--===============================================================================================-->	
	<script src="{{asset('./style/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('./style/vendor/animsition/js/animsition.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('./style/vendor/bootstrap/js/popper.js')}}"></script>
	<script src="{{asset('./style/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('./style/vendor/select2/select2.min.js')}}"></script>
	<script>
		$(".js-select2").each(function(){
			$(this).select2({
				minimumResultsForSearch: 20,
				dropdownParent: $(this).next('.dropDownSelect2')
			});
		})
	</script>
<!--===============================================================================================-->
	<script src="{{asset('./style/vendor/daterangepicker/moment.min.js')}}"></script>
	<script src="{{asset('./style/vendor/daterangepicker/daterangepicker.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('./style/vendor/slick/slick.min.js')}}"></script>
	<script src="{{asset('./style/js/slick-custom.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('./style/vendor/parallax100/parallax100.js')}}"></script>
	<script>
        $('.parallax100').parallax100();
	</script>
<!--===============================================================================================-->
	<script src="{{asset('./style/vendor/MagnificPopup/jquery.magnific-popup.min.js')}}"></script>
	<script>
		$('.gallery-lb').each(function() { // the containers for all your galleries
			$(this).magnificPopup({
		        delegate: 'a', // the selector for gallery item
		        type: 'image',
		        gallery: {
		        	enabled:true
		        },
		        mainClass: 'mfp-fade'
		    });
		});
	</script>
<!--===============================================================================================-->
	<script src="{{asset('./style/vendor/isotope/isotope.pkgd.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('./style/vendor/sweetalert/sweetalert.min.js')}}"></script>
	<script>
		$('.js-addwish-b2').on('click', function(e){
			e.preventDefault();
		});

		$('.js-addwish-b2').each(function(){
			var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to wishlist !", "success");

				$(this).addClass('js-addedwish-b2');
				$(this).off('click');
			});
		});

		$('.js-addwish-detail').each(function(){
			var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').html();

			$(this).on('click', function(){
				swal(nameProduct, "is added to wishlist !", "success");

				$(this).addClass('js-addedwish-detail');
				$(this).off('click');
			});
		});

		/*---------------------------------------------*/

		$('.js-addcart-detail').each(function(){
			var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to cart !", "success");
			});
		});
	
	</script>
<!--===============================================================================================-->
	<script src="{{asset('./style/vendor/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
	<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
    crossorigin=""></script>
	<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
	<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
	<script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>
	<script>
		$('.js-pscroll').each(function(){
			$(this).css('position','relative');
			$(this).css('overflow','hidden');
			var ps = new PerfectScrollbar(this, {
				wheelSpeed: 1,
				scrollingThreshold: 1000,
				wheelPropagation: false,
			});

			$(window).on('resize', function(){
				ps.update();
			})
		});
	</script>
<!--===============================================================================================-->
	<script src="{{asset('./style/js/main.js')}}"></script>


	{{-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        var map = L.map('map').setView([-6.200000, 106.816666], 13); // Default to Jakarta

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var geocoder = L.Control.Geocoder.nominatim();
        var marker;

        var searchBox = document.getElementById('search');
        searchBox.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                geocoder.geocode(searchBox.value, function(results) {
                    if (results.length > 0) {
                        var result = results[0];
                        var latlng = result.center;
                        map.setView(latlng, 13);
                        if (marker) {
                            map.removeLayer(marker);
                        }
                        marker = L.marker(latlng).addTo(map);
                        document.getElementById('lat').value = latlng.lat;
                        document.getElementById('long').value = latlng.lng;
                    }
                });
            }
        });

        map.on('click', function(e) {
            var lat = e.latlng.lat;
            var long = e.latlng.lng;

            if (marker) {
                map.removeLayer(marker);
            }

            marker = L.marker([lat, long]).addTo(map);

            document.getElementById('lat').value = lat;
            document.getElementById('long').value = long;
        });

        document.getElementById('update-totals').addEventListener('click', function() {
            var userLat = document.getElementById('lat').value;
            var userLong = document.getElementById('long').value;

            if (!userLat || !userLong) {
                alert('Please select your location on the map.');
                return;
            }

            fetch('/calculate-shipping', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    user_lat: userLat,
                    user_long: userLong
                })
            })
            .then(response => response.json())
            .then(data => {
                var subtotal = parseFloat(document.getElementById('cart-subtotal').innerText.replace('Rp ', '').replace('.', '').replace(',', '.'));
                var total = subtotal + data.shipping_cost;

                document.getElementById('cart-total').innerText = 'Rp ' + total.toLocaleString('id-ID');
            });
        });
    });
</script>

<script>
	document.addEventListener('DOMContentLoaded', function() {
		var map = L.map('map').setView([-6.200000, 106.816666], 13); // Default to Jakarta

		L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
			attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
		}).addTo(map);

		var geocoder = L.Control.Geocoder.nominatim();
		var marker;

		var searchBox = document.getElementById('search');
		searchBox.addEventListener('keypress', function(e) {
			if (e.key === 'Enter') {
				e.preventDefault();
				geocoder.geocode(searchBox.value, function(results) {
					if (results.length > 0) {
						var result = results[0];
						var latlng = result.center;
						map.setView(latlng, 13);
						if (marker) {
							map.removeLayer(marker);
						}
						marker = L.marker(latlng).addTo(map);
						document.getElementById('lat').value = latlng.lat;
						document.getElementById('long').value = latlng.lng;
					}
				});
			}
		});

		map.on('click', function(e) {
			var lat = e.latlng.lat;
			var long = e.latlng.lng;

			if (marker) {
				map.removeLayer(marker);
			}

			marker = L.marker([lat, long]).addTo(map);

			document.getElementById('lat').value = lat;
			document.getElementById('long').value = long;
		});

		document.getElementById('update-totals').addEventListener('click', function() {
			var lat = document.getElementById('lat').value;
			var long = document.getElementById('long').value;

			if (!lat || !long) {
				alert('Please select a location.');
				return;
			}

			fetch('/calculate-shipping', {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json',
					'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
				},
				body: JSON.stringify({
					lat: lat,
					long: long
				})
			})
			.then(response => response.json())
			.then(data => {
				document.getElementById('cart-subtotal').textContent = 'Rp ' + data.subtotal;
				document.getElementById('cart-total').textContent = 'Rp ' + data.total;
			})
			.catch(error => {
				console.error('Error calculating shipping:', error);
			});
		});

		document.getElementById('check-availability').addEventListener('click', function() {
			var bookingDate = document.getElementById('booking-date').value;

			if (!bookingDate) {
				alert('Please select a date.');
				return;
			}

			fetch('/check-booking-availability', {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json',
					'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
				},
				body: JSON.stringify({
					date: bookingDate
				})
			})
			.then(response => response.json())
			.then(data => {
				if (data.available) {
					alert('The selected date is available.');
				} else {
					alert('The selected date is already booked.');
				}
			})
			.catch(error => {
				console.error('Error checking booking availability:', error);
			});
		});
	});
</script> --}}


<script>
    var defaultPrice = $('#productPrice').data('default-price'); // Simpan harga default awal


    // Fungsi untuk format harga ke Rupiah
    function formatRupiah(angka) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return 'Rp ' + rupiah;
    }
</script>


{{-- <script>
	$('#colorSelect').on('change', function() {
    var selectedOption = $(this).find('option:selected');
    var newPrice = selectedOption.data('price');
    
    if (newPrice) {
        var formattedPrice = formatRupiah(newPrice.toString());
        $('#productPrice').text(formattedPrice);
    } else {
        // Tampilkan harga default jika tidak ada warna yang dipilih
        $('#productPrice').text(formatRupiah(price));
    }
});

// Fungsi untuk format harga ke Rupiah
function formatRupiah(angka) {
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return 'Rp ' + rupiah;
}

</script> --}}

	

  
@yield('script')
  



  
</body>
</html>