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
        Schema::create('event_registrations', function (Blueprint $table) {
            $table->id();
            // Foreign key ke tabel users
            $table->foreignId('user_id')
                  ->constrained() // Otomatis mencari tabel 'users'
                  ->onDelete('cascade'); // Jika user dihapus, registrasi juga dihapus

            // Foreign key ke tabel events
            $table->foreignId('event_id')
                  ->constrained() // Otomatis mencari tabel 'events'
                  ->onDelete('cascade'); // Jika event dihapus, registrasi juga dihapus

            $table->string('status')->default('pending_payment'); // Status pendaftaran
            $table->string('payment_proof')->nullable(); // Path ke bukti pembayaran, bisa null jika gratis
            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_registrations');
    }
};