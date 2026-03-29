<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CostTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cost_types = [
            ['id_cost_type' => 14, 'id_user' => 1, 'cost_type' => 'Routine Production', 'id_cost_category' => 12, 'cost_document' => '', 'created_at' => '2025-11-20 07:03:34', 'updated_at' => '2025-11-20 07:08:02'],
            ['id_cost_type' => 15, 'id_user' => 1, 'cost_type' => 'Non Routine Production', 'id_cost_category' => 12, 'cost_document' => '', 'created_at' => '2025-11-20 07:03:50', 'updated_at' => '2025-11-20 07:07:51'],
            ['id_cost_type' => 16, 'id_user' => 1, 'cost_type' => 'Non Routine General', 'id_cost_category' => 10, 'cost_document' => '', 'created_at' => '2025-11-20 07:08:19', 'updated_at' => '2025-11-20 07:08:19'],
            ['id_cost_type' => 17, 'id_user' => 1, 'cost_type' => 'Routine General', 'id_cost_category' => 10, 'cost_document' => '', 'created_at' => '2025-11-20 07:08:35', 'updated_at' => '2025-11-20 07:08:35'],
        ];

        DB::table('tbl_cost_types')->upsert(
            $cost_types,
            ['id_cost_type'],
            ['id_user', 'cost_type', 'id_cost_category', 'cost_document', 'created_at', 'updated_at']
        );
    }
}
