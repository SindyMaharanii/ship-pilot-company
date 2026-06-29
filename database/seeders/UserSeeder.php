<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        if (!User::where('email', 'admin@shippilot.com')->exists()) {
            User::create([
                'name' => 'Administrator',
                'email' => 'admin@shippilot.com',
                'password' => Hash::make('password123'),
                'is_admin' => true,
            ]);
            $this->command->info('✅ User Admin berhasil dibuat!');
        }
    }
}