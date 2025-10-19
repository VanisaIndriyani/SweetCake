<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'tb_produk';
    protected $primaryKey = 'produk_id';
    public $timestamps = false;

    protected $fillable = [
        'nama_produk',
        'harga',
        'stok',
        'deskripsi',
        'foto',
    ];
}