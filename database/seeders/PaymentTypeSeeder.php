<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PaymentType;

class PaymentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = ['dana', 'bank bca', 'go-pay', 'paypal'];

        foreach ($types as $t) {
            PaymentType::updateOrCreate(
                ['nama' => $t],
                ['nama' => $t]
            );
        }
    }
}
