<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Pesanan</title>
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
                                <h4 class="header-title mt-0 mb-3">Cek-Out Pesanan</h4>
                                <form action="order" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>Jumlah Pesanan<small
                                                        class="text-danger font-13">*</small></label>
                                                <input class="form-control" type="number" value="0"
                                                    id="example-number-input1" name="qty">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>Nama Pelanggan<small
                                                        class="text-danger font-13">*</small></label>
                                                <input type="text" class="form-control" id="nama" name="nama"
                                                    required value="{{ $user->nama }}">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>Nomor WhatsApp<small
                                                        class="text-danger font-13">*</small></label>
                                                <input type="text" class="form-control" name="no_hp" required
                                                    value="{{ $user->no_hp }}">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>Alamat<small class="text-danger font-13">*</small></label>
                                                <textarea name="alamat" id="" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>

                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <button type="submit" class="btn btn-primary float-right">Checkout</button>
                                </div>
                            </div>

                            </form>
                            <!--end form-->
                        </div>
                        <!--end card-body-->
                    </div>

                </div>
                <!--end col-->
            </div>
            <!--end row-->

        </div><!-- container -->

        <footer class="footer text-center text-sm-left">
            &copy; 2020 Crovex <span class="text-muted d-none d-sm-inline-block float-right">Crafted with <i
                    class="mdi mdi-heart text-danger"></i> by Mannatthemes</span>
        </footer>
        <!--end footer-->
    </div>
    <!-- end page content -->
    </div>




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
