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

    <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key='SB-Mid-client-oVFryhrxS5tNYVIW'></script>


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
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title mt-0 mb-3">Detail Pesanan</h4>
                                <div class="table-responsive shopping-cart">
                                    <table class="table mb-0">
                                        <tbody>
                                            <tr>
                                                <td>Nama</td>
                                                <td>: {{ $order->user->nama }}</td>
                                            </tr>
                                            <tr>
                                                <td>No Whatsapp</td>
                                                <td>: {{ $order->user->no_hp }}</td>
                                            </tr>
                                            <tr>
                                                <td>Alamat</td>
                                                <td>: {{ $order->alamat }}</td>
                                            </tr>
                                            <tr>
                                                <td>Qty</td>
                                                <td>: {{ $order->qty }}</td>
                                            </tr>


                                        </tbody>
                                    </table>
                                </div>
                                <!--end re-table-->
                                <div class="total-payment">
                                    <table class="table mb-0">
                                        <tbody>
                                            <tr>
                                                <td class="payment-title">Total Harga</td>
                                                <td>{{ $order->total }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <!--end table-->

                                    <button id="pay-button">Pay!</button>

                                    <script type="text/javascript">
                                        // For example trigger on button clicked, or any time you need
                                        var payButton = document.getElementById('pay-button');
                                        payButton.addEventListener('click', function() {
                                            // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
                                            window.snap.pay('{{ $snapToken }}');
                                            // customer will be redirected after completing payment pop-up
                                        });
                                    </script>

                                </div>
                                <!--end total-payment-->
                            </div>
                            <!--end card-body-->
                        </div>
                        <!--end card-->
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
