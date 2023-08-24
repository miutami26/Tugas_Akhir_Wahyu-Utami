 <header id="header" class="fixed-top d-flex align-items-center header-transparent">
     <div class="container-fluid">

         <div class="row justify-content-center align-items-center">
             <div class="col-xl-12 d-flex align-items-center justify-content-between">
                 <a class="logo"><img src="{{ url('/') }}/asset/img/logo.png" alt="" class="img-fluid "></a>

                 <!-- Uncomment below if you prefer to use an image logo -->


                 <nav id="navbar" class="navbar">
                     {{-- <ul>
                         <li><a class="nav-link scrollto active" href="{{ '/' }}">Home</a></li>
                         <li><a class="nav-link scrollto" href="{{ '/register' }}">Daftar</a></li>
                         <li><a class="nav-link scrollto " href="{{ 'login' }}">Login</a></li>
                         <li><a class="nav-link scrollto " href="{{ 'transaksi/pembayaran' }}">CheckOut</a></li>
                         <li><a class="nav-link scrollto " href="{{ 'login' }}">Logout</a></li>

                     </ul> --}}

                     <ul>
                         <li><a class="nav-link scrollto active" href="{{ '/' }}">Home</a></li>
                         {{-- <li><a class="nav-link scrollto" href="{{ 'login' }}">Login</a></li> --}}

                         @if (Route::has('login'))
                             @auth
                                 <li><a class="nav-link scrollto " href="{{ 'transaksi/pembayaran' }}">Pesanan</a></li>
                                 <li> <a href="{{ url('logout') }}" class="nav-link scrollto">Logout</a> </li>
                                 <li><a href="#" class="nav-link scrollto">Selamat Datang
                                         {{ Auth::user()->username }}</a></li>
                             @else
                                 <li> <a href="{{ route('login') }}" class="nav-link scrollto">Login</a></li>
                             @endauth
                         @endif

                     </ul>

                     <i class="bi bi-list mobile-nav-toggle"></i>
                 </nav><!-- .navbar -->
             </div>
         </div>

     </div>
 </header>

 <style>
     .navbar a,
     .navbar a:focus {
         color: #01ff5a;
     }

     #header.header-scrolled {
         background-color: rgba(247, 246, 246, 0.966);
     }

     /* Mengubah warna scroller active menjadi oranye */
     #header .navbar ul li a.active {
         color: #01ff5a;
     }
 </style>
