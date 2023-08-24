<?php

namespace App\Models;

use App\Models\Produk;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Transaksi extends Model
{
    use HasFactory;
     protected $table= 'transaksi';
     protected $primaryKey = 'id';
     protected $fillable = [
        'id_produk',
        'id_user',
        'qty',
        'tgl_pesanan',
        'status',
        'alamat',
        'total',
        'bayar',
        'kode_pesanan',
     ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
