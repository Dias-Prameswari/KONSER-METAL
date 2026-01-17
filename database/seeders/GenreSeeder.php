<?php

namespace Database\Seeders;

use App\Models\Genre; // import model Genre dari app/Models/Genre.php
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genres = [ // daftar genre musik, “key array mengikuti kolom tabel (nama) di database
            ['nama' => 'Heavy Metal'], // 1
            ['nama' => 'Metalcore'], // 2
            ['nama' => 'Nu Metal'], // 3
            ['nama' => 'Hard Rock'], //4 
            ['nama' => 'Post-Hardcore'], // 5
            ['nama' => 'Alternative'], // 6
        ];

        foreach ($genres as $genre) { // beda dengan tutorial
            Genre::firstOrCreate($genre); // cari berdasarkan atribut yang diberikan (nama)
        }
    }
}
