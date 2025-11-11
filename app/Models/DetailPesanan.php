<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPesanan extends Model
{
    protected $table = 'tb_detailpesanan';
    protected $primaryKey = 'detail_id';
    public $timestamps = false;

    protected $fillable = [
        'pesanan_id',
        'produk_id',
        'jumlah',
        'catatan',
    ];

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'pesanan_id', 'pesanan_id');
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id', 'produk_id');
    }
}