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
        Schema::create('tb_pembayaran', function (Blueprint $table) {
            $table->increments('pembayaran_id');
            $table->unsignedInteger('pesanan_id');
            $table->enum('metode_pembayaran', ['transfer_bank', 'kartu_kredit', 'cod']);
            $table->decimal('jumlah_pembayaran', 12);
            $table->timestamp('tanggal_pembayaran');
            $table->enum('status', ['pending', 'completed', 'refunded'])->default('pending');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_pembayaran');
    }
};
