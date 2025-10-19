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
        // Ensure id_admin is unsigned to match tb_users.user_id
        Schema::table('tb_laporanpenjualan', function (Blueprint $table) {
            $table->dropColumn('id_admin');
        });
        Schema::table('tb_laporanpenjualan', function (Blueprint $table) {
            $table->unsignedInteger('id_admin')->nullable()->index('id_admin');
        });
        Schema::table('tb_laporanpenjualan', function (Blueprint $table) {
            $table->foreign('id_admin', 'tb_laporanpenjualan_ibfk_1')
                ->references('user_id')
                ->on('tb_users')
                ->onUpdate('no action')
                ->onDelete('no action');
            $table->foreign('id_pesanan', 'tb_laporanpenjualan_ibfk_2')
                ->references('pesanan_id')
                ->on('tb_pesanan')
                ->onUpdate('no action')
                ->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_laporanpenjualan', function (Blueprint $table) {
            $table->dropForeign('tb_laporanpenjualan_ibfk_1');
            $table->dropForeign('tb_laporanpenjualan_ibfk_2');
        });
    }
};
