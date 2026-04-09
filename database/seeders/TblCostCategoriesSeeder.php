<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TblCostCategoriesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tbl_cost_categories')->truncate();

        $data = [
            [
                'id_cost_category' => 10,
                'id_user' => 1,
                'cost_category' => 'General',
                'created_at' => '2025-11-20 00:02:10',
                'updated_at' => '2025-11-20 00:02:10',
                'deleted_at' => null
            ],
            [
                'id_cost_category' => 12,
                'id_user' => 1,
                'cost_category' => 'Production',
                'created_at' => '2025-11-20 00:02:52',
                'updated_at' => '2025-11-20 00:02:52',
                'deleted_at' => null
            ]
        ];

        // Insert in chunks to avoid packet-size limits
        foreach (array_chunk($data, 500) as $chunk) {
            DB::table('tbl_cost_categories')->insert($chunk);
        }
    }
}
