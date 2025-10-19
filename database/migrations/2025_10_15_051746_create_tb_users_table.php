<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tb_users', function (Blueprint $table) {
            $table->increments('user_id');
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('password');
            $table->text('alamat')->nullable();
            $table->string('no_hp', 20)->nullable();
            $table->string('role', 50)->nullable();
            $table->string('status', 20)->nullable();
            $table->string('verification_token', 100)->nullable();
            $table->rememberToken();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_users');
    }
};
