<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    public function run()
    {
        if (!Company::exists()) {
            Company::create([
                'name' => 'PT Pelindo Jasa Maritim Cabang Batam',
                'history' => 'PT Pelindo Jasa Maritim (SPJM) merupakan anak perusahaan dari PT Pelabuhan Indonesia (Persero) yang bergerak di bidang penyediaan jasa kemaritiman terintegrasi.',
                'vision' => 'Menjadi pemimpin jasa kemaritiman yang terintegrasi dan berkelas dunia.',
                'mission' => 'Mewujudkan jaringan ekosistem maritim nasional melalui pengelolaan jasa kemaritiman yang handal, efisien, agile dan memenuhi harapan seluruh stakeholder.',
                'description' => 'Subholding PT Pelabuhan Indonesia (Persero) yang berfokus pada penyediaan layanan jasa purnajual maritim yang terintegrasi, andal, dan mengutamakan keselamatan tinggi.',
                'phone' => '(0778) 123456',
                'email' => 'info@shippilot.com',
                'address' => 'Batam, Kepulauan Riau'
            ]);
            $this->command->info('✅ Company berhasil dibuat!');
        }
    }
}