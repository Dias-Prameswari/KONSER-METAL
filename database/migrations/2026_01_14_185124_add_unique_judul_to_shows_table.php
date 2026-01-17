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
        // UP = menjalankan perubahan (apply)
        // Menambahkan UNIQUE index pada kolom 'judul' agar tidak ada show dengan judul yang sama.
        Schema::table('shows', function (Blueprint $table) {
            // tambahan baru, membuat judul unik
            $table->unique('judul');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // DOWN = membatalkan perubahan (rollback)
        // Menghapus UNIQUE index 'shows_judul_unique' agar kolom 'judul' boleh duplikat lagi.
        Schema::table('shows', function (Blueprint $table) {
            // tambahan baru, menghapus kombinasi judul unik
            $table->dropUnique('shows_judul_unique');
        });
    }
};
