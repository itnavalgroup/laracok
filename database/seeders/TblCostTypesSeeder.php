<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TblCostTypesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tbl_cost_types')->truncate();

        $data = [
            [
                'id_cost_type' => 14,
                'id_user' => 1,
                'id_cost_category' => 12,
                'cost_type' => 'Routine Production',
                'cost_document' => '',
                'created_at' => '2025-11-20 00:03:34',
                'updated_at' => '2025-11-20 00:08:02',
                'deleted_at' => null
            ],
            [
                'id_cost_type' => 15,
                'id_user' => 1,
                'id_cost_category' => 12,
                'cost_type' => 'Non Routine Production',
                'cost_document' => '',
                'created_at' => '2025-11-20 00:03:50',
                'updated_at' => '2025-11-20 00:07:51',
                'deleted_at' => null
            ],
            [
                'id_cost_type' => 16,
                'id_user' => 1,
                'id_cost_category' => 10,
                'cost_type' => 'Non Routine General',
                'cost_document' => '',
                'created_at' => '2025-11-20 00:08:19',
                'updated_at' => '2025-11-20 00:08:19',
                'deleted_at' => null
            ],
            [
                'id_cost_type' => 17,
                'id_user' => 1,
                'id_cost_category' => 10,
                'cost_type' => 'Routine General',
                'cost_document' => '',
                'created_at' => '2025-11-20 00:08:35',
                'updated_at' => '2025-11-20 00:08:35',
                'deleted_at' => null
            ]
        ];

        // Insert in chunks to avoid packet-size limits
        foreach (array_chunk($data, 500) as $chunk) {
            DB::table('tbl_cost_types')->insert($chunk);
        }
    }
}
