<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produk;

class ProdukSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'nama_produk' => 'Cupcake Strawberry',
                'harga' => 25000,
                'stok' => 40,
                'deskripsi' => 'Cupcake lembut dengan topping strawberry segar dan krim manis.',
                'foto' => 'img/Cupcake Strawberry.jpeg',
            ],
            [
                'nama_produk' => 'Black Forest',
                'harga' => 120000,
                'stok' => 15,
                'deskripsi' => 'Cake cokelat klasik dengan lapisan krim dan ceri.',
                'foto' => 'img/Black Forest.jpeg',
            ],
            [
                'nama_produk' => 'Cheesecake',
                'harga' => 95000,
                'stok' => 20,
                'deskripsi' => 'Cheesecake creamy dengan base biskuit renyah.',
                'foto' => 'img/Cheesecake.jpeg',
            ],
            [
                'nama_produk' => 'Red Velvet',
                'harga' => 110000,
                'stok' => 18,
                'deskripsi' => 'Red Velvet cake dengan cream cheese frosting.',
                'foto' => 'img/Red Velvet.jpeg',
            ],
            [
                'nama_produk' => 'Matcha Mousse',
                'harga' => 105000,
                'stok' => 22,
                'deskripsi' => 'Mousse lembut rasa matcha premium.',
                'foto' => 'img/Matcha Mousse.jpeg',
            ],
        ];

        foreach ($items as $data) {
            Produk::updateOrCreate(
                ['nama_produk' => $data['nama_produk']],
                $data
            );
        }
    }
}
