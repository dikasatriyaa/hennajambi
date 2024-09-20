<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item nav-profile">
        <a href="#" class="nav-link">
          {{-- <div class="nav-profile-image">
            <img src="../assets/images/faces/face1.jpg" alt="profile" />
            <span class="login-status online"></span>
            <!--change to offline or busy as needed-->
          </div> --}}
          <div class="nav-profile-text d-flex flex-column">
            <span class="font-weight-bold mb-2">{{auth()->user()->name}}</span>
            <span class="text-secondary text-small">
              @can('not-admin')
              <form action="{{ route('changeRole') }}" method="POST">
                @csrf
                @if(auth()->user()->role == '0')
                    <button type="submit" name="role" value="2" class="btn btn-xs btn-primary mt-2">Beralih ke Akun Penjual</button>
                @else
                    <button type="submit" name="role" value="0" class="btn btn-xs btn-secondary mt-2">Kembali ke Akun User</button>
                @endif
            </form>
              @endcan
            </span>
        </div>
        
          {{-- <div class="nav-profile-text d-flex flex-column">
            <span class="font-weight-bold mb-2">{{auth()->user()->name}}</span>
            <span class="text-secondary text-small">

            </span>
          </div> --}}
          <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
        </a>
      </li>
      @can('admin') 
      <li class="nav-item">
        <a class="nav-link" href="/dashboard">
          <span class="menu-title">Dashboard</span>
          <i class="mdi mdi-home menu-icon"></i>
        </a>
      </li>         
      <li class="nav-item">
        <a class="nav-link" href="/user">
          <span class="menu-title">Data Pengguna</span>
          <i class="mdi mdi-account menu-icon"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/penyedia-jasa">
          <span class="menu-title">Data Penyedia Jasa</span>
          <i class="mdi mdi-chart-bar menu-icon"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/pengajuan">
          <span class="menu-title">Data Pengajuan Dana</span>
          <i class="mdi mdi-chart-bar menu-icon"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/dana">
          <span class="menu-title">Data Dana Masuk</span>
          <i class="mdi mdi-chart-bar menu-icon"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/laporan" target="_blank">
          <span class="menu-title">Laporan</span>
          <i class="mdi mdi-file-document-box menu-icon"></i>
        </a>
      </li>
      @endcan

      @can('user')
      <li class="nav-item">
        <a class="nav-link" href="/profile">
          <span class="menu-title">Profile</span>
          <i class="mdi mdi-chart-bar menu-icon"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/order">
          <span class="menu-title">Pesanan Saya</span>
          <i class="mdi mdi-chart-bar menu-icon"></i>
        </a>
      </li>

      @endcan

      @can('provider')
      <li class="nav-item">
        <a class="nav-link" href="/dashboard">
          <span class="menu-title">Dashboard</span>
          <i class="mdi mdi-home menu-icon"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/toko">
          <span class="menu-title">Data Toko</span>
          <i class="mdi mdi-chart-bar menu-icon"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/service">
          <span class="menu-title">Penawaran Jasa</span>
          <i class="mdi mdi-account menu-icon"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/pembayaran">
          <span class="menu-title">Daftar Pembayaran</span>
          <i class="mdi mdi-chart-bar menu-icon"></i>
        </a>
      </li>
      @endcan
      
    </ul>
  </nav>