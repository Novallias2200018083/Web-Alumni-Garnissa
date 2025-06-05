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
            // Hapus baris ini jika student_id sudah ada di DB Anda
            // $table->string('student_id')->unique()->after('email');

            // Biarkan baris ini untuk menambahkan major_id
            $table->unsignedBigInteger('major_id')->nullable()->after('email'); // Ubah after ke 'email' atau kolom lain yang sesuai
            // Jika student_id sudah ada, maka after('student_id') tetap benar
            // $table->unsignedBigInteger('major_id')->nullable()->after('student_id');

            $table->foreign('major_id')->references('id')->on('majors')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['major_id']);
            $table->dropColumn('major_id');
            // Hapus baris ini jika Anda tidak ingin menghapus student_id saat rollback
            // $table->dropColumn('student_id');
        });
    }
};