<?php

namespace Database\Seeders;

use App\Models\Partnership;
use Illuminate\Database\Seeder;

class PartnershipSeeder extends Seeder
{
    public function run()
    {
        $partnerships = [
            ['partner_name' => 'PT Samudera Lines', 'description' => 'Perusahaan pelayaran nasional', 'is_active' => true],
            ['partner_name' => 'PT Marina Indah', 'description' => 'Perusahaan logistik maritim', 'is_active' => true],
            ['partner_name' => 'Wilson Shipping', 'description' => 'Perusahaan shipping internasional', 'is_active' => true],
            ['partner_name' => 'Tan Logistik Group', 'description' => 'Perusahaan logistik terintegrasi', 'is_active' => true],
        ];

        foreach ($partnerships as $partner) {
            if (!Partnership::where('partner_name', $partner['partner_name'])->exists()) {
                Partnership::create($partner);
            }
        }
        $this->command->info('✅ Partnerships berhasil dibuat!');
    }
}