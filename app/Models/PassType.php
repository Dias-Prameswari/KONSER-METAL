<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PassType extends Model
{
    use HasFactory;

     protected $table = 'pass_types';

    protected $fillable = [
        'nama',
    ];

    public function passes()
    {
        return $this->hasMany(Pass::class);
    }
}
