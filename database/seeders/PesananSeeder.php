<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pesanan;
use App\Models\DetailPesanan;
use App\Models\Pembayaran;
use App\Models\Produk;
use Carbon\Carbon;

class PesananSeeder extends Seeder
{
    public function run(): void
    {
        // Set timezone ke WIB (Asia/Jakarta)
        Carbon::setLocale('id');
        date_default_timezone_set('Asia/Jakarta');
        
        // Ambil produk untuk detail pesanan
        $produks = Produk::all();
        if ($produks->isEmpty()) {
            $this->command->warn('Tidak ada produk. Jalankan ProdukSeeder terlebih dahulu!');
            return;
        }

        $items = [
            [
                'user_id' => 1,
                'tanggal_pesanan' => Carbon::now('Asia/Jakarta')->subDays(5)->format('Y-m-d H:i:s'),
                'status' => 'baru',
                'metode_pembayaran' => 'transfer_bank',
                'status_pembayaran' => 'completed',
                'bukti' => 'img/Black Forest.jpeg', // Foto dummy sebagai bukti
                'produk_ids' => [1, 2], // ID produk untuk detail pesanan
            ],
            [
                'user_id' => 1,
                'tanggal_pesanan' => Carbon::now('Asia/Jakarta')->subDays(3)->format('Y-m-d H:i:s'),
                'status' => 'diproses',
                'metode_pembayaran' => 'kartu_kredit',
                'status_pembayaran' => 'completed',
                'bukti' => 'img/Cheesecake.jpeg',
                'produk_ids' => [2, 3],
            ],
            [
                'user_id' => 2,
                'tanggal_pesanan' => Carbon::now('Asia/Jakarta')->subDays(2)->format('Y-m-d H:i:s'),
                'status' => 'diproses',
                'metode_pembayaran' => 'cod',
                'status_pembayaran' => 'completed',
                'bukti' => null, // COD tidak perlu bukti
                'produk_ids' => [1, 4],
            ],
            [
                'user_id' => 1,
                'tanggal_pesanan' => Carbon::now('Asia/Jakarta')->subDays(1)->format('Y-m-d H:i:s'),
                'status' => 'selesai',
                'metode_pembayaran' => 'transfer_bank',
                'status_pembayaran' => 'completed',
                'bukti' => 'img/Red Velvet.jpeg',
                'produk_ids' => [3, 5],
            ],
            [
                'user_id' => 2,
                'tanggal_pesanan' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'status' => 'baru',
                'metode_pembayaran' => 'cod',
                'status_pembayaran' => 'pending',
                'bukti' => null,
                'produk_ids' => [2],
            ],
        ];

        foreach ($items as $data) {
            // Buat pesanan
            $pesanan = Pesanan::create([
                'user_id' => $data['user_id'],
                'tanggal_pesanan' => $data['tanggal_pesanan'],
                'status' => $data['status'],
            ]);

            // Buat detail pesanan
            $totalHarga = 0;
            foreach ($data['produk_ids'] as $produkId) {
                $produk = $produks->find($produkId);
                if ($produk) {
                    $jumlah = rand(1, 3);
                    DetailPesanan::create([
                        'pesanan_id' => $pesanan->pesanan_id,
                        'produk_id' => $produkId,
                        'jumlah' => $jumlah,
                        'catatan' => null,
                    ]);
                    $totalHarga += $produk->harga * $jumlah;
                }
            }

            // Buat pembayaran
            Pembayaran::create([
                'pesanan_id' => $pesanan->pesanan_id,
                'metode_pembayaran' => $data['metode_pembayaran'],
                'jumlah_pembayaran' => $totalHarga,
                'tanggal_pembayaran' => $data['status_pembayaran'] === 'completed' 
                    ? $data['tanggal_pesanan'] 
                    : Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'status' => $data['status_pembayaran'],
                'bukti_pembayaran' => $data['bukti'],
            ]);
        }
    }
}

