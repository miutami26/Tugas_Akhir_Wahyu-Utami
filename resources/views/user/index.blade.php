@extends('template.base')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-4">
                    <div class="card-header">
                        @if (auth()->user()->role == 'admin')
                            Data User
                            <a href="{{ url('user/create') }}" class="btn btn-dark float-right"><i class="fa fa-plus"> Tambah
                                    Data</i></a>
                        @endif
                    </div>
                    <div class="card-body">
                        <table id="datatable" class="table table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th width="200px">Aksi</th>
                                    <th>Username</th>
                                    <th>Nama</th>
                                    <th>Role</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list_user as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ url('user', $user->id) }}" class="btn btn-dark"><i
                                                        class="fa fa-info"></i></a>
                                                @if (auth()->user()->role == 'admin')
                                                    <!-- Menyembunyikan tombol edit dan delete jika user adalah staff -->
                                                    <a href="{{ url('user', $user->id) }}/edit" class="btn btn-warning"><i
                                                            class="fa fa-edit"></i></a>
                                                    @include('template.utils.delete', [
                                                        'url' => url('user', $user->id),
                                                    ])
                                                @endif
                                            </div>
                                        </td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->nama }}</td>
                                        <td>{{ $user->role }}</td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
