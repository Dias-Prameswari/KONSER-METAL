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
        Schema::table('passes', function (Blueprint $table) {
            // tambahan baru
            $table->unique(['show_id', 'tipe'], 'passes_show_id_tipe_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('passes', function (Blueprint $table) {
            // tambahan baru
            $table->dropUnique('passes_show_id_tipe_unique');
        });
    }
};
