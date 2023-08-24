<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $fillable = [ 'id_user', 'qty', 'total', 'status', 'alamat', 'snap_token'];
    public $incrementing = false;
    protected $keyType = 'string';



    public function user()
    {
    return $this->belongsTo(User::class, 'id_user');
    }

    public function produk()
    {
    return $this->belongsTo(Produk::class, 'id_produk');
    }
}
