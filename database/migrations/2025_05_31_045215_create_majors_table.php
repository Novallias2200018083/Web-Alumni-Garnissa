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
        Schema::create('majors', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // Nama Jurusan (misal: "Teknik Informatika", "Sistem Informasi")
            $table->string('code')->unique(); // Kode Jurusan (misal: "TI", "SI")
            $table->timestamps();
        });

        // Seed some initial majors (optional, bisa juga pakai seeder terpisah)
        // \Illuminate\Support\Facades\DB::table('majors')->insert([
        //     ['name' => 'Teknik Informatika', 'code' => 'TI', 'created_at' => now(), 'updated_at' => now()],
        //     ['name' => 'Sistem Informasi', 'code' => 'SI', 'created_at' => now(), 'updated_at' => now()],
        //     ['name' => 'Teknik Elektro', 'code' => 'TE', 'created_at' => now(), 'updated_at' => now()],
        // ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('majors');
    }
};