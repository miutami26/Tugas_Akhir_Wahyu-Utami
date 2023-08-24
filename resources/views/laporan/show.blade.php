@extends('template.base')

@section('content')
    <section class="content">
        <div class="container">
            <div class="card mt-3">
                <div class="col-md-12">
                    <div class="row">
                        <div class="invoice p-3 mb-3">
                            <!-- title row -->
                            <div class="row">
                                <div class="col-12">
                                    <h4>
                                        <i class="fas fa-globe"></i> Verifikasi Pembeli
                                        <small class="float-right">Tanggal: {{ $currentTime->format('d-m-Y') }}</small> <br>
                                        <small class="float-right">Waktu: {{ $currentTime->format('H:i:s') }}</small>
                                    </h4>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- info row -->
                            <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">
                                    <address>
                                        <b>Bank: BRI<br>
                                            <b>No. Rekening:</b> 07612 0000 000<br>
                                            <b>Metode Pembayaran:</b> Transfer Bank
                                    </address>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                            <div class="callout callout-info">
                                <h5><i class="fas fa-info"></i> Catatan:</h5>
                                <strong>Metode Pembayaran bisa dilakukan secara langsung dengan transfer pembayaran ke
                                    rekening
                                    admin yang sudah disediakan
                                    Atau melakukan pembayaran dengan cara Generate PDF dan lakukan pembayaran di Alfamart
                                    atau
                                    Indomaret terdekat yang mendukung proses pembayaran dan langkah terakhir, silakan upload
                                    bukti bayar.</strong>
                            </div>

                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
    </section>


    <div class="container">
        <div class="row">
            <div class="col-md-12 mx-auto">
                <div class="card mt-4">
                    <div class="card-body">
                        <h4 class="mt-0 header-title">Detail Pembayaran</h4>
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
                                        <label>Tanggal Pembelian</label><br>
                                        {{ $transaksi->tgl_pesanan }}
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
                                        <label>Harga Produk</label><br>
                                        Rp {{ number_format($transaksi->produk->Harga, 2, ',', '.') }}
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Total</label><br>
                                        Rp {{ number_format($transaksi->total, 2, ',', '.') }}
                                    </div>
                                </div>
                                <div class="col-md 6">
                                    <div class="form-group">
                                        <label>status pesanan</label><br>
                                        {{ $transaksi->status }}
                                        @if ($transaksi->status == 'Bayar')
                                            <h6>Mohon Tunggu Verifikasi Admin</h6>
                                        @else
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="modal-footer">
                                <a href="{{ url('laporan') }}" class="btn btn-dark float-right">Kembali</a>
                                @if ($transaksi->status == 'Bayar')
                                    <a href="{{ asset($transaksi->bayar) }}" target="_blank"><button
                                            class="btn btn-success">Lihat Bukti Bayar</button></a>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="float-right btn btn-primary " data-toggle="modal"
                                        data-target="#modal-default">
                                        Verifikasi Pesanan
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="modal-default">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{ url('laporan/verifikasi', $transaksi->id) }}"
                                                    method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Verifikasi
                                                            Pembayaran</h5>

                                                    </div>
                                                    <div class="modal-body">
                                                        <input type="hidden" name="id" value="{{ $transaksi->id }}">
                                                        <input type="hidden" name="id_user"
                                                            value="{{ $transaksi->id_user }}">
                                                        <input type="hidden" name="id_produk"
                                                            value="{{ $transaksi->id_produk }}">
                                                        <input type="hidden" name="kode_pesanan"
                                                            value="{{ $transaksi->kode_pesanan }}">
                                                        <input type="hidden" name="qty" value="{{ $transaksi->qty }}">
                                                        <input type="hidden" name="alamat"
                                                            value="{{ $transaksi->alamat }}">
                                                        <input type="hidden" name="total"
                                                            value="{{ $transaksi->total }}">
                                                        <input type="hidden" name="kode_pesanan"
                                                            value="{{ $transaksi->kode_pesanan }}">
                                                        <input type="hidden" name="tgl_pesanan"
                                                            value="{{ $transaksi->tgl_pesanan }}">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>Status</label>
                                                                <select name="status" class="form-control" required>
                                                                    <option value="" selected disabled>-- Status
                                                                        --</option>
                                                                    <option value="Selesai">Selesai</option>
                                                                    <option value="Data Tidak Sesuai">Data Tidak Sesuai
                                                                    </option>
                                                                </select>
                                                                @error('status')
                                                                    <div class="text-danger mt-2 text-sm">
                                                                        {{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <a href="{{ url('laporan/show', $transaksi->id) }}"
                                                            class="btn btn-dark float-right">Kembali</a>
                                                        <button type="submit" class="btn btn-primary">Verifikasi
                                                            Sekarang</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                @else
                                    @if ($transaksi->status == 'Selesai')
                                        <a href="{{ asset($transaksi->bayar) }}" target="_blank"><button
                                                class="btn btn-success">Lihat Bukti Bayar</button></a>
                                    @else
                                        @if ($transaksi->status == 'Batal')
                                            <span class="badge bg-danger">{{ $transaksi->status }}</span>
                                        @else
                                            @if ($transaksi->status == 'Data Tidak Sesuai')
                                                <a href="{{ asset($transaksi->bayar) }}" target="_blank"><button
                                                        class="btn btn-success">Lihat Bukti Bayar</button></a>
                                                <span class="badge bg-danger">{{ $transaksi->status }}</span>
                                            @else
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
@endsection
