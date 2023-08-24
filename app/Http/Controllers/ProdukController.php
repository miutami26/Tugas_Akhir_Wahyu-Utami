<?php
namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;




class ProdukController extends Controller
{
    public function index(){

        $data['list_produk'] = Produk::all();
        return view('produk.index', $data);
    }

    public function create(){
        return view('produk.create');
    }

    public function store(Request $request)
    {
        $request->validate([
        'Nama_produk' => 'required',
        'Berat' => 'required',
        // 'warna' => 'required',
        'Harga' => 'required',
        'Stok' => 'required',
        'deskripsi' => 'required',
        'foto' => 'required|image',
        ], [
        'required' => 'Wajib diisi!',
        'image' => 'Format file gambar tidak valid.',
        ]);
        $produk = new Produk;
        $produk->Nama_produk = $request->input('Nama_produk');
        $produk->Berat = $request->input('Berat');
        $produk->Harga = floatval(str_replace(',', '.', str_replace('.', '', $request->input('Harga'))));
        // $produk->warna = $request->input('warna');
        $produk->Stok = $request->input('Stok');
        $produk->deskripsi = $request->input('deskripsi');
        if ($request->hasFile('foto')) {
        $image = $request->file('foto');
        $image_path = public_path('image');
        $image->move($image_path, $image->getClientOriginalName());
        $produk->foto = 'image/' . $image->getClientOriginalName();
        }
        if (auth()->user()->role == 'admin') {
        $produk->status = 'terima';
        } else {
        $produk->status = 'menunggu';
        }
        $produk->save();

        return redirect('produk')->with('success', 'Data berhasil ditambahkan');
    }

    public function show(Produk $produk){
        $data['produk'] = $produk;
        return view('produk.show', $data);
    }

    public function edit(Produk $produk){
        $data['produk'] = $produk;

        return view('produk.edit', $data);
    }

    public function update(Produk $produk, Request $request)
    {
        $produk->Nama_produk = request('Nama_produk');
        $produk->Berat = request('Berat');
        $produk->Harga = request('Harga');
        // $produk->warna = request('warna');
        $produk->Stok = request('Stok');
        $produk->deskripsi = request('deskripsi');
        if ($request->hasFile('foto')) {
        // Simpan foto baru ke penyimpanan
        $image = $request->file('foto');
        $image_path = public_path('image');
        $newFotoName = 'image/' . $image->getClientOriginalName();
        $image->move($image_path, $newFotoName);

        // Hapus foto lama dari penyimpanan jika ada
        if (!empty($produk->foto)) {
        $oldFotoPath = public_path($produk->foto);
        if (File::exists($oldFotoPath)) {
        File::delete($oldFotoPath);
        }
        }
        // Update atribut foto dengan foto baru
        $produk->foto = $newFotoName;
        }
         if (auth()->user()->role == 'admin') {
         $produk->status = 'terima';
         } else {
         $produk->status = 'menunggu';
         }

        $produk->save();

        return redirect('produk')->with('warning', 'Data berhasil diupdate');
    }


    public function destroy(Produk $produk){
        $image_path = public_path($produk->foto);
        if (File::exists($image_path)) {
        File::delete($image_path);
    }
        $produk->delete();
        return redirect('produk')->with('danger','Data berhasil dihapus');
    }

    public function terima(Request $request)
    {
        Produk::where('id',$request->delete)->delete();

        Produk::create([
        'id'=> $request->id,
        'Nama_produk' => $request->Nama_produk,
        'Berat' => $request->Berat,
        'status' => $request->status,
        'Harga' => $request->Harga,
        // 'warna' => $request->warna,
        'Stok' => $request->Stok,
        'deskripsi' => $request->deskripsi,
        'foto' => $request->foto,
        ]);
    return redirect('produk')->with('success', 'Data Berhasil Diterima');
    }

    public function tolak(Request $request)
    {
       Produk::where('id',$request->delete)->delete();

       Produk::create([
       'id'=> $request->id,
       'Nama_produk' => $request->Nama_produk,
       'Berat' => $request->Berat,
       'status' => $request->status,
       'Harga' => $request->Harga,
    //    'warna' => $request->warna,
       'Stok' => $request->Stok,
       'deskripsi' => $request->deskripsi,
       'foto' => $request->foto,
       ]);
       return redirect('produk')->with('success', 'Data Produk Ditolak');
    }
}