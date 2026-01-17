<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; //<\Database\Factories\BookingItemFactory>
use Illuminate\Database\Eloquent\Model;

class BookingItem extends Model
{
    use HasFactory; //<\Database\Factories\BookingItemFactory>

    protected $fillable = [ // mass assignable
        'booking_id', // foreign key ke tabel bookings
        'pass_id', // foreign key ke tabel passes
        'jumlah', // jumlah pass yang dibooking
        'subtotal_harga', // subtotal harga
    ];

    public function booking() // relasi ke model Booking
    {
        return $this->belongsTo(Booking::class);
    }

    public function pass() // relasi ke model Pass
    {
        return $this->belongsTo(Pass::class);
    }
}
