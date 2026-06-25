<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run()
    {
        $services = [
            [
                'name' => 'Pemanduan Kapal',
                'description' => 'Layanan pemanduan kapal untuk masuk dan keluar pelabuhan dengan aman dan tepat waktu.',
                'icon' => 'ship',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Penundaan Kapal',
                'description' => 'Jasa penundaan kapal menggunakan tugboat untuk membantu maneuver kapal di perairan pelabuhan.',
                'icon' => 'anchor',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Navigasi Maritim',
                'description' => 'Layanan navigasi dan konsultasi rute pelayaran teraman untuk kapal niaga dan wisata.',
                'icon' => 'compass',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Konsultasi Logistik',
                'description' => 'Solusi logistik maritim terintegrasi untuk efisiensi biaya dan waktu operasional.',
                'icon' => 'boxes',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Manajemen Armada',
                'description' => 'Pengelolaan armada kapal secara profesional dengan teknologi monitoring terkini.',
                'icon' => 'chart-line',
                'order' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'Pelatihan & Sertifikasi',
                'description' => 'Program pelatihan dan sertifikasi untuk awak kapal sesuai standar internasional.',
                'icon' => 'graduation-cap',
                'order' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }

        $this->command->info('Service data seeded successfully!');
    }
}