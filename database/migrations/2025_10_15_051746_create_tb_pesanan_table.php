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
        Schema::create('tb_pesanan', function (Blueprint $table) {
            $table->increments('pesanan_id');
            $table->unsignedInteger('user_id')->index('user_id');
            $table->dateTime('tanggal_pesanan')->nullable()->useCurrent();
            $table->enum('status', ['baru', 'diproses', 'selesai'])->nullable()->default('baru');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_pesanan');
    }
};
