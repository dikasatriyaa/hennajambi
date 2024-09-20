<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>HennaJambi</title>
    {{-- Dropzone CSS --}}
    <link rel="stylesheet" href="{{asset('./assets/js/dropzone/min/dropzone.min.css')}}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/print-js/1.6.0/print.min.js"></script>
    <!-- plugins:css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="{{asset('./assets/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('./assets/vendors/ti-icons/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('./assets/vendors/css/vendor.bundle.base.css')}}">
    <link rel="stylesheet" href="{{asset('./assets/vendors/font-awesome/css/font-awesome.min.css')}}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{asset('./assets/vendors/font-awesome/css/font-awesome.min.css')}}" />
    <link rel="stylesheet" href="{{asset('./assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css')}}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{asset('./assets/css/style.css')}}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{asset('./assets/images/favicon.png')}}" />

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
    crossorigin=""/>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
      @include('admin.partials.navbar')
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        @include('admin.partials.sidebar')
        <!-- partial -->
        <div class="main-panel">
        
            @yield('content')
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2023 <a href="https://www.bootstrapdash.com/" target="_blank">BootstrapDash</a>. All rights reserved.</span>
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="mdi mdi-heart text-danger"></i></span>
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <!-- container-scroller -->
    <!-- Include Select2 CSS -->
    <!-- plugins:js -->
    <script src="{{asset('./assets/vendors/js/vendor.bundle.base.js')}}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{asset('./assets/vendors/chart.js/chart.umd.js')}}"></script>
    <script src="{{asset('./assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{asset('./assets/js/off-canvas.js')}}"></script>
    <script src="{{asset('./assets/js/misc.js')}}"></script>
    <script src="{{asset('./assets/js/settings.js')}}"></script>
    <script src="{{asset('./assets/js/todolist.js')}}"></script>
    <script src="{{asset('./assets/js/jquery.cookie.js')}}"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>

    <script src="{{asset('./assets/js/dashboard.js')}}"></script>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="//cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    @yield('scripts')

    <script src="{{asset('./assets/js/santri.js')}}"></script>
    <script src="{{asset('./assets/js/dropzone/min/dropzone.min.js')}}"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap5.js"></script>
    <script>
        let table = new DataTable('#myTable');
      </script>
      <script src="{{asset('./assets/js/file-upload.js')}}"></script>
      <script src="{{asset('./assets/js/typeahead.js')}}"></script>
      <script src="{{asset('./assets/js/select2.js')}}"></script>
      <script src="{{asset('./jquery.js')}}"></script>
      <script src="{{asset('./pages-account-settings-account.js')}}"/></script>
      <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
      integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
      crossorigin=""></script>
      <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
      <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    <!-- End custom js for this page -->

    {{-- <script src="{{asset('./assets/vendors/js/vendor.bundle.base.js')}}"></script>
    <script src="{{asset('./assets/vendors/chart.js/chart.umd.js')}}"></script>
    <script src="{{asset('./assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('./assets/js/off-canvas.js')}}"></script>
    <script src="{{asset('./assets/js/misc.js')}}"></script>
    <script src="{{asset('./assets/js/settings.js')}}"></script>
    <script src="{{asset('./assets/js/todolist.js')}}"></script>
    <script src="{{asset('./assets/js/jquery.cookie.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>
    <script src="{{asset('./assets/js/chart.js')}}"></script>
    <script src="{{asset('./assets/js/dashboard.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{asset('./assets/js/dropzone/min/dropzone.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap5.js"></script>
    <script>
      let table = new DataTable('#myTable');
    </script>
    <script src="{{asset('./assets/js/file-upload.js')}}"></script>
    <script src="{{asset('./assets/js/typeahead.js')}}"></script>
    <script src="{{asset('./assets/js/select2.js')}}"></script>
    <script src="{{asset('./jquery.js')}}"></script>
    <script src="{{asset('./pages-account-settings-account.js')}}"/></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
    crossorigin=""></script>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script> --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var lat = position.coords.latitude;
                    var long = position.coords.longitude;
                    initializeMap(lat, long);
                }, function(error) {
                    console.error('Error getting location:', error);
                    initializeMap(-6.200000, 106.816666); // Default to Jakarta if location access is denied
                });
            } else {
                console.error('Geolocation is not supported by this browser.');
                initializeMap(-6.200000, 106.816666); // Default to Jakarta if geolocation is not supported
            }

            function initializeMap(lat, long) {
                var map = L.map('map').setView([lat, long], 13);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);

                var geocoder = L.Control.geocoder({
                    defaultMarkGeocode: false
                }).on('markgeocode', function(e) {
                    var latlng = e.geocode.center;
                    map.setView(latlng, 13);
                    if (marker) {
                        map.removeLayer(marker);
                    }
                    marker = L.marker(latlng).addTo(map);
                    document.getElementById('lat').value = latlng.lat;
                    document.getElementById('long').value = latlng.lng;
                }).addTo(map);

                var marker = L.marker([lat, long]).addTo(map);
                document.getElementById('lat').value = lat;
                document.getElementById('long').value = long;

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

                var searchBox = document.getElementById('search');
                searchBox.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        e.preventDefault();
                        geocoder.options.geocoder.geocode(searchBox.value, function(results) {
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

                @if (isset($tokos->lat) && isset($tokos->long))
                    var savedLat = {{ $tokos->lat }};
                    var savedLong = {{ $tokos->long }};
                    marker = L.marker([savedLat, savedLong]).addTo(map);
                    map.setView([savedLat, savedLong], 13);
                @endif
            }
        });
    </script>
  </body>




  {{-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        var map = L.map('map').setView([-6.200000, 106.816666], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var marker;

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

        @if (isset($tokos->lat) && isset($tokos->long))
            var savedLat = {{ $tokos->lat }};
            var savedLong = {{ $tokos->long }};
            marker = L.marker([savedLat, savedLong]).addTo(map);
            map.setView([savedLat, savedLong], 13);
        @endif
    });
</script> --}}
    @yield('script')

</html>