<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TblCostTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        $payload = [
                    [
                        'id_cost_type' => 14,
                        'id_user' => 1,
                        'cost_type' => 'Routine Production',
                        'id_cost_category' => 12,
                        'cost_document' => '',
                        'created_at' => '2025-11-20 07:03:34',
                        'updated_at' => '2025-11-20 07:08:02',
                        'deleted_at' => null,
                    ],
                    [
                        'id_cost_type' => 15,
                        'id_user' => 1,
                        'cost_type' => 'Non Routine Production',
                        'id_cost_category' => 12,
                        'cost_document' => '',
                        'created_at' => '2025-11-20 07:03:50',
                        'updated_at' => '2025-11-20 07:07:51',
                        'deleted_at' => null,
                    ],
                    [
                        'id_cost_type' => 16,
                        'id_user' => 1,
                        'cost_type' => 'Non Routine General',
                        'id_cost_category' => 10,
                        'cost_document' => '',
                        'created_at' => '2025-11-20 07:08:19',
                        'updated_at' => '2025-11-20 07:08:19',
                        'deleted_at' => null,
                    ],
                    [
                        'id_cost_type' => 17,
                        'id_user' => 1,
                        'cost_type' => 'Routine General',
                        'id_cost_category' => 10,
                        'cost_document' => '',
                        'created_at' => '2025-11-20 07:08:35',
                        'updated_at' => '2025-11-20 07:08:35',
                        'deleted_at' => null,
                    ]
        ];

        // Break payload into manageable memory chunks and insert
        $chunks = array_chunk($payload, 50);
        foreach ($chunks as $chunk) {
            DB::table('tbl_cost_types')->insertOrIgnore($chunk);
        }

        Schema::enableForeignKeyConstraints();
    }
}
