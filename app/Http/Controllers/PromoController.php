<?php

namespace App\Http\Controllers;

use App\Models\Promo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PromoController extends Controller
{
    public function index()
    {
        $data['list_promo'] = Promo::all();
        return view('promo.index',$data);
    }
    public function create()
    {
        return view('promo.create');
    }

    // public function store(Request $request)
    // {
    //     $request->validate(
    //     ['foto' =>'required',
    //      'nama' => 'required',
    //      'deskripsi' => 'required',
    //      'stok' => 'required',
    //      'harga' => 'required',
    //     ],

    //     ['foto.required' => 'Wajib di Isi !!!',
    //      'nama.required' => 'Wajib di Isi !!!',
    //      'deskripsi.required' => 'Wajib di Isi !!!',
    //      'stok.required' => 'Wajib di Isi !!!',
    //      'harga.required' => 'Wajib di Isi !!!',
    //     ]);
    //     $prom = 'menunggu';
    //     $promo= new Promo;
    //     if ($request->hasFile('foto')) {
    //     $image = $request->file('foto');
    //     $image_path = public_path('image');
    //     $image->move($image_path, $image->getClientOriginalName());
    //     $promo->foto = 'image/' . $image->getClientOriginalName();
    //     }
    //     $promo->nama = request('nama');
    //     $promo->harga = 10000000.00;
    //     $harga = $promo->harga;
    //     $hargaFormatted = number_format($harga, 2, ',', '.');
    //     $promo->deskripsi = request('deskripsi');
    //     $promo->stok= request('stok');
    //     $promo->status = request('status');
    //     $promo->status=$prom;
    //     $promo->save();

    //     return redirect('promo')->with('success','Data berhasil ditambahkan');
    // }

    public function store(Request $request)
    {
    $request->validate([
    'foto' => 'required',
    'nama' => 'required',
    'deskripsi' => 'required',
    'stok' => 'required',
    'harga' => 'required',
    ], [
    'foto.required' => 'Wajib di Isi !!!',
    'nama.required' => 'Wajib di Isi !!!',
    'deskripsi.required' => 'Wajib di Isi !!!',
    'stok.required' => 'Wajib di Isi !!!',
    'harga.required' => 'Wajib di Isi !!!',
    ]);

    $promo = new Promo;

    if ($request->hasFile('foto')) {
    $image = $request->file('foto');
    $image_path = public_path('image');
    $image->move($image_path, $image->getClientOriginalName());
    $promo->foto = 'image/' . $image->getClientOriginalName();
    }

    $promo->nama = $request->input('nama');
    $promo->harga = 10000000.00;
    $promo->deskripsi = $request->input('deskripsi');
    $promo->stok = $request->input('stok');

    // Jika pengguna adalah admin
    if (auth()->user()->role == 'admin') {
    $promo->status = 'diterima';
    } else {
    $promo->status = 'menunggu';
    }

    $promo->save();

    return redirect('promo')->with('success', 'Data berhasil ditambahkan');
    }


    public function show(Promo $promo){
        $data['promo'] = $promo;
        return view('promo.show', $data);
    }

    public function edit(Promo $promo){
        $data['promo'] = $promo;
        return view('promo.edit', $data);
    }

    public function update(Promo $promo, Request $request)
    {
        if ($request->hasFile('foto')) {
        // Simpan foto baru ke penyimpanan
        $image = $request->file('foto');
        $image_path = public_path('image');
        $newFotoName = 'image/' . $image->getClientOriginalName();
        $image->move($image_path, $newFotoName);
        // Hapus foto lama dari penyimpanan jika ada
        if (!empty($promo->foto)) {
        $oldFotoPath = public_path($promo->foto);
        if (File::exists($oldFotoPath)) {
        File::delete($oldFotoPath);
        }
        }
        // Update atribut foto dengan foto baru
        $promo->foto = $newFotoName;
        }
        $promo-> nama = request('nama');
        $promo-> harga = request('harga');
        $promo-> deskripsi = request('deskripsi');
        $promo-> stok= request('stok');
        $promo->save();

        return redirect('promo')->with('warning','Data berhasil diupdate');
    }

    public function destroy(Promo $promo)
    {
        $image_path = public_path($promo->foto);
        if (File::exists($image_path)) {
        File::delete($image_path);
        }
        $promo->delete();
        return redirect('promo')->with('danger','Data berhasil dihapus');
    }

    public function diterima(Request $request)
    {
        Promo::where('id',$request->delete)->delete();

        Promo::create([
        'id'=> $request->id,
        'foto' => $request->foto,
        'nama' => $request->nama,
        'status' => $request->status,
        'harga' => $request->harga,
        'deskripsi' => $request->deskripsi,
        'stok' => $request->stok,
        ]);
        return redirect('promo')->with('success', 'Data Berhasil Diterima');
    }

    public function ditolak(Request $request)
    {
        Promo::where('id',$request->delete)->delete();

        Promo::create([
       'id'=> $request->id,
       'foto' => $request->foto,
       'nama' => $request->nama,
       'status' => $request->status,
       'harga' => $request->harga,
       'deskripsi' => $request->deskripsi,
       'stok' => $request->stok,
        ]);
        return redirect('promo')->with('success', 'Data Promo Ditolak');
    }



}
