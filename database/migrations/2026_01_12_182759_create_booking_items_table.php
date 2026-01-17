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
        Schema::create('booking_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained()->onDelete('cascade'); // foreign key ke tabel bookings
            $table->foreignId('pass_id')->constrained()->onDelete('cascade'); // foreign key ke tabel passes
            $table->integer('jumlah'); // jumlah pass yang dibooking
            $table->decimal('subtotal_harga', 10, 2); // subtotal harga
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_items');
    }
};
