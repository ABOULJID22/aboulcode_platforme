<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SiteSetting;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        if (SiteSetting::count() === 0) {
            SiteSetting::create([
                'email' => 'contact@ABOULCODE.ma',
                'phone' => '+212 71549452',
                'address' => 'Agadir, 85000 Tiznit, Maroc',
                'facebook_url' => 'https://www.facebook.com/',
                'linkedin_url' => 'https://www.linkedin.com/company/ABOULCODE',
                'twitter_url' => 'https://twitter.com/',
                'instagram_url' => 'https://www.instagram.com/ABOULCODE.ma',
                'youtube_url' => 'https://youtube.com/@ABOULCODE',
            ]);
        }
    }
}
