<?php

namespace Database\Seeders;

use App\Models\PilotShip;
use Illuminate\Database\Seeder;

class PilotShipSeeder extends Seeder
{
    public function run()
    {
        $ships = [
            ['name' => 'Kapal Pandu 01', 'call_sign' => 'KP-01', 'registration_number' => 'REG-778', 'type' => 'Kapal Pandu', 'status' => 'on_duty', 'capacity' => 13, 'length' => 21, 'width' => 3, 'speed' => 28, 'current_latitude' => -6.2088, 'current_longitude' => 106.8456, 'description' => 'Kapal pandu profesional', 'is_active' => true],
            ['name' => 'Kapal Pandu 02', 'call_sign' => 'KP-02', 'registration_number' => 'REG-779', 'type' => 'Kapal Pandu', 'status' => 'available', 'capacity' => 12, 'length' => 20, 'width' => 3.5, 'speed' => 25, 'current_latitude' => -5.1354, 'current_longitude' => 119.4238, 'description' => 'Kapal pandu profesional', 'is_active' => true],
            ['name' => 'Kapal Pandu 03', 'call_sign' => 'KP-03', 'registration_number' => 'REG-780', 'type' => 'Kapal Pandu', 'status' => 'maintenance', 'capacity' => 10, 'length' => 18, 'width' => 3, 'speed' => 22, 'current_latitude' => -7.2575, 'current_longitude' => 112.7521, 'description' => 'Dalam perawatan', 'is_active' => true],
            ['name' => 'Batam Jet 6', 'call_sign' => '525003368', 'registration_number' => 'REG-781', 'type' => 'Kapal Pandu', 'status' => 'available', 'capacity' => 12, 'length' => 17.2, 'width' => 4.0, 'speed' => 24, 'current_latitude' => 1.11, 'current_longitude' => 103.9, 'description' => 'Kapal pandu Batam', 'is_active' => true],
        ];

        foreach ($ships as $ship) {
            if (!PilotShip::where('call_sign', $ship['call_sign'])->exists()) {
                $ship['last_position_update'] = now();
                PilotShip::create($ship);
            }
        }
        $this->command->info('✅ Pilot Ships berhasil dibuat!');
    }
}