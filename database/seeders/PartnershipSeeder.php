<?php

namespace Database\Seeders;

use App\Models\Partnership;
use Illuminate\Database\Seeder;

class PartnershipSeeder extends Seeder
{
    public function run()
    {
        $partnerships = [
            [
                'partner_name' => 'Pelindo',
                'description' => 'Kerja sama operasional pelabuhan dan jasa kepelabuhanan.',
                'is_active' => true,
            ],
            [
                'partner_name' => 'Pertamina',
                'description' => 'Mitra strategis dalam penyediaan bahan bakar kapal.',
                'is_active' => true,
            ],
            [
                'partner_name' => 'ASDP Indonesia',
                'description' => 'Kerja sama penyeberangan dan logistik antar pulau.',
                'is_active' => true,
            ],
            [
                'partner_name' => 'Tanjung Priok Port',
                'description' => 'Kemitraan operasional di pelabuhan utama Jakarta.',
                'is_active' => true,
            ],
            [
                'partner_name' => 'Bakauheni Port',
                'description' => 'Kerja sama di pelabuhan strategis Lampung.',
                'is_active' => true,
            ],
            [
                'partner_name' => 'KBN Indonesia',
                'description' => 'Mitra dalam pengembangan kawasan industri maritim.',
                'is_active' => true,
            ],
        ];

        foreach ($partnerships as $partner) {
            Partnership::create($partner);
        }

        $this->command->info('Partnership data seeded successfully!');
    }
}