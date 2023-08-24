<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>ChekOut</title>
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
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title mt-0 mb-3">Checkout</h4>
                                <form class="mb-0" action="{{ url('transaksi/checkout/produk') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="row">

                                        <input type="hidden" name="id_produk" value="{{ $ambilId }}">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Banyak Barang <small
                                                        class="text-danger font-13">*</small></label>
                                                <input type="number" class="form-control" required="" min="1"
                                                    name="qty">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Tanggal Pesanan <small
                                                        class="text-danger font-13">*</small></label>
                                                <input type="date" class="form-control" required=""
                                                    name="tgl_pesanan">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="pro-message">Alamat</label>
                                                <textarea class="form-control" rows="3" placeholder="Masukkan Alamat Lengkap Anda" name="alamat" required></textarea>
                                            </div>
                                        </div>

                                    </div>

                                    <button class="btn btn-dark float-right"><i class="fa fa-save">
                                            Checkout</i></button>
                                    <a href="{{ url('/') }}" class="float-right btn btn-secondary">Kembali</a>
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
