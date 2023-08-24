<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Termwind\Components\Raw;
use Midtrans\Config;
use Midtrans\Snap;

class OrderController extends Controller
{
    public function index(){

      $user = Auth::user(); // Mengambil pengguna yang sedang login

      if ($user) {
        $data = Produk::all();
        $data['list_order'] = Order::all();
        return view('ongkir.order', $data);
      } else {
      // Pengguna belum login, arahkan ke halaman login
      return redirect()->route('login')->with('error', 'Anda harus login untuk melakukan checkout.');
      }

    }

    public function create(){
         $produk = Produk::all();
         $user = Auth::user();
         $order= Order::all();
        return view('ongkir.order', compact('produk', 'user', 'order'));


    }
    public function store(Request $request)
    {
        $user = Auth::user();

        if ($user) {
        $order = new Order;
        $order->qty = $request->qty;
        $order->id_user = $user->id; // Menggunakan ID pengguna yang sedang login
        $order->alamat = $request->alamat;
        $order->status = 'Unpaid';
        $order->total = '200000000';
        $order->save();

        return redirect('ongkir/cekout')->with('success', 'Data berhasil ditambahkan')->with('order_id', $order->id);
        } else {
        return redirect()->route('login')->with('error', 'Anda harus login untuk melakukan login terlebih dahulu.');
        }
    }

    public function checkout(Request $request)
    {
            $user = Auth::user();
            $order = Order::first();

            // Set your Merchant Server Key
            \Midtrans\Config::$serverKey ='SB-Mid-server-lnHkDWHt2PyDl8Y-KDrK3qKJ';
            // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept realtransaction).
            \Midtrans\Config::$isProduction = false;
            // Set sanitization on (default)
            \Midtrans\Config::$isSanitized = true;
            // Set 3DS transaction for credit card to true
            \Midtrans\Config::$is3ds = true;

            $params = [
            'transaction_details' => [
            'order_id' =>$order->id,
            'gross_amount' => $order->total,
            ],
            // 'customer_details' => [
            // 'name' => $request->user()->nama,
            // 'no_hp' => $request->user()->no_hp,
            // ],
        ];

            $snapToken = \Midtrans\Snap::getSnapToken($params);
            // dd($snapToken);
        return view('ongkir.cekout', compact('snapToken', 'order'));


    }


    // public function store(Request $request){

    //     $user = Auth::user();

    //     $order = Order::create([
    //     'id_user' => $user->id,
    //     'id_produk' => $request->input('id_produk'),
    //     'qty' => $request->input('qty'),
    //     'total' => $request->input('total'),
    //     'status' => $request->input('status'),
    //     ]);

    //         $order->save();
    //     return redirect('ongkir.cekout')->with('success', 'Data berhasil ditambahkan');
    // }

    // public function checkout(Request $request){

    //     $user = Auth::user();
    //     $produk = Produk::all();
    //     $request->request->add(['total'=>$request->qty * 10000,'status'=>'Unpaid']);
    //     $order= Order::create($request->all());

    //     // Set your Merchant Server Key
    //     \Midtrans\Config::$serverKey = config('midtrans.server_key');
    //     // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept realtransaction).
    //     \Midtrans\Config::$isProduction = false;
    //     // Set sanitization on (default)
    //     \Midtrans\Config::$isSanitized = true;
    //     // Set 3DS transaction for credit card to true
    //     \Midtrans\Config::$is3ds = true;

    //     $params = array(
    //     'transaction_details' => array(
    //     'order_id' => $order->id,
    //     'gross_amount' =>$order->total,
    //     ),
    //     'customer_details' => array(
    //     'nama' => $user->nama,
    //     'email' => $user->email,
    //     'no_hp' => $user->no_hp,

    //     ),
    //     );

    //     $snapToken = \Midtrans\Snap::getSnapToken($params);
    //     dd($snapToken);
    //     return view('ongkir.cekout', compact('snapToken','order'));

    // }

    // public function pembayaran(){
    //     return view('ongkir.cekout');
    // }

}

 // $order = Order::create([
 // 'id_user' => $user->id,
 // 'qty' => $request->input('qty'),
 // 'total' => $request->input('total'),
 // 'alamat' => $request->input('alamat'),
 // 'status' => 'Unpaid',
 // ]);
