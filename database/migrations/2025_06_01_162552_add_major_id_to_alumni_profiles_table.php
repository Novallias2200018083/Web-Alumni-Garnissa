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
        Schema::table('alumni_profiles', function (Blueprint $table) {
            // Tambahkan kolom major_id
            $table->foreignId('major_id')
                  ->nullable() // Jika profil alumni bisa tanpa jurusan saat dibuat
                  ->constrained('majors') // Foreign key ke tabel 'majors'
                  ->onDelete('set null'); // Jika major dihapus, major_id di sini jadi null
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('alumni_profiles', function (Blueprint $table) {
            // Hapus foreign key constraint terlebih dahulu
            $table->dropConstrainedForeignId('major_id');
            // Kemudian hapus kolomnya
            // $table->dropColumn('major_id'); // Atau jika hanya ingin drop foreign key saja
        });
    }
};