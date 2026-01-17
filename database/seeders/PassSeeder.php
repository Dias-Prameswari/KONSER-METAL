<?php

namespace Database\Seeders;

use App\Models\Pass; // import model Pass dari app/Models/Pass.php
use App\Models\Show; // import model Show dari app/Models/Show.php
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $showMap = Show::pluck('id', 'judul'); // ambil semua show, key: judul, value: id

        $passes = [ // daftar pass untuk setiap show
            // passes untuk show pertama
            [
                'show' => 'Heavy Metal Night',
                'tipe' => 'premium',
                'harga' => 1500000,
                'stok' => 100,
            ],
            [
                'show' => 'Heavy Metal Night',
                'tipe' => 'regular',
                'harga' => 500000,
                'stok' => 500,
            ],
            // passes untuk show kedua
            [
                'show' => 'Metalcore Breakdown Fest',
                'tipe' => 'premium',
                'harga' => 1200000,
                'stok' => 120,
            ],
            [
                'show' => 'Metalcore Breakdown Fest',
                'tipe' => 'regular',
                'harga' => 450000,
                'stok' => 600,
            ],
            // passes untuk show ketiga
            [
                'show' => 'Nu Metal Reunion',
                'tipe' => 'premium',
                'harga' => 1000000,
                'stok' => 150,
            ],
            [
                'show' => 'Nu Metal Reunion',
                'tipe' => 'regular',
                'harga' => 400000,
                'stok' => 700,
            ],
        ];

        foreach ($passes as $p) {
            $showId = $showMap[$p['show']] ?? null;

            if (!$showId) {
                throw new \Exception("Show '{$p['show']}' belum ada. Jalankan ShowSeeder dulu.");
            }

            // Unik per show_id + tipe
            Pass::updateOrCreate(
                [ // kunci unik untuk menghindari duplikat
                    'show_id' => $showId,
                    'tipe' => $p['tipe'],
                ],
                [ // data untuk diupdate atau dicreate
                    'harga' => $p['harga'],
                    'stok' => $p['stok'],
                ]
            );
        }
    }
}
