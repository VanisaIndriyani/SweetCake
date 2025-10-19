<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tb_laporanpenjualan', function (Blueprint $table) {
            $table->increments('laporan_id');
            $table->unsignedInteger('id_admin')->nullable()->index('id_admin');
            $table->unsignedInteger('id_pesanan')->nullable()->index('id_pesanan');
            $table->date('tanggal');
            $table->decimal('total_transaksi', 12)->nullable();
            $table->string('produk_terlaris', 100)->nullable();
            $table->integer('jumlah_terlaris')->nullable();


        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_laporanpenjualan');
    }
};
