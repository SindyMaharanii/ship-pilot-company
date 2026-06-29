<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UserSeeder::class,
            CompanySeeder::class,
            ServiceSeeder::class,
            PartnershipSeeder::class,
            PilotShipSeeder::class,
            ContactInfoSeeder::class,
        ]);
    }
}