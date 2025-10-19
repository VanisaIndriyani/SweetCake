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
        // Ensure user_id is unsigned to match tb_users.user_id
        Schema::table('tb_pesanan', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
        Schema::table('tb_pesanan', function (Blueprint $table) {
            $table->unsignedInteger('user_id')->index('user_id');
        });
        Schema::table('tb_pesanan', function (Blueprint $table) {
            $table->foreign('user_id', 'tb_pesanan_ibfk_1')
                ->references('user_id')
                ->on('tb_users')
                ->onUpdate('no action')
                ->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_pesanan', function (Blueprint $table) {
            $table->dropForeign('tb_pesanan_ibfk_1');
        });
    }
};
