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
            Schema::table('majors', function (Blueprint $table) {
                // Menambahkan kolom 'description' sebagai string nullable
                $table->text('description')->nullable()->after('name'); // Menggunakan text untuk deskripsi panjang, setelah kolom 'name'
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::table('majors', function (Blueprint $table) {
                // Menghapus kolom 'description' jika migrasi di-rollback
                $table->dropColumn('description');
            });
        }
    };
    