<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CostCategorySeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['id_cost_category' => 10, 'id_user' => 1, 'cost_category' => 'General', 'created_at' => '2025-11-20 07:02:10', 'updated_at' => '2025-11-20 07:02:10', ],
            ['id_cost_category' => 12, 'id_user' => 1, 'cost_category' => 'Production', 'created_at' => '2025-11-20 07:02:52', 'updated_at' => '2025-11-20 07:02:52', ],
        ];

        foreach (array_chunk($data, 100) as $chunk) {
            DB::table('tbl_cost_categories')->upsert($chunk, ['id_cost_category'], ['id_cost_category', 'id_user', 'cost_category', 'created_at', 'updated_at']);
        }
    }
}
