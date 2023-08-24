<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(){
        $data['list_data']= Transaksi::all();
        return view('laporan.index', $data);
    }

    public function show ($id){
    $produk= Produk::all();
    $user= User::all();
    $transaksi= Transaksi::findOrfail($id);
    return view('laporan.show', compact('produk','user','transaksi'),['currentTime'=>now()]);
    }


    public function batal(Request $request)
    {
    // dd($request->all());
    Transaksi::where('id', $request->delete)->delete();

    // Ambil produk berdasarkan id_produk yang diberikan
    $produk = Produk::findOrFail($request->id_produk);
    // Hitung total harga berdasarkan kuantitas dan harga produk
    $total_harga = $request->qty * $produk->Harga;

    Transaksi::create([
    'id' => $request->id,
    'id_user' => $request->id_user,
    'id_produk' => $request->id_produk,
    'kode_pesanan' => $request->kode_pesanan,
    'status' => $request->status,
    'tgl_pesanan' => $request->tgl_pesanan,
    'qty' => $request->qty,
    'total' => $total_harga,
    'alamat' =>$request-> alamat,
    ]);
    return redirect('transaksi/show')->with('success', 'Data Berhasil Dibatalkan');
    }


    public function verifikasi(Request $request, string $id)
    {
    $transaksi = Transaksi::findorfail($id);
    $transaksi_data = [
    'id' => $request->id,
    'id_user' => $request->id_user,
    'id_produk' => $request->id_produk,
    'kode_pesanan' => $request->kode_pesanan,
    'status' => $request->status,
    'tgl_pesanan' => $request->tgl_pesanan,
    'qty' => $request->qty,
    'total' => $request->total,
    'alamat' =>$request-> alamat,
    ];
    $transaksi->update($transaksi_data);
    return redirect('transaksi/show')->with('success', 'Data Berhasil Di Verifikasi');
    }

    public function destroy($id) {
    try {
    // Cari transaksi berdasarkan ID
    $transaksi = Transaksi::findOrFail($id);

    // Lakukan penghapusan transaksi
    $transaksi->delete();

    return redirect('laporan')->with('danger', 'Transaksi berhasil dihapus.');
    } catch (\Exception $e) {
    return redirect('laporan')->with('error', 'Gagal menghapus transaksi.');
    }
    }

}
