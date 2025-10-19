<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use Notifiable, HasFactory;

    // pastikan pakai tabel yang benar
    protected $table = 'tb_users';
    protected $primaryKey = 'user_id';
    public $timestamps = false; 

    protected $fillable = [
        'nama',
        'email',
        'password',
        'alamat',
        'no_hp',
        'role',
        'status',
        'verification_token', 
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'verification_token', 
    ];
}
