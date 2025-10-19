<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin account
        User::updateOrCreate(
            ['email' => 'admin@sweetcake.test'],
            [
                'nama' => 'Admin SweetCake',
                'password' => Hash::make('admin123'),
                'alamat' => 'Jl. Contoh No. 1',
                'no_hp' => '081234567890',
                'role' => 'admin',
                'status' => 'active',
                'verification_token' => Str::random(40),
            ]
        );

        // Regular user account
        User::updateOrCreate(
            ['email' => 'user@sweetcake.test'],
            [
                'nama' => 'Pengguna SweetCake',
                'password' => Hash::make('user123'),
                'alamat' => 'Jl. Contoh No. 2',
                'no_hp' => '089876543210',
                'role' => 'user',
                'status' => 'active',
                'verification_token' => Str::random(40),
            ]
        );
    }
}