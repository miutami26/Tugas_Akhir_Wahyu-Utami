@extends('template.base')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-3">
                    <div class="card-header mb-4">
                        Daftar Pesanan
                    </div>
                    <div class="card-body">

                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th width="200px">Aksi</th>
                                    <th>Nama Pembeli</th>
                                    <th>Tanggal Pesanan</th>
                                    <th>Kode Pesanan</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list_data as $transaksi)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ url('laporan/show', $transaksi->id) }}" class="btn btn-dark"><i
                                                        class="fa fa-info"></i></a>
                                                @include('template.utils.delete', [
                                                    'url' => url('laporan/destroy', $transaksi->id),
                                                ])
                                            </div>

                                        </td>
                                        <td>{{ $transaksi->user->nama }}</td>
                                        <td>{{ $transaksi->tgl_pesanan }}</td>
                                        <td>{{ $transaksi->kode_pesanan }}</td>
                                        <td>{{ $transaksi->status }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>

                </div> <!-- end col -->
            </div> <!-- end row -->

        </div>
    </div>
@endsection
