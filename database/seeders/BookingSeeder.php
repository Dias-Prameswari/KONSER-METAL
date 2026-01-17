<?php

namespace Database\Seeders;

use App\Models\Booking; // import model Booking dari app/Models/Booking.php
use App\Models\User; // import model User dari app/Models/User.php
use App\Models\Show; // import model Show dari app/Models/Show.php
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // booking dibuat untuk user biasa (role: user, pembeli)
        $user = User::where('email', 'user@gmail.com')->firstOrFail(); // ambil user berdasarkan email

        // map judul show => id show, supaya tidak pakai angka ID yang bisa berubah
        $showMap = Show::pluck('id', 'judul'); // ambil semua show

        $bookings = [ // daftar booking
            [
                'show' => 'Heavy Metal Night',
                'order_date' => '2026-01-10 14:30:00',
            ],
            [
                'show' => 'Nu Metal Reunion',
                'order_date' => '2026-01-12 16:00:00',
            ],
        ];

        foreach ($bookings as $b) {
            $showId = $showMap[$b['show']] ?? null;

            if (!$showId) {
                throw new \Exception("Show '{$b['show']}' belum ada. Jalankan ShowSeeder dulu.");
            }

            // total dihitung di booking item seeder
            Booking::updateOrCreate(
                [
                    'user_id' => $user->id,
                    'show_id' => $showId,
                    'order_date' => $b['order_date'],
                ],
                [
                    'total_harga' => 0, // sementara 0, akan diupdate di BookingItemSeeder
                ]
            );
        }
    }
}
