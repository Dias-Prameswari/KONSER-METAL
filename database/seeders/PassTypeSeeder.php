<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PassType;

class PassTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = ['regular', 'premium', 'vip', 'early bird'];

        foreach ($types as $t) {
            PassType::updateOrCreate(
                ['nama' => $t],
                ['nama' => $t]
            );
        }
    }
}
