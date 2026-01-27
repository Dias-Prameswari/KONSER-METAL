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
        Schema::create('passes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('show_id')
                    ->constrained()
                    ->onDelete('cascade'); // foreign key ke tabel shows

            $table->foreignId('pass_type_id')
                    ->constrained('pass_types')
                    ->cascadeOnDelete(); // tipe pass: regular, premium, vip, early bird

            $table->decimal("harga", 10, 2); // harga pass
            $table->integer("stok"); // stok pass
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('passes');
    }
};
