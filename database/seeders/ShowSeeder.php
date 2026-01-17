<?php

namespace Database\Seeders;

// Seeder dibuat idempotent (aman dijalankan berulang):
// - user_id diambil dari email admin
// - genre_id diambil dari nama genre
// Tujuan: tidak bergantung pada angka ID yang bisa berubah

use App\Models\Show; // import model Show dari app/Models/Show.php
use App\Models\Genre; // import model Genre dari app/Models/Genre.php
use App\Models\User; // import model User dari app/Models/User.php
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::where('email', 'admin@gmail.com')->firstOrFail(); // ambil user admin berdasarkan email

        $genreMap = Genre::pluck('id', 'nama'); // ambil semua genre, key nama, value id. atau membuat map: nama => id

        $shows = [
            [
                'judul' => 'Heavy Metal Night',
                'genre' => 'Heavy Metal',
                'deskripsi' => 'Malam penuh distorsi dan riff berat bersama line-up band pilihan.', // nama band belum ditentukan
                'tanggal_waktu' => '2026-02-22 19:00:00',
                'lokasi' => 'Stadion Utama',
                'gambar' => 'shows/heavy_metal_night.jpg', 
            ],
            [
                'judul' => 'Metalcore Breakdown Fest',
                'genre' => 'Metalcore',
                'deskripsi' => 'Breakdown, moshpit, dan energi brutal untuk pecinta Metalcore.',
                'tanggal_waktu' => '2026-03-08 19:30:00',
                'lokasi' => 'Hall Concert City',
                'gambar' => 'shows/metalcore_breakdown_fest.jpg', 
            ],
            [
                'judul' => 'Nu Metal Reunion',
                'genre' => 'Nu Metal',
                'deskripsi' => 'Nu Metal klasik dengan nuansa nostalgia dan setlist yang memompa adrenalin.',
                'tanggal_waktu' => '2026-03-29 20:00:00',
                'lokasi' => 'Outdoor Arena',
                'gambar' => 'shows/nu_metal_reunion.jpg', 
            ],

        ];

        foreach ($shows as $s) {
            $genreId = $genreMap[$s['genre']] ?? null;

            if (!$genreId) {
                throw new \Exception("Genre '{$s['genre']}' belum ada. Jalankan GenreSeeder dulu.");
            }

            Show::updateOrCreate(
                // Kunci pencarian (record dianggap sama jika judul sama)
                [
                    'judul' => $s['judul'], // Pakai updateOrCreate agar seeding ulang tidak membuat data show duplikat
                ],
                // data untuk diupdate atau dicreate
                [
                    'user_id' => $admin->id,
                    'genre_id' => $genreId,
                    'deskripsi' => $s['deskripsi'],
                    'tanggal_waktu' => $s['tanggal_waktu'],
                    'lokasi' => $s['lokasi'],
                    'gambar' => $s['gambar'],
                ]
            );
        }
    }
}
