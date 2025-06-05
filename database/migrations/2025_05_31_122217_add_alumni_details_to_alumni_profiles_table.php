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

            // Tambahkan kolom-kolom terkait karier
            $table->string('current_job')->nullable()->after('bio');
            $table->string('company')->nullable()->after('current_job');
            $table->string('position')->nullable()->after('company');
            $table->string('linkedin_url')->nullable()->after('position');
            $table->string('website_url')->nullable()->after('linkedin_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('alumni_profiles', function (Blueprint $table) {
            $table->dropColumn([
                'alumni_code',
                'current_job',
                'company',
                'position',
                'linkedin_url',
                'website_url',
            ]);
        });
    }
};
