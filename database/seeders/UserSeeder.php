<?php

namespace Database\Seeders;

use App\Models\User; // import model User dari app/Models/User.php
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin User', // nama
                'email' => 'admin@gmail.com', // email
                'password' => 'password', // akan di-hash oleh cast password: hashed
                'role' => 'admin', // role admin
            ],
            [
                'name' => 'Regular User', // nama
                'email' => 'user@gmail.com', // email
                'password' => 'password', // akan di-hash oleh cast password: hashed
                'no_hp' => '081234567890', // nomor telepon
                'role' => 'user', // role user
            ]
        ];

        // code dari tutorial 
        // foreach ($users as $user) {
        //     User::create($user); // buat user baru di database
        // }

        // code modifikasi supaya tidak duplicate entry saat seeding dijalankan berulang
        foreach ($users as $user) {
            User::updateOrCreate(
                ['email' => $user['email']], // cari user berdasarkan email, kunci unik
                $user //  data untuk diupdate atau dicreate
            );
        }
    }
}
