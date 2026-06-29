<?php

namespace Database\Seeders;

use App\Models\ContactInfo;
use Illuminate\Database\Seeder;

class ContactInfoSeeder extends Seeder
{
    public function run()
    {
        if (!ContactInfo::exists()) {
            ContactInfo::create([
                'address' => 'Batam, Kepulauan Riau',
                'phone' => '(0778) 123456',
                'email' => 'pelindospjm@gmail.com',
                'description' => 'Hubungi kami untuk informasi lebih lanjut',
                'map_embed' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.0027353343007!2d104.00787040000002!3d1.1585188000000048!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d989b1eefdfda5%3A0xeef92a8b168a568b!2sPelindo%20Jasa%20Maritim!5e0!3m2!1sid!2sid!4v1780043818157!5m2!1sid!2sid',
                'facebook' => '#',
                'instagram' => '#',
                'twitter' => '#',
                'linkedin' => '#',
                'whatsapp' => '#'
            ]);
            $this->command->info('✅ Contact Info berhasil dibuat!');
        }
    }
}