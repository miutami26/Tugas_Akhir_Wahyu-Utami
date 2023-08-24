<?php

namespace App\Http\Controllers;

use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SlideController extends Controller
{
    public function index()
    {
        $data['list_slide'] = Slide::all();
        return view('slide.index',$data);
    }

    public function create()
    {
        return view('slide.create');
    }

    public function store(Request $request)
    {
        $request->validate(
        ['banner' =>'required',
        'title' => 'required',
        'isi' => 'required',
        ],
        ['banner.required' => 'Wajib di Isi !!!',
        'title.required' => 'Wajib di Isi !!!',
        'isi.required' => 'Wajib di Isi !!!',
        ]);
        $slide= new Slide;
        if ($request->hasFile('banner')) {
        $image = $request->file('banner');
        $image_path = public_path('image');
        $image->move($image_path, $image->getClientOriginalName());
        $slide->banner = 'image/' . $image->getClientOriginalName();
        }
        $slide-> title = request('title');
        $slide-> isi = request('isi');
        if (auth()->user()->role == 'admin') {
        $slide->status = 'aktif';
        } else {
        $slide->status = 'menunggu';
        }
        $slide->save();
        return redirect('slide')->with('success','Data berhasil ditambahkan');
    }

    public function show(Slide $slide)
    {
        $data['slide'] = $slide;
        return view('slide.show', $data);
    }

    public function edit(Slide $slide)
    {
        $data['slide'] = $slide;
        return view('slide.edit', $data);
    }

    public function update(Slide $slide, Request $request)
    {
        if ($request->hasFile('banner')) {
         // Simpan foto baru ke penyimpanan
         $image = $request->file('banner');
         $image_path = public_path('image');
         $newFotoName = 'image/' . $image->getClientOriginalName();
         $image->move($image_path, $newFotoName);
         // Hapus foto lama dari penyimpanan jika ada
         if (!empty($slide->banner)) {
         $oldFotoPath = public_path($slide->banner);
         if (File::exists($oldFotoPath)) {
         File::delete($oldFotoPath);
         }
         }
         // Update atribut foto dengan foto baru
         $slide->banner = $newFotoName;
        }
        $slide-> title = request('title');
        $slide-> isi = request('isi');
         if (auth()->user()->role == 'admin') {
         $slide->status = 'aktif';
            } else {
        $slide->status = 'menunggu';
        }
        $slide->save();

        return redirect('slide')->with('warning','Data berhasil diupdate');
    }

    public function destroy(Slide $slide){
        $image_path = public_path($slide->banner);
        if (File::exists($image_path)) {
        File::delete($image_path);
        }
        $slide->delete();
        return redirect('slide')->with('danger','Data berhasil dihapus');
    }

    public function aktif(Request $request)
    {
        Slide::where('id', $request->delete)->delete();

        Slide::create([
        'id'=> $request->id,
        'banner' => $request->banner,
        'title' => $request->title,
        'status' => $request->status,
        'isi' => $request->isi,
        ]);
        return redirect('slide')->with('success', 'Slide Aktif');
    }

    public function nonaktif(Request $request)
    {
        Slide::where('id',$request->delete)->delete();

        Slide::create([
        'id'=> $request->id,
        'banner' => $request->banner,
        'title' => $request->title,
        'status' => $request->status,
        'isi' => $request->isi,
        ]);
        return redirect('slide')->with('success', 'Slide Non Aktif');
    }
}
