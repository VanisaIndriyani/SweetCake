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
        Schema::create('tb_notifikasi', function (Blueprint $table) {
            $table->increments('notifikasi_id');
            $table->unsignedInteger('pesanan_id')->index('pesanan_id');
            $table->text('pesan')->nullable();
            $table->dateTime('tanggal_kirim')->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_notifikasi');
    }
};
