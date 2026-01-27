<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; //<\Database\Factories\ShowFactory>
use Illuminate\Database\Eloquent\Model;
use App\Models\Pass;
use App\Models\Discount;

class Show extends Model
{
    use HasFactory; //<\Database\Factories\ShowFactory>

    protected $fillable = [ // mass assignable
        'user_id', // foreign key ke tabel users
        'judul', // title of the show
        'deskripsi', // description of the show
        'tanggal_waktu', // release date
        'lokasi', // location
        'genre_id', // foreign key ke tabel genres
        'gambar', // gambar
    ];

    protected $casts = [
        'tanggal_waktu' => 'datetime', // casting tanggal_waktu ke datetime
    ];

    public function passes() // relasi ke model Ticket/passes
    {
        return $this->hasMany(Pass::class);
    }

    public function genre() // relasi ke model Genre
    {
        return $this->belongsTo(Genre::class);
    }

    public function user() // relasi ke model User
    {
        return $this->belongsTo(User::class);
    }

    public function discounts()
    {
        return $this->hasMany(Discount::class);
    }
}
