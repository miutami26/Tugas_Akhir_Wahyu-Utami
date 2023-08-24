<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

     protected $table = 'user';
     use Notifiable;

    public $incrementing = false; // Menonaktifkan incrementing pada primary key
    protected $primaryKey = 'id'; // Menetapkan kolom primary key

    protected $keyType = 'string'; // Menetapkan tipe data primary key menjadi string

    protected static function boot()
    {
    parent::boot();

    static::creating(function ($user) {
    $user->id = (string) Str::uuid();
    });
    }

    function setPasswordAttribute($value){
        $this->attributes['password'] = bcrypt($value);
    }
    function setUsernameAttribute($value){
         $this->attributes['username'] = strtolower($value);
    }



}