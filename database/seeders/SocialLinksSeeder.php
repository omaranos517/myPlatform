<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SocialLink;

class SocialLinksSeeder extends Seeder
{
    public function run(): void
    {
        $links = [
            ['name' => 'facebook', 'url' => 'https://facebook.com/'],
            ['name' => 'instagram', 'url' => 'https://instagram.com'],
            ['name' => 'whatsapp', 'url' => 'https://wa.me/20123456789'],
            ['name' => 'youtube', 'url' => 'https://youtube.com'],
            ['name' => 'twitter', 'url' => 'https://twitter.com'],
        ];

        foreach ($links as $link) {
            SocialLink::updateOrCreate(['name' => $link['name']], $link);
        }
    }
}
