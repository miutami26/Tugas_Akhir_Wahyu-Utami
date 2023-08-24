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

        <!-- Page Content-->
        <div class="page-content">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title mt-0">Detail Pesanan Anda</h4>

                                <div id="datatable" class="table table-bordered dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <table class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Produk</th>
                                                <th>Jumlah Pesanan</th>
                                                <th>Harga</th>
                                                <th>Total</th>
                                                <th>Kode Pesanan</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($list_transaksi as $transaksi)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $transaksi->produk->Nama_produk }}</td>
                                                    <td>{{ $transaksi->qty }}</td>
                                                    <td> Rp {{ number_format($transaksi->produk->Harga, 2, ',', '.') }}
                                                    </td>
                                                    {{-- <td>{{ $transaksi->produk->Harga }}</td> --}}
                                                    <td> Rp {{ number_format($transaksi->total, 2, ',', '.') }}
                                                    </td>
                                                    {{-- <td>{{ $transaksi->total }}</td> --}}
                                                    <td>{{ $transaksi->kode_pesanan }}</td>
                                                    <td>{{ $transaksi->status }}</td>
                                                    <td><a href="{{ url('transaksi/show', $transaksi) }}"
                                                            class="btn btn-succses"><i class="fa fa-eye"></i></a>&nbsp
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <!--end row-->
                            </div>
                            <!--end card-->
                        </div>
                        <!--end card-body-->
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->
            </div><!-- container -->
        </div>
        <!-- end page content -->
    </div>
</body>

</html>
