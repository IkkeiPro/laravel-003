<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            BasePlanSeeder::class,
            SpecificationSeeder::class,
            BasePlanSpecificationSeeder::class,
        ]);
    }
}
