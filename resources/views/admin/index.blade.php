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
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white me-2">
                <i class="mdi mdi-home"></i>
            </span> Dashboard
        </h3>
        <nav aria-label="breadcrumb">
            <ul class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                </li>
            </ul>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-danger card-img-holder text-white">
                <div class="card-body">
                    <img src="{{asset('./assets/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Total Pendapatan <i class="mdi mdi-chart-line mdi-24px float-end"></i>
                    </h4>
                    <h2 id="totalPendapatan"></h2>
                    <h6 class="card-text">- Henna Jambi</h6>
                </div>
            </div>
        </div>
        <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-info card-img-holder text-white">
                <div class="card-body">
                    <img src="{{asset('./assets/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Pendapatan Minggu ini <i class="mdi mdi-bookmark-outline mdi-24px float-end"></i>
                    </h4>
                    <h2 class="mb-5" id="minggu"></h2>
                    <h6 class="card-text">-Henna Jambi</h6>
                </div>
            </div>
        </div>
        <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-success card-img-holder text-white">
                <div class="card-body">
                    <img src="{{asset('./assets/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Jumlah Order <i class="mdi mdi-diamond mdi-24px float-end"></i>
                    </h4>
                    <h2 id="jumlahOrder">
                    </h2>
                    <h6 class="card-text">- Henna Jambi</h6>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    const userId = {{Auth::id()}}; // Ganti dengan ID user yang sesuai

    $.ajax({
        url: '/pembayaran/total-bayar',
        method: 'POST',
        data: {
            user_id: userId,
            _token: '{{ csrf_token() }}'
        },
        success: function(response) {
            console.log(response)
            if (response.status === 'success') {
                $('#totalPendapatan').text('Rp ' + parseFloat(response.total_bayar).toLocaleString('id-ID', {minimumFractionDigits: 2}));
                $('#minggu').text('Rp ' + parseFloat(response.pendapatan_minggu_ini).toLocaleString('id-ID', {minimumFractionDigits: 2}));
                $('#jumlahOrder').text(parseFloat(response.jumlah_pembayaran));
            } else {
                $('#totalPendapatan').text('Belum ada data');
            }
        },
        error: function(xhr) {
          $('#totalPendapatan').text('Belum ada data');
        }
    });
});
</script>
@endsection
