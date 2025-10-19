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
        Schema::create('tb_produk', function (Blueprint $table) {
            $table->increments('produk_id');
            $table->string('nama_produk', 100);
            $table->decimal('harga', 12);
            $table->integer('stok');
            $table->text('deskripsi')->nullable();
            $table->string('foto')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_produk');
    }
};
