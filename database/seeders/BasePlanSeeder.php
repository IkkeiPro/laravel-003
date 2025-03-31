<?php

namespace Database\Seeders;

use App\Models\BasePlan;
use Illuminate\Database\Seeder;

class BasePlanSeeder extends Seeder
{
    public function run(): void
    {
        $basePlans = [
            [
                'name' => 'シンプルモダンプラン',
                'price_standard' => 2500,
                'comment' => 'シンプルでモダンな雰囲気の住宅プランです。コストパフォーマンスに優れています。',
                'floor_area_1f' => 60.5,
                'floor_area_2f' => 55.8,
                'image_url_1f' => '/images/plans/simple-modern-1f.jpg',
                'image_url_2f' => '/images/plans/simple-modern-2f.jpg',
            ],
            [
                'name' => 'ナチュラルプラン',
                'price_standard' => 2800,
                'comment' => '自然素材を活かした温かみのある住宅プランです。健康と環境に配慮した設計です。',
                'floor_area_1f' => 65.2,
                'floor_area_2f' => 58.7,
                'image_url_1f' => '/images/plans/natural-1f.jpg',
                'image_url_2f' => '/images/plans/natural-2f.jpg',
            ],
            [
                'name' => 'コンテンポラリープラン',
                'price_standard' => 3200,
                'comment' => '現代的なデザインと機能性を兼ね備えた住宅プランです。都市部での生活に最適です。',
                'floor_area_1f' => 70.3,
                'floor_area_2f' => 65.1,
                'image_url_1f' => '/images/plans/contemporary-1f.jpg',
                'image_url_2f' => '/images/plans/contemporary-2f.jpg',
            ],
            [
                'name' => '和モダンプラン',
                'price_standard' => 3500,
                'comment' => '日本の伝統的な要素と現代的なデザインを融合させた住宅プランです。落ち着きのある空間を提供します。',
                'floor_area_1f' => 75.8,
                'floor_area_2f' => 68.4,
                'image_url_1f' => '/images/plans/japanese-modern-1f.jpg',
                'image_url_2f' => '/images/plans/japanese-modern-2f.jpg',
            ],
        ];

        foreach ($basePlans as $plan) {
            BasePlan::create($plan);
        }
    }
}
