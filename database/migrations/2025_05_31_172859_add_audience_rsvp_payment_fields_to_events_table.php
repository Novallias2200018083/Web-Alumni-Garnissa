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
        Schema::table('events', function (Blueprint $table) {
            // Kolom untuk Tipe Audiens (Publik, Jurusan, Angkatan)
            $table->string('audience_type')->default('all')->after('rsvp_required'); // 'all', 'major', 'year'

            // Kolom untuk Jurusan Target (jika audience_type = 'major')
            // Disimpan sebagai JSON array dari ID jurusan
            $table->json('target_majors')->nullable()->after('audience_type');

            // Kolom untuk Angkatan Target (jika audience_type = 'year')
            // Disimpan sebagai JSON array dari tahun kelulusan
            $table->json('target_years')->nullable()->after('target_majors');

            // Kolom untuk Batas Maksimal Peserta RSVP
            $table->integer('max_attendees')->nullable()->after('target_years');

            // Kolom untuk Status Pembayaran (Gratis/Berbayar)
            $table->boolean('is_paid')->default(false)->after('max_attendees');

            // Kolom untuk Harga (jika is_paid = true)
            $table->decimal('price', 10, 2)->nullable()->after('is_paid');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn([
                'audience_type',
                'target_majors',
                'target_years',
                'max_attendees',
                'is_paid',
                'price'
            ]);
        });
    }
};
