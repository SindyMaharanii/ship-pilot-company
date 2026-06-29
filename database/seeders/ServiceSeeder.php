<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run()
    {
        $services = [
            ['name' => 'Pandu Masuk', 'description' => 'Layanan pandu untuk kapal yang akan masuk pelabuhan', 'procedure' => '1. Koordinasi dengan syahbandar\n2. Pergerakan kapal pandu\n3. Pandu kapal masuk', 'advantages' => 'Cepat, profesional, dan terjamin keselamatannya', 'order' => 1, 'is_active' => true],
            ['name' => 'Pandu Keluar', 'description' => 'Layanan pandu untuk kapal yang akan keluar pelabuhan', 'procedure' => '1. Koordinasi dengan syahbandar\n2. Pergerakan kapal pandu\n3. Pandu kapal keluar', 'advantages' => 'Cepat, profesional, dan tepat waktu', 'order' => 2, 'is_active' => true],
            ['name' => 'Penundaan Kapal', 'description' => 'Layanan penundaan kapal menggunakan tugboat', 'procedure' => '1. Permohonan penundaan\n2. Pergerakan tugboat\n3. Penundaan kapal', 'advantages' => 'Armada tugboat modern dan berpengalaman', 'order' => 3, 'is_active' => true],
        ];

        foreach ($services as $service) {
            if (!Service::where('name', $service['name'])->exists()) {
                Service::create($service);
            }
        }
        $this->command->info('✅ Services berhasil dibuat!');
    }
}