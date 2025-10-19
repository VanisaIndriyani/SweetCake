<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tb_detailpesanan', function (Blueprint $table) {
            $table->increments('detail_id');
            $table->unsignedInteger('pesanan_id')->index('pesanan_id');
            $table->unsignedInteger('produk_id')->index('produk_id');
            $table->integer('jumlah');
            $table->text('catatan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_detailpesanan');
    }
};
