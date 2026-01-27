<?php

namespace Database\Seeders;

use App\Models\Booking; // import model Booking dari app/Models/Booking.php
use App\Models\BookingItem; // import model BookingItem dari app/Models/BookingItem.php
use App\Models\Pass; // import model Pass dari app/Models/Pass.php
use App\Models\PassType;
use App\Models\Show; // import model Show dari app/Models/Show.php
use App\Models\User; // import model User dari app/Models/User.php
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookingItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'user@gmail.com')->firstOrFail(); // ambil user berdasarkan email

        // map judul show => id show, supaya tidak pakai angka ID yang bisa berubah
        $showMap = Show::pluck('id', 'judul'); // ambil semua show, key: judul, value: id

        $passTypeMap = PassType::pluck('id', 'nama');

        // daftar item yang akan dibeli (2 booking, masing-masing 1 item)
        $items = [
            [
                'show' => 'Heavy Metal Night',
                'order_date' => '2026-01-10 14:30:00',
                'tipe_pass' => 'premium',
                'jumlah' => 5,
            ],
            [
                'show' => 'Nu Metal Reunion',
                'order_date' => '2026-01-12 16:00:00',
                'tipe_pass' => 'regular',
                'jumlah' => 3,
            ],
        ];

        // simpan booking_id yang terlibat agar totalnya bisa diupdate
        $bookingIds = [];

        foreach ($items as $it) {
            $showId = $showMap[$it['show']] ?? null;

            if (!$showId) {
                throw new \Exception("Show '{$it['show']}' belum ada. Jalankan ShowSeeder dulu.");
            }

            $passTypeId = $passTypeMap[$it['tipe_pass']] ?? null;

            if (!$passTypeId) {
                throw new \Exception("PassType '{$it['tipe_pass']}' belum ada. Jalankan PassTypeSeeder dulu.");
            }


            // ambil booking sesuai user, show, dan order_date
            $booking = Booking::where('user_id', $user->id)
                ->where('show_id', $showId)
                ->where('order_date', $it['order_date'])
                ->firstOrFail();

            // ambil pass sesuai show dan tipe
            $pass = Pass::where('show_id', $showId)
                ->where('pass_type_id', $passTypeId)
                ->firstOrFail();

            $subtotal = $it['jumlah'] * $pass->harga;

            // idempotent: buat booking item, satu booking + satu pass hanya satu baris item
            BookingItem::updateOrCreate(
                [
                    'booking_id' => $booking->id,
                    'pass_id' => $pass->id,
                ],
                [
                    'jumlah' => $it['jumlah'],
                    'subtotal_harga' => $subtotal,
                ]
            );

            // catat booking_id untuk diupdate totalnya nanti
            $bookingIds[] = $booking->id;
        }

        // update total_harga untuk setiap booking yang terkena perubahan
        foreach (array_unique($bookingIds) as $bookingId) {
            $total = BookingItem::where('booking_id', $bookingId)
                ->sum('subtotal_harga');

            Booking::where('id', $bookingId)
                ->update(['total_harga' => $total]);
        }
    }
}
