<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\User;
use App\Models\Promo;
use App\Models\Slide;
use App\Models\Produk;
use App\Models\Courier;
use App\Models\Kategory;
use App\Models\Province;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class ClientController extends Controller
{

    public function Template(){

        return view('templatecustomer.base');
    }
    public function index(Produk $produk, Request $request,Slide $slide, Promo $promo)
        {
        $list_slide = Slide::all();
        $list_produk = Produk::where('status', 'terima')->get();
        // $list_promo = Promo::where('status', 'diterima')->get();
        $list_slide = Slide::where('status', 'aktif')->get();
        $slide->banner = $request->file('banner')->store('images', 'public');
        $produk->foto = $request->file('produk_foto')->store('images', 'public');
        $promo->foto = $request->file('promo_foto')->store('images', 'public');

        return view('home', compact('list_slide', 'list_kategori', 'list_produk', 'list_promo'));
    }

    public function home(Produk $produk, Request $request,Slide $slide, Promo $promo){
            $data['list_slide']= Slide::all();
            $slide->banner=request('banner');
            if ($request->hasFile('banner')) {
            $image = $request->file('banner');
            $image_path = Storage::disk('public')->put('image', $image);
            $slide->banner = $image_path;
            }

            $data['list_produk'] = produk::all();
            $produk->foto=request('foto');
            if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $image_path = Storage::disk('public')->put('image', $image);
            $produk->foto = $image_path;
            }

            $data['list_promo'] = Promo::all();
            $promo->foto=request('foto');
            if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $image_path = Storage::disk('public')->put('image', $image);
            $promo->foto = $image_path;
            }
            return view('home', $data);
    }

    public function showCard($id)
    {
        $data['produk'] = Produk::findOrFail($id);
        return view('card', $data);
    }

    public function show($id)
    {
        $data['promo'] = Promo::findOrFail($id);
        return view('show', $data);
    }

    public function filter(Request $request)
    {
        $Nama_produk = $request->input('Nama_produk');
        $Harga = $request->input('Harga');

        $list_produk = Produk::where('status', 'terima');

        if ($Nama_produk) {
        $list_produk->where('Nama_produk', 'like', "%$Nama_produk%");
        }

        if ($Harga) {
        $list_produk->whereIn('Harga', explode(',', $Harga));
        }

        $list_slide = Slide::all(); // Fetch the slide data
        $list_promo = Promo::all();

        $data['list_slide'] = $list_slide;

        $data['list_produk'] = $list_produk->get();
        $data['Nama_produk'] = $Nama_produk;
        $data['Stok'] = $Harga;
            $data['list_promo'] =$list_promo;

        return view('home', $data);
    }

    public function ongkir(){
     $response = Http::withHeaders([
        'key'=>'1cdb62f1f0be21bba119dfe15a031f1f'
     ])->get('https://api.rajaongkir.com/starter/city');

     $cities=$response['rajaongkir']['results'];
     return view ('ongkir.cekongkir',['cities'=>$cities, 'ongkir'=>'']);
    }

    public function transaksi($id)
    {
        $ambilId = $id;
        return view('transaksi.checkout', compact('ambilId'));

    }

    public function transaksistore(Request $request)
    {
        $userId = Auth::id();
        $status = "Proses";
        $kode1= "No-PS";
        $kode2= date("ymd");
        $kode3= rand(100,999);
        $kode="$kode1-$kode2-$kode3";


        $produk = Produk::findOrfail($request->id_produk);
        $total_harga = $request->qty * $produk->Harga;

        $transaksi = Transaksi::create([
        'id_user' => $userId,
        'id_produk' => $request->id_produk,
        'qty' => $request->qty,
        'tgl_pesanan' => $request->tgl_pesanan,
        'batas_tgl' => $request->batas_tgl,
        'total' => $total_harga,
        'kode_pesanan' => $kode,
        'status' => $status,
        'kota' => $request->kota,
        'alamat' => $request->alamat,

    ]);


    return redirect('transaksi/pembayaran')->with('success', 'Data berhasil ditambahkan');

    }

    public function pembayaranTabel(){

        $userId= Auth::id();
        $data['list_transaksi']= Transaksi::Where('id_user',$userId)->get();
        return view('transaksi.pembayaran',$data);

    }

    public function pembayaranShow($id){
        $produk = Produk::all();
        $user = User::all();
        $transaksi = Transaksi::findOrfail($id);
        return view('transaksi/show', compact('produk', 'user','transaksi'));
    }

    public function lunas(Request $request)
    {
        // dd($request->all());
        $userId = Auth::id();
        Transaksi::where('id', $request->delete)->delete();
        $bayar = $request->bayar;
        $new_image = time() . $bayar->getClientOriginalName();
        $bayar->move('upload/', $new_image);

        // Ambil destinasi berdasarkan id_destinasi yang diberikan
        $produk = Produk::findOrFail($request->id_produk);
        // Hitung total harga berdasarkan kuantitas dan harga destinasi
        $total_harga = $request->qty * $produk->Harga;

        $transaksi= Transaksi::create([
        'id' => $request->id,
        'id_user' => $userId,
        'kode_pesanan' => $request->kode_pesanan,
        'status' => $request->status,
        'id_produk' => $request->id_produk,
        'tgl_pesanan' => $request->tgl_pesanan,
        'alamat' => $request->alamat,
        'qty' => $request->qty,
        'total'=>$total_harga,
        'bayar' => 'upload/' . $new_image,
        ]);
        return redirect('transaksi/pembayaran')->with('success', 'Berhasil Ditambahkan');

    }

    public function cancel(Request $request)
    {
         // dd($request->all());
         $userId = Auth::id();
         $produk = Produk::findOrFail($request->id_produk);
         $total_harga = $request->qty * $produk->Harga;

        Transaksi::where('id', $request->delete)->delete();
         $transaksi= Transaksi::create([
         'id' => $request->id,
         'id_user' => $userId,
         'kode_pesanan' => $request->kode_pesanan,
         'status' => $request->status,
         'id_produk' => $request->id_produk,
         'tgl_pesanan' => $request->tgl_pesanan,
         'alamat' => $request->alamat,
         'qty' => $request->qty,
         'total'=>$total_harga,
        ]);
        return redirect('transaksi/pembayaran')->with('success', 'Data Berhasil Ditolak');
    }









}
