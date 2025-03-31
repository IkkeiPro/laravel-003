<?php

namespace Database\Seeders;

use App\Models\BasePlan;
use App\Models\BasePlanSpecification;
use App\Models\Specification;
use Illuminate\Database\Seeder;

class BasePlanSpecificationSeeder extends Seeder
{
    public function run(): void
    {
        $basePlans = BasePlan::all();

        // 各仕様カテゴリを取得
        $exteriorSpecs = Specification::where('category', 'exterior')->get();
        $interiorSpecs = Specification::where('category', 'interior')->get();
        $equipmentSpecs = Specification::where('category', 'equipment')->get();

        // すべてのプランに対して基本的な仕様を関連付け
        foreach ($basePlans as $plan) {
            // 外装仕様を関連付け
            foreach ($exteriorSpecs as $spec) {
                BasePlanSpecification::create([
                    'base_plan_id' => $plan->id,
                    'specification_id' => $spec->id,
                    'category' => 'exterior',
                ]);
            }

            // 内装仕様を関連付け
            foreach ($interiorSpecs as $spec) {
                BasePlanSpecification::create([
                    'base_plan_id' => $plan->id,
                    'specification_id' => $spec->id,
                    'category' => 'interior',
                ]);
            }

            // 設備仕様を関連付け
            foreach ($equipmentSpecs as $spec) {
                BasePlanSpecification::create([
                    'base_plan_id' => $plan->id,
                    'specification_id' => $spec->id,
                    'category' => 'equipment',
                ]);
            }
        }
    }
}
