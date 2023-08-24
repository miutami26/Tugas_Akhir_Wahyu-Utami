<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class  Produk Extends Model{

	protected $table = 'produk';

     protected $fillable = [
     'Nama_produk',
     'Berat',
     'status',
     'Harga',
     'warna',
     'Stok',
     'deskripsi',
     'foto',
     ];

	protected $casts = [
		'created_at' => 'datetime',
		// 'Berat' => 'decimal:2'

	];

}
