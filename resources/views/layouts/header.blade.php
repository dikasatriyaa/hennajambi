<header>
    <!-- Header desktop -->
    <div class="container-menu-desktop">

        <div class="wrap-menu-desktop">
            <nav class="limiter-menu-desktop container">
                
                <!-- Logo desktop -->		
                <p><b>Henna Jambi</b></p>

                <!-- Menu desktop -->
                <div class="menu-desktop">
                    <ul class="main-menu">
                        <li class="active-menu">
                            <a href="/">Home</a>
                        </li>


                        <li>
                            <a href="/dashboard">Akun Saya</a>
                        </li>

                    </ul>
                </div>	

                <!-- Icon header -->
                <div class="wrap-icon-header flex-w flex-r-m">

                    @if(auth()->check())
                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart" data-notify="0">
                        <i class="zmdi zmdi-shopping-cart"></i>
                    </div>
        
        
                    <form method="POST" action="{{ route('logout') }}" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 logout-form">
                    @csrf
                        <button type="submit" class="btn-logout">
                            <i class="zmdi zmdi-power"></i>
                        </button>
                    </form>
                     @else
                     <a href="/register" class="flex-c-m stext-101 cl2 size-115 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer">
                        Sign Up
                     </a>
                     @endif
                </div>
            </nav>
        </div>	
    </div>

    <!-- Header Mobile -->
    <div class="wrap-header-mobile">
        <!-- Logo moblie -->		
        <div class="logo-mobile">
            <a href="index.html"><img src="{{asset('./style/images/icons/logo-01.png"')}} alt="IMG-LOGO"></a>
        </div>

        <!-- Icon header -->
        <div class="wrap-icon-header flex-w flex-r-m m-r-15">
            <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
                <i class="zmdi zmdi-search"></i>
            </div>

            @if(auth()->check())
            <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart" data-notify="2">
                <i class="zmdi zmdi-shopping-cart"></i>
            </div>

            <a href="#" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti" data-notify="0">
                <i class="zmdi zmdi-favorite-outline"></i>
            </a>

            <form method="POST" action="{{ route('logout') }}" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11">
                @csrf
                <button type="submit" class="btn-logout">
                    <i class="zmdi zmdi-power"></i> Logout
                </button>
            </form>
             @else
            <a href="{{ route('login') }}" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11">
                <i class="zmdi zmdi-account"></i> Login
            </a>

            <a href="{{ route('register') }}" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11">
                <i class="zmdi zmdi-account-add"></i> Sign Up
            </a>
             @endif
        </div>

        <!-- Button show menu -->
        <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
            <span class="hamburger-box">
                <span class="hamburger-inner"></span>
            </span>
        </div>
    </div>


    <!-- Menu Mobile -->
    <div class="menu-mobile">
        <ul class="topbar-mobile">
            <li>
                <div class="left-top-bar">
                    Gratis COST Delivery Pemesanan Lebih dari 10 Orang
                </div>
            </li>

        </ul>

        <ul class="main-menu-m">
            <li>
                <a href="/">Home</a>
                <span class="arrow-main-menu-m">
                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                </span>
            </li>

            <li>
                <a href="/dashboard">profile</a>
            </li>
        </ul>
    </div>

    <!-- Modal Search -->
    <div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
        <div class="container-search-header">
            <button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
                <img src="{{asset('./style/images/icons/icon-close2.png')}}" alt="CLOSE">
            </button>

            <form class="wrap-search-header flex-w p-l-15">
                <button class="flex-c-m trans-04">
                    <i class="zmdi zmdi-search"></i>
                </button>
                <input class="plh3" type="text" name="search" placeholder="Search...">
            </form>
        </div>
    </div>
</header>