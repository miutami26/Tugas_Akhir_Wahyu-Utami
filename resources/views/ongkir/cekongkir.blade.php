<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Cek-Out</title>
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

<body>

    <div class="page-wrapper">

        <!-- Page Content-->
        <div class="page-content">

            <div class="container-fluid">

                <!-- end page title end breadcrumb -->
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title mt-0 mb-3">Cek Ongkir</h4>
                                <div class="mb-0">
                                    <form action="" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Piloh Asal Kota<small
                                                            class="text-danger font-13">*</small></label>
                                                    <select name="origin" id="origin" class="form-control">
                                                        <option value="">Pilih Kota Asal</option>
                                                        @foreach ($cities as $city)
                                                            <option value="{{ $city['city_id'] }}">
                                                                {{ $city['city_name'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Pilih Kota Tujuan<small
                                                            class="text-danger font-13">*</small></label>
                                                    <select name="destination" id="destination" class="form-control">
                                                        <option value="">Pilih Kota Tujuan</option>
                                                        @foreach ($cities as $city)
                                                            <option value="{{ $city['city_id'] }}">
                                                                {{ $city['city_name'] }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Berat<small class="text-danger font-13">*</small></label>
                                                    <input type="number" class="form-control" id="weight"
                                                        name="weight">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Jasa Pengiriman<small
                                                            class="text-danger font-13">*</small></label>
                                                    <select name="courier" id="courier" class="form-control">
                                                        <option value="">Pilh Jasa Pengiriman</option>
                                                        <option value="jne">JNE</option>
                                                        <option value="pos">POS</option>
                                                        <option value="tiki">Tiki</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <!--end col-->
                                        </div>
                                        <!--end row-->


                                        <!--end col-->
                                </div>
                                <!--end row-->
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="submit" name="cekOngkir" class="btn btn-dark float-right">
                                    </div>
                                </div>

                                <!--end row-->
                                </form>
                            </div>
                            <!--end form-->
                        </div>
                        <!--end card-body-->
                    </div>
                    <!--end card-->
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                @if ($ongkir != '')
                                    <h4 class="header-title mt-0 mb-3">Cek Ongkir</h4>
                                    <ul>
                                        <li>Asal Kota {{ $ongkir['origin_details']['city_name'] }}</li>
                                        <li>Kota Tujuan {{ $ongkir['destination_details']['city_name'] }}</li>
                                        <li>Berat Paket {{ $ongkir['query']['weight'] }}</li>
                                    </ul>
                                    @foreach ($ongkir['results'] as $item)
                                        <div>
                                            <label for="name">Nama:{{ $item['name'] }}</label>
                                            @foreach ($item['costs'] as $cost)
                                                <div class="mb-3">
                                                    <label for="service"> Service: {{ $cost['service'] }}</label>
                                                    @foreach ($cost['cost'] as $harga)
                                                        <div class="mb-3">
                                                            <label for="harga">
                                                                Harga: {{ $harga['value'] }}(est:{{ $harga['etd'] }}
                                                                )
                                                            </label>

                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endforeach

                                        </div>
                                    @endforeach
                                @endif


                                <!--end billing-nav-->
                            </div>
                            <!--end card-body-->
                        </div>
                    </div>


                </div>
                <!--end col-->
            </div>
            <!--end row-->

        </div><!-- container -->


        <!--end footer-->
    </div>
    <!-- end page content -->
    </div>
    <!-- end page-wrapper -->




    <!-- jQuery  -->
    <script src="{{ url('/') }}/assets/js/jquery.min.js"></script>
    <script src="{{ url('/') }}/assets/js/jquery-ui.min.js"></script>
    <script src="{{ url('/') }}/assets/js/bootstrap.bundle.min.js"></script>
    <script src="{{ url('/') }}/assets/js/metismenu.min.js"></script>
    <script src="{{ url('/') }}/assets/js/waves.js"></script>
    <script src="{{ url('/') }}/assets/js/feather.min.js"></script>
    <script src="{{ url('/') }}/assets/js/jquery.slimscroll.min.js"></script>

    <script src="{{ url('/') }}/plugins/creditcard/card.js"></script>

    <!-- App js -->
    <script src="{{ url('/') }}/assets/js/app.js"></script>
    <script>
        new Card({
            form: document.querySelector('.bill-form'),
            container: '.card-wrapper'
        });
    </script>

</body>

</html>
