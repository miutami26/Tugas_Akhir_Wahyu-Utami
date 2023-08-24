<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Detail Produk</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ url('/') }}/assets/images/gm.png" />

    <!-- App css -->
    <link href="{{ url('/') }}/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ url('/') }}/assets/css/jquery-ui.min.css" rel="stylesheet">
    <link href="{{ url('/') }}/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ url('/') }}/assets/css/metisMenu.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ url('/') }}/assets/css/app.min.css" rel="stylesheet" type="text/css" />

</head>

{{-- <body>

    <div class="container">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Detail Produk</h4>
                </div>
                <!--end page-title-box-->
            </div>
            <!--end col-->
        </div>
        <!-- end page title end breadcrumb -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <img src="{{ asset($produk->foto) }}" alt="{{ $produk->foto }}"
                                    class=" mx-auto  d-block" height="300">

                            </div>
                            <!--end col-->
                            <div class="col-lg-6 align-self-center">
                                <div class="single-pro-detail">
                                    <h4>{{ $produk->Nama_produk }}</h4>
                                    <p>
                                        Rp {{ number_format($produk->Harga, 2, ',', '.') }}


                                    </p>
                                    <p>
                                        Stok : {{ $produk->Stok }}
                                    </p>
                                    <p>
                                        Berat:
                                        @if ($produk->Berat >= 1000)
                                            {{ number_format($produk->Berat / 1000, 1, ',', '.') }} kg
                                        @else
                                            {{ $produk->Berat }} gram
                                        @endif
                                    </p>
                                    {{-- <p> Warna : {{ $produk->warna }}</p> --}}
{{-- <a href="{{ url('transaksi/checkout', $produk->id) }}" class="btn btn-warning">
                                        Pesan Sekarang
                                    </a>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <p>
                                                Deskripsi : {!! nl2br($produk->deskripsi) !!}<br>
                                            </p>
                                        </div>
                                        <div class="quantity mt-3 ">

                                            <a href="{{ url('/') }}"
                                                class="btn btn-gradient-primary text-white px-4 d-inline-block"><i
                                                    class=" mr-2"></i>Kembali</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end col-->

                        </div>
                        <!--end row-->

                    </div>
                    <!--end card-body-->
                </div>
                <!--end card-->
            </div>
            <!--end col-->
        </div>
        <!--end row-->





        <!-- jQuery  -->
        <script src="{{ url('/') }}/assets/js/jquery.min.js"></script>
        <script src="{{ url('/') }}/assets/js/jquery-ui.min.js"></script>
        <script src="{{ url('/') }}/assets/js/bootstrap.bundle.min.js"></script>
        <script src="{{ url('/') }}/assets/js/metismenu.min.js"></script>
        <script src="{{ url('/') }}/assets/js/waves.js"></script>
        <script src="{{ url('/') }}/assets/js/feather.min.js"></script>
        <script src="{{ url('/') }}/assets/js/jquery.slimscroll.min.js"></script>


        <!-- App js -->
        <script src="{{ url('/') }}/assets/js/app.js"></script>

</body> --}}

</html>
