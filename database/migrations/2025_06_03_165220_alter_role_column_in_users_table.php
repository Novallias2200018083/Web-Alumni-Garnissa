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
        Schema::table('users', function (Blueprint $table) {
            // Mengubah kolom 'role' menjadi varchar dengan panjang yang lebih besar
            // Atau Anda bisa menggunakan enum jika peran sangat terbatas dan tidak akan berubah
            $table->string('role', 50)->change(); // Mengubah menjadi VARCHAR(50)
            // Jika Anda ingin menggunakan ENUM (misalnya hanya 'user' dan 'admin'):
            // $table->enum('role', ['user', 'admin'])->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Mengembalikan kolom 'role' ke kondisi semula (misalnya varchar default atau enum lama)
            // Sesuaikan ini dengan definisi kolom 'role' Anda sebelum perubahan ini
            $table->string('role', 255)->change(); // Contoh: mengembalikan ke varchar default Laravel
            // Atau jika sebelumnya enum:
            // $table->enum('role', ['user', 'admin'])->change();
        });
    }
};