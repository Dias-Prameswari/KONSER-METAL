<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; //<\Database\Factories\BookingFactory>
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory; //<\Database\Factories\BookingFactory>

    protected $casts = [ // casting attributes
        'total_harga' => 'decimal:2', // casting total_harga ke decimal dengan 2 desimal
        'order_date' => 'datetime', // casting order_date ke datetime
        'discount_amount' => 'decimal:2',
        'final_total' => 'decimal:2',
    ];

    protected $fillable = [ // mass assignable
        'user_id', // foreign key ke tabel users
        'show_id', // foreign key ke tabel shows   
        'order_date', // tanggal booking
        'total_harga', // total harga
        'payment_type_id', // tipe pembayaran
        'discount_id',
        'discount_amount',
        'final_total',
    ];

    public function user() // relasi ke model User
    {
        return $this->belongsTo(User::class);
    }

    public function passes() // relasi ke model Pass
    {
        return $this->belongsToMany(Pass::class, 'booking_items')
            ->withPivot('jumlah', 'subtotal_harga');
    }

    public function show() // relasi ke model Show melalui Pass
    {
        return $this->belongsTo(Show::class, 'show_id');
    }

    public function bookingItems() // relasi ke model BookingItem
    {
        return $this->hasMany(BookingItem::class);
    }

    public function paymentType() // relasi ke table payment type
    {
        return $this->belongsTo(PaymentType::class, 'payment_type_id');
    }

    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }
}
