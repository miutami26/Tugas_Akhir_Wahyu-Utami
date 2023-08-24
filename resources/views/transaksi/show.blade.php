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
    <script src="path/to/jquery.min.js"></script>
    <script src="path/to/bootstrap.min.js"></script>


    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>


</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-lg-6 mx-auto">
                <div class="card mt-4">
                    <div class="card-body">
                        <div class="shadow-none p-3 mb-5 bg-light rounded">Detail Pembayaran</div>
                        <form class="form-parsley" action="#">
                            <div class="row">
                                <div class="col-md 6">
                                    <div class="form-group">
                                        <label>Nama Pembeli</label><br>
                                        {{ $transaksi->user->nama }}
                                    </div>
                                </div>

                                <div class="col-md 6">
                                    <div class="form-group">
                                        <label>Nomor Telepon</label><br>
                                        {{ $transaksi->user->no_hp }}
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md 6">
                                    <div class="form-group">
                                        <label>Nama Produk</label><br>
                                        {{ $transaksi->produk->Nama_produk }}
                                    </div>
                                </div>
                                <div class="col-md 6">
                                    <div class="form-group">
                                        <label>Harga Produk</label><br>
                                        Rp {{ number_format($transaksi->produk->Harga, 2, ',', '.') }}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md 6">
                                    <div class="form-group">
                                        <label>Jumlah Pesanan</label><br>
                                        {{ $transaksi->qty }}
                                    </div>
                                </div>
                                <div class="col-md 6">
                                    <div class="form-group">
                                        <label>Kode Pesanan</label>
                                        <br>
                                        {{ $transaksi->kode_pesanan }}
                                    </div>
                                </div>
                            </div>
                            <!--end form-group-->
                            <div class="row">
                                <div class="col-md 6">
                                    <div class="form-group">
                                        <label>Tanggal Pesanan</label><br>
                                        {{ $transaksi->tgl_pesanan }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Alamat</label><br>
                                        {{ $transaksi->alamat }}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md 6">
                                    <div class="form-group">
                                        <label>Status Pesanan</label><br>
                                        {{ $transaksi->status }}
                                        @if ($transaksi->status == 'Bayar')
                                            <h6>Mohon Tunggu Verifikasi Admin</h6>
                                        @else
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md 6">
                                    <div class="form-group">
                                        <label>Total Barang</label><br>
                                        Rp {{ number_format($transaksi->total, 2, ',', '.') }}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md 6">
                                    <div class="form-group">
                                        <label>Rekening Pembayaran</label><br>
                                        <b>Bank BRI</b> 07612 0000 000 <br>
                                        <small class="text-danger font-13">*</small< /label>Pembayaran dilakukan di
                                            No rekening ini

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-11">
                            <div class="col-md-12">
                                <div class="modal-footer">
                                    <a href="{{ url('transaksi/pembayaran') }}" class="btn btn-info">Kembali</a>
                                    @if ($transaksi->status == 'Proses')
                                        <form action="{{ route('cancel') }}" method="post"
                                            enctype="multipart/form-data"
                                            onclick="return confirm('Yakin ingin membatalkan Pesanan ini ?!');">
                                            @csrf
                                            <input type="hidden" name="delete" value="{{ $transaksi->id }}">
                                            <input type="hidden" name="id" value="{{ $transaksi->id }}">
                                            <input type="hidden" name="id_user" value="{{ $transaksi->id_user }}">
                                            <input type="hidden" name="kode_pesanan"
                                                value="{{ $transaksi->kode_pesanan }}">
                                            <input type="hidden" name="id_produk" value="{{ $transaksi->id_produk }}">
                                            <input type="hidden" name="tgl_pesanan"
                                                value="{{ $transaksi->tgl_pesanan }}">
                                            <input type="hidden" name="qty" value="{{ $transaksi->qty }}">
                                            <input type="hidden" name="alamat" value="{{ $transaksi->alamat }}">
                                            <input type="hidden" name="total" value="{{ $transaksi->total }}">
                                            <input type="hidden" name="status" value="Batal">
                                            <button class="btn btn-danger">Batalkan Pesanan</button>
                                        </form>

                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal">
                                            Bayar Pesanan
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="{{ route('lunas') }}" method="post"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Upload
                                                                bukti bayar</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <td>
                                                                <div class="inputBox">
                                                                    <h6>Total Barang :
                                                                        Rp
                                                                        {{ number_format($transaksi->total, 2, ',', '.') }}
                                                                    </h6>
                                                                    <h6>Kode Pesanan : {{ $transaksi->kode_pesanan }}
                                                                    </h6>
                                                                    <h6>Tanggal Pesanan : {{ $transaksi->tgl_pesanan }}
                                                                    </h6>
                                                                </div>

                                                                <input type="hidden" name="delete"
                                                                    value="{{ $transaksi->id }}">
                                                                <input type="hidden" name="id"
                                                                    value="{{ $transaksi->id }}">
                                                                <input type="hidden" name="kode_pesanan"
                                                                    value="{{ $transaksi->kode_pesanan }}">
                                                                <input type="hidden" name="id_produk"
                                                                    value="{{ $transaksi->id_produk }}">
                                                                <input type="hidden" name="id_user"
                                                                    value="{{ $transaksi->id_user }}">
                                                                <input type="hidden" name="alamat"
                                                                    value="{{ $transaksi->alamat }}">
                                                                <input type="hidden" name="tgl_pesanan"
                                                                    value="{{ $transaksi->tgl_pesanan }}">
                                                                <input type="hidden" name="qty"
                                                                    value="{{ $transaksi->qty }}">
                                                                <input type="hidden" name="total"
                                                                    value="{{ $transaksi->total }}">
                                                                <label for="">Upload Bukti Bayar</label>
                                                                <input type="file" name="bayar"
                                                                    class="form-control" accept="application/pdf"
                                                                    required>
                                                                <input type="hidden" name="status" value="Bayar">

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary">Bayar
                                                                Sekarang</button>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        @if ($transaksi->status == 'Bayar')
                                            <a href="{{ asset($transaksi->bayar) }}" target="_blank"><button
                                                    class="btn btn-success">Lihat Bukti Bayar</button></a>
                                        @else
                                            @if ($transaksi->status == 'Selesai')
                                                <a href="{{ asset($transaksi->bayar) }}" target="_blank"><button
                                                        class="btn btn-primary">Lihat Bukti
                                                        Bayar</button></a>
                                            @else
                                                @if ($transaksi->status == 'Batal')
                                                    <span class="badge bg-danger">Pesanan telah
                                                        di{{ $transaksi->status }}kan</span>
                                                @else
                                                    @if ($transaksi->status == 'Data Tidak Sesuai')
                                                        <a href="{{ asset($transaksi->bayar) }}"
                                                            target="_blank"><button class="btn btn-success">Lihat
                                                                Bukti Bayar</button></a>
                                                        <span class="badge bg-danger">{{ $transaksi->status }}</span>
                                                    @else
                                                    @endif
                                                @endif
                                            @endif
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
    <script src="{{ url('/') }}/plugins/jquery/jquery.min.js"></script>
    @if ($errors->any())
        <script>
            $(document).ready(function() {
                $('#modal-default').modal('show')
            })
        </script>
    @endif

</body>

</html>
