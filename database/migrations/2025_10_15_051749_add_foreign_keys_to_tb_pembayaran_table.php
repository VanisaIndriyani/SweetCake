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
        Schema::table('tb_pembayaran', function (Blueprint $table) {
            $table->foreign(['pesanan_id'], 'tb_pembayaran_ibfk_1')->references(['pesanan_id'])->on('tb_pesanan')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_pembayaran', function (Blueprint $table) {
            $table->dropForeign('tb_pembayaran_ibfk_1');
        });
    }
};
