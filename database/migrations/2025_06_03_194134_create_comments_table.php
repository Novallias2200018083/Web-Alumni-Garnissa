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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Komentar dari pengguna
            $table->foreignId('blog_id')->constrained()->onDelete('cascade'); // Komentar untuk blog tertentu
            $table->foreignId('parent_id')->nullable()->constrained('comments')->onDelete('cascade'); // Untuk balasan komentar
            $table->text('content'); // Isi komentar
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
