<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'tb_pesanan';
    protected $primaryKey = 'pesanan_id';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'tanggal_pesanan',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function details()
    {
        return $this->hasMany(DetailPesanan::class, 'pesanan_id', 'pesanan_id');
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class, 'pesanan_id', 'pesanan_id');
    }

    public function notifikasi()
    {
        return $this->hasMany(Notifikasi::class, 'pesanan_id', 'pesanan_id');
    }
}