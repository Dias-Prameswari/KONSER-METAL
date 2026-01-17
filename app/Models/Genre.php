<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; //<\Database\Factories\GenreFactory>
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory; //<\Database\Factories\GenreFactory>

    protected $fillable = [ // mass assignable
        'nama', //name of genre
    ];

    public function shows() // relasi ke model Show
    {
        return $this->hasMany(Show::class);
    }
}
