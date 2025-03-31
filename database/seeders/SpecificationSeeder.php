<?php

namespace Database\Seeders;

use App\Models\Specification;
use App\Models\SpecificationMeisai;
use Illuminate\Database\Seeder;

class SpecificationSeeder extends Seeder
{
    public function run(): void
    {
        // 外装仕様
        $exteriorSpecs = [
            [
                'category' => 'exterior',
                'title' => '外壁材',
                'description' => '建物の外観と耐久性を左右する重要な要素です',
                'meisai' => [
                    ['line_no' => 1, 'name' => 'サイディング（標準）', 'price' => 0, 'is_enabled' => 1, 'is_default' => 1],
                    ['line_no' => 2, 'name' => 'タイル貼り', 'price' => 1200000, 'is_enabled' => 1, 'is_default' => 0],
                    ['line_no' => 3, 'name' => '塗り壁', 'price' => 800000, 'is_enabled' => 1, 'is_default' => 0],
                    ['line_no' => 4, 'name' => '天然石貼り', 'price' => 1800000, 'is_enabled' => 1, 'is_default' => 0],
                ]
            ],
            [
                'category' => 'exterior',
                'title' => '屋根材',
                'description' => '耐候性と美観を兼ね備えた屋根材を選べます',
                'meisai' => [
                    ['line_no' => 1, 'name' => 'アスファルトシングル（標準）', 'price' => 0, 'is_enabled' => 1, 'is_default' => 1],
                    ['line_no' => 2, 'name' => 'ガルバリウム鋼板', 'price' => 600000, 'is_enabled' => 1, 'is_default' => 0],
                    ['line_no' => 3, 'name' => '陶器瓦', 'price' => 1500000, 'is_enabled' => 1, 'is_default' => 0],
                    ['line_no' => 4, 'name' => 'スレート', 'price' => 400000, 'is_enabled' => 1, 'is_default' => 0],
                ]
            ],
            [
                'category' => 'exterior',
                'title' => '玄関ドア',
                'description' => '家の顔となる玄関ドアのグレードを選べます',
                'meisai' => [
                    ['line_no' => 1, 'name' => '標準玄関ドア', 'price' => 0, 'is_enabled' => 1, 'is_default' => 1],
                    ['line_no' => 2, 'name' => '断熱高性能ドア', 'price' => 350000, 'is_enabled' => 1, 'is_default' => 0],
                    ['line_no' => 3, 'name' => '電子錠付き高性能ドア', 'price' => 450000, 'is_enabled' => 1, 'is_default' => 0],
                ]
            ],
        ];

        // 内装仕様
        $interiorSpecs = [
            [
                'category' => 'interior',
                'title' => 'フローリング',
                'description' => '日々の生活を支える床材はグレードの違いで快適性が変わります',
                'meisai' => [
                    ['line_no' => 1, 'name' => '複合フローリング（標準）', 'price' => 0, 'is_enabled' => 1, 'is_default' => 1],
                    ['line_no' => 2, 'name' => '無垢フローリング（国産）', 'price' => 900000, 'is_enabled' => 1, 'is_default' => 0],
                    ['line_no' => 3, 'name' => '無垢フローリング（輸入）', 'price' => 700000, 'is_enabled' => 1, 'is_default' => 0],
                    ['line_no' => 4, 'name' => '畳敷き（一部）', 'price' => 300000, 'is_enabled' => 1, 'is_default' => 0],
                ]
            ],
            [
                'category' => 'interior',
                'title' => '内壁',
                'description' => '室内の雰囲気を決める内壁材のグレードアップ',
                'meisai' => [
                    ['line_no' => 1, 'name' => 'ビニールクロス（標準）', 'price' => 0, 'is_enabled' => 1, 'is_default' => 1],
                    ['line_no' => 2, 'name' => '珪藻土塗り', 'price' => 650000, 'is_enabled' => 1, 'is_default' => 0],
                    ['line_no' => 3, 'name' => '無垢板貼り（一部）', 'price' => 950000, 'is_enabled' => 1, 'is_default' => 0],
                    ['line_no' => 4, 'name' => '漆喰塗り', 'price' => 750000, 'is_enabled' => 1, 'is_default' => 0],
                ]
            ],
            [
                'category' => 'interior',
                'title' => '収納',
                'description' => '生活空間をすっきりさせる収納スペースの充実',
                'meisai' => [
                    ['line_no' => 1, 'name' => '標準クローゼット', 'price' => 0, 'is_enabled' => 1, 'is_default' => 1],
                    ['line_no' => 2, 'name' => 'ウォークインクローゼット', 'price' => 500000, 'is_enabled' => 1, 'is_default' => 0],
                    ['line_no' => 3, 'name' => '造作収納棚増設', 'price' => 350000, 'is_enabled' => 1, 'is_default' => 0],
                ]
            ],
        ];

        // 設備仕様
        $equipmentSpecs = [
            [
                'category' => 'equipment',
                'title' => 'キッチン',
                'description' => '毎日使うキッチンは機能性とデザイン性を兼ね備えたものを',
                'meisai' => [
                    ['line_no' => 1, 'name' => '標準システムキッチン', 'price' => 0, 'is_enabled' => 1, 'is_default' => 1],
                    ['line_no' => 2, 'name' => 'ハイグレードシステムキッチン', 'price' => 1200000, 'is_enabled' => 1, 'is_default' => 0],
                    ['line_no' => 3, 'name' => 'オーダーキッチン', 'price' => 2500000, 'is_enabled' => 1, 'is_default' => 0],
                ]
            ],
            [
                'category' => 'equipment',
                'title' => 'バスルーム',
                'description' => '一日の疲れを癒す空間をグレードアップ',
                'meisai' => [
                    ['line_no' => 1, 'name' => '標準ユニットバス', 'price' => 0, 'is_enabled' => 1, 'is_default' => 1],
                    ['line_no' => 2, 'name' => 'ハイグレードユニットバス', 'price' => 800000, 'is_enabled' => 1, 'is_default' => 0],
                    ['line_no' => 3, 'name' => 'タイル貼り在来工法', 'price' => 1600000, 'is_enabled' => 1, 'is_default' => 0],
                ]
            ],
            [
                'category' => 'equipment',
                'title' => 'トイレ',
                'description' => '清潔感と快適性を高めるトイレ設備',
                'meisai' => [
                    ['line_no' => 1, 'name' => '標準温水洗浄便座', 'price' => 0, 'is_enabled' => 1, 'is_default' => 1],
                    ['line_no' => 2, 'name' => 'タンクレストイレ', 'price' => 250000, 'is_enabled' => 1, 'is_default' => 0],
                    ['line_no' => 3, 'name' => '最新自動機能付きトイレ', 'price' => 450000, 'is_enabled' => 1, 'is_default' => 0],
                ]
            ],
            [
                'category' => 'equipment',
                'title' => '冷暖房システム',
                'description' => '年間を通して快適な室内環境を実現',
                'meisai' => [
                    ['line_no' => 1, 'name' => 'エアコン設置（リビングのみ）', 'price' => 0, 'is_enabled' => 1, 'is_default' => 1],
                    ['line_no' => 2, 'name' => '全館空調システム', 'price' => 2000000, 'is_enabled' => 1, 'is_default' => 0],
                    ['line_no' => 3, 'name' => '床暖房（リビング）', 'price' => 600000, 'is_enabled' => 1, 'is_default' => 0],
                    ['line_no' => 4, 'name' => '床暖房（全館）', 'price' => 1500000, 'is_enabled' => 1, 'is_default' => 0],
                ]
            ],
        ];

        // 全ての仕様カテゴリを結合
        $allSpecs = array_merge($exteriorSpecs, $interiorSpecs, $equipmentSpecs);

        foreach ($allSpecs as $spec) {
            $meisaiItems = $spec['meisai'];
            unset($spec['meisai']);

            // 仕様親テーブルにデータ挿入
            $specification = Specification::create($spec);

            // 仕様明細テーブルにデータ挿入
            foreach ($meisaiItems as $meisai) {
                $specification->specificationsMeisai()->create($meisai);
            }
        }
    }
}
