<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        Setting::updateOrCreate(
            ['id' => 1], // نفترض صف واحد فقط
            [
                'platform_name' => '(اسم المنصة)',
                'phone' => '2010000000',
                'email' => 'info@example.edu',
            ]
        );
    }
}
