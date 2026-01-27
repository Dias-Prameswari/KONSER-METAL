# KONSER-METAL - Aplikasi Ticketing Konser (Laravel)
## Gambaran Umum
##### Database: ticketing_system_new
##### Tema: Ticketing konser dengan genre musik metal atau rock
##### Deskripsi: Aplikasi ini digunakan untuk mengelola show konser (oleh admin) dan pemesanan tiket (oleh user). Data konser dikelompokkan berdasarkan genre, tiket memiliki tipe (mis. Regular/VIP/VVIP, dll) serta stok, dan transaksi booking tersimpan per item dengan jumlah dan subtotal. Sistem juga mendukung metode pembayaran dan diskon yang bersifat opsional.
##### Genre: 
Genre yang digunakan pada aplikasi:
1.	Heavy Metal
2.	Metalcore
3.	Nu Metal
4.	Hard Rock
5.	Post-Hardcore
6.	Alternative
##### Penyesuaian Nama untuk tema konser:
1. Kategori → Genre
2. Event → Show
3. Tiket → Pass / Passes
4. Order → Booking
5. DetailOrder → BookingItem
## Skema Aplikasi
1. Use case admin
![Skema Aplikasi](skema-aplikasi/use-case-admin-tema-konser.png)
2. Use case pembeli
![Skema Aplikasi](skema-aplikasi/use-case-pembeli-tema-konser.png)
3. Struktur database
![Skema Aplikasi](skema-aplikasi/erd-project-konser-workshop-web-developer.jpeg)
## ERD dan relasi
### Entitas utama
- users: data akun dan role (admin / user)
- genres: master genre
- shows: data konser/show (judul, deskripsi, lokasi, waktu, gambar)
- pass_types: master tipe tiket (mis. VIP/Regular/VVIP/early bird)
- passes: tiket per show dan tipe (harga, stok)
- bookings: transaksi pemesanan (order_date, total, final_total, dll.)
- booking_items: detail item transaksi (pass, jumlah, subtotal)
- payment_types: master metode pembayaran (opsional di booking)
- discounts: master diskon (opsional di booking)
### Relasi
- users 1—* shows (shows.user_id)
- genres 1—* shows (shows.genre_id)
- shows 1—* passes (passes.show_id)
- pass_types 1—* passes (passes.pass_type_id)
- users 1—* bookings (bookings.user_id)
- shows 1—* bookings (bookings.show_id)
- payment_types 1—* bookings (bookings.payment_type_id, nullable)
- discounts 1—* bookings (bookings.discount_id, nullable)
- bookings 1—* booking_items (booking_items.booking_id)
- passes 1—* booking_items (booking_items.pass_id)
- M:N: bookings *—* passes via booking_items
- catatan: Secara konsep, Booking ↔ Pass adalah many-to-many karena:
  - satu booking dapat berisi banyak pass,
  - satu pass dapat muncul di banyak booking,
  - hubungan dihubungkan oleh tabel booking_items (booking_id, pass_id) yang juga menyimpan atribut transaksi (jumlah, subtotal_harga).
### Relasi Eloquent
1. Master & Konten
- User hasMany Shows ; Show belongsTo User
- Genre hasMany Shows ; Show belongsTo Genre
- Show hasMany Passes ; Pass belongsTo Show
- PassType hasMany Passes ; Pass belongsTo PassType
2. Transaksi
- User hasMany Bookings ; Booking belongsTo User
- Show hasMany Bookings ; Booking belongsTo Show
- Booking hasMany BookingItems ; BookingItem belongsTo Booking
- Pass hasMany BookingItems ; BookingItem belongsTo Pass
- Booking belongsToMany Passes (via booking_items) ; Pass belongsToMany Bookings (via booking_items)
3. Pembayaran & Diskon
- PaymentType hasMany Bookings ; Booking belongsTo PaymentType 
- Discount hasMany Bookings ; Booking belongsTo Discount 
## Konsep MVC 
1. Model (M)
   - Tugas: mengelola data + relasi ke database (Eloquent ORM).
   - Contoh di project: Show, Pass, Booking, BookingItem, Genre, PaymentType, Discount.
   - Relasi ditulis di Model (hasMany, belongsTo, belongsToMany).
   - Model dipakai controller untuk query (Show::with(...), Booking::create(...), dll).
2. View (V)
   - Tugas: tampilan UI (Blade), hanya menampilkan data yang sudah disiapkan controller.
   - Contoh: resources/views/... seperti halaman shows, bookings, admin riwayat, payment types, discount.
   - View tidak melakukan query database (hindari logic berat di Blade).
   - View menerima data dari controller lewat return view('...', compact(...)).
3. Controller (C)
   - Tugas: “otak” alur aplikasi: terima request → validasi → panggil model → kirim ke view / redirect.
   - Contoh: ShowController, BookingController, RiwayatBookingController, PaymentTypeController, dll.
   - Pola alur: Route → Controller → Model → (kembali) Controller → View
## Git Clone
1. buka repository GitHub di browser, copy url repository
2. url respository: https://github.com/Dias-Prameswari/KONSER-METAL.git
3. buat folder baru di komputer, buka di vs code
4. buka terminal, jalankan perintah : git clone (url repository), tunggu sampai selesai
5. masuk ke direktori project, menu file-open folder, pilih folder project
6. buka terminal, jalankan perintah install dependency PHP : composer install, tunggu sampai selesai
7. buka terminal, jalankan perintah install dependency frontend : npm install, tunggu sampai selesai
8. rename file .env.example menjadi .env, atur konfigurasi database (biasanya di baris 23)
9. Perubahan .env.example ke .env, diganti bagian ini aja
- DB_CONNECTION=mysql
- DB_HOST=127.0.0.1
- DB_PORT=3306
- DB_DATABASE=ticketing_system_new
- DB_USERNAME=root
- DB_PASSWORD=
10. buka terminal, jalankan perintah generate app key : php artisan key:generate
11. buka terminal, jalankan perintah migrasi database: php artisan migrate
12. buka terminal, jalankan perintah seeder : php artisan db:seed
13. buka terminal baru, jalankan perintah server laravel : php artisan serve
14. buka terminal baru, jalankan perintah frontend dev server : npm run dev
15. disarankan : pakai terminal yang tipenya Command Prompt
## Fungsi Perintah php artisan yang Sering Dipakai
1. php artisan key:generate
   - Membuat APP_KEY di .env untuk keamanan session/enkripsi.
2. php artisan migrate
   - Menjalankan file migration untuk membuat/ubah tabel.
3. php artisan db:seed
   - Mengisi data awal dari seeder (genre, pass_type, payment_type, dll).
4. php artisan migrate:fresh --seed
   - Reset total database (drop semua tabel), lalu migrate ulang + seed. (Hati-hati, data hilang.)
5. php artisan route:list
   - Melihat daftar route yang aktif (berguna saat debugging).
6. php artisan make:model X -m
   - Buat model sekaligus migration.
7. php artisan make:controller XController --resource
   - Buat controller CRUD (index/create/store/show/edit/update/destroy).
