<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pesanan;
use Carbon\Carbon;

class PesananSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'user_id' => 1,
                'tanggal_pesanan' => Carbon::now()->subDays(5)->format('Y-m-d H:i:s'),
                'status' => 'baru',
            ],
            [
                'user_id' => 1,
                'tanggal_pesanan' => Carbon::now()->subDays(3)->format('Y-m-d H:i:s'),
                'status' => 'diproses',
            ],
            [
                'user_id' => 2,
                'tanggal_pesanan' => Carbon::now()->subDays(2)->format('Y-m-d H:i:s'),
                'status' => 'diproses',
            ],
            [
                'user_id' => 1,
                'tanggal_pesanan' => Carbon::now()->subDays(1)->format('Y-m-d H:i:s'),
                'status' => 'selesai',
            ],
            [
                'user_id' => 2,
                'tanggal_pesanan' => Carbon::now()->format('Y-m-d H:i:s'),
                'status' => 'baru',
            ],
        ];

        foreach ($items as $data) {
            Pesanan::create($data);
        }
    }
}

