<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    protected $table = 'tb_notifikasi';
    protected $primaryKey = 'notifikasi_id';
    public $timestamps = false;

    protected $fillable = [
        'pesanan_id',
        'pesan',
        'tanggal_kirim',
    ];

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'pesanan_id', 'pesanan_id');
    }
}


