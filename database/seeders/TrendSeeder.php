<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Trend;
use App\Models\TrendTiktok;

class TrendSeeder extends Seeder
{
    public function run()
    {
        // Trend 1: Y2K Aesthetic
        $trend1 = Trend::create([
            'title' => 'Y2K Streetwear Aesthetic',
            'description' => 'Gaya nostalgia tahun 2000-an dengan baggy jeans, crop tops, dan chunky sneakers. Perfect untuk casual hangout!',
            'cover_image' => 'trends/y2k-trend.jpg', // Ganti dengan path image yang valid
            'is_active' => true
        ]);

        TrendTiktok::create([
            'trend_id' => $trend1->id,
            'tiktok_url' => 'https://www.tiktok.com/@example1',
            'caption' => 'Y2K vibes with baggy jeans',
            'creator_name' => 'fashionista_id'
        ]);

        // Trend 2: Korean Minimalist
        $trend2 = Trend::create([
            'title' => 'Korean Minimalist Style',
            'description' => 'Clean lines, neutral colors, dan oversized fit. Simpel tapi tetap stylish!',
            'cover_image' => 'trends/korean-minimal.jpg',
            'is_active' => true
        ]);

        TrendTiktok::create([
            'trend_id' => $trend2->id,
            'tiktok_url' => 'https://www.tiktok.com/@example2',
            'caption' => 'Korean minimal outfit inspo',
            'creator_name' => 'koreanfashion'
        ]);

        // Trend 3: Old Money Aesthetic
        $trend3 = Trend::create([
            'title' => 'Old Money Aesthetic',
            'description' => 'Classy, timeless, dan sophisticated. Polo shirts, loafers, dan neutral tones.',
            'cover_image' => 'trends/old-money.jpg',
            'is_active' => true
        ]);

        TrendTiktok::create([
            'trend_id' => $trend3->id,
            'tiktok_url' => 'https://www.tiktok.com/@example3',
            'caption' => 'Old money style guide',
            'creator_name' => 'luxuryfashion'
        ]);
    }
}