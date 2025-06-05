<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; // Pastikan ini diimpor

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Ubah kolom audience_type untuk menambahkan nilai 'major_only', 'year_only', 'major_and_year'
        // dan mengubah 'major' menjadi 'major_only', 'year' menjadi 'year_only'
        // Ini adalah cara yang lebih aman untuk mengubah ENUM di MySQL
        DB::statement("ALTER TABLE events CHANGE audience_type audience_type ENUM('all', 'major_only', 'year_only', 'major_and_year') NOT NULL DEFAULT 'all'");

        // Jika Anda menggunakan PostgreSQL atau database lain yang tidak mendukung ALTER ENUM secara langsung,
        // Anda mungkin perlu membuat kolom baru, memindahkan data, lalu menghapus kolom lama.
        // Contoh untuk PostgreSQL (lebih kompleks):
        // $table->enum('new_audience_type', ['all', 'major_only', 'year_only', 'major_and_year'])->default('all');
        // DB::statement("UPDATE events SET new_audience_type = audience_type::text::enum_new_audience_type_type");
        // $table->dropColumn('audience_type');
        // $table->renameColumn('new_audience_type', 'audience_type');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Mengembalikan kolom audience_type ke nilai sebelumnya saat rollback
        // Perhatikan bahwa jika ada data dengan 'major_and_year', ini akan menyebabkan error
        // karena nilai tersebut tidak ada di ENUM lama.
        // Anda mungkin perlu membersihkan data 'major_and_year' terlebih dahulu jika ada.
        DB::statement("ALTER TABLE events CHANGE audience_type audience_type ENUM('all', 'major', 'year') NOT NULL DEFAULT 'all'");
    }
};
