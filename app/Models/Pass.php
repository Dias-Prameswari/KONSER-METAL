<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; //<\Database\Factories\PassFactory>
use Illuminate\Database\Eloquent\Model;

class Pass extends Model
{
    use HasFactory; //<\Database\Factories\PassFactory>

    protected $fillable = [ // mass assignable
        'show_id', // foreign key ke tabel shows
        // 'tipe', // tipe pass: regular atau premium
        'pass_type_id',
        'harga', // harga pass
        'stok', // stok pass
    ];

    public function show() // relasi ke model Show
    {
        return $this->belongsTo(Show::class);
    }

    public function bookingItems() // relasi ke model booking items
    {
        return $this->hasMany(BookingItem::class);
    }

    public function bookings() // relasi ke model booking melalui BookingItem
    {
        return $this->belongsToMany(Booking::class, 'booking_items')
            ->withPivot('jumlah', 'subtotal_harga');
    }

    public function passType()
    {
        return $this->belongsTo(PassType::class);
    }
}
