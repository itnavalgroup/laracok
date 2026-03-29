<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TblCostCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        $payload = [
                    [
                        'id_cost_category' => 10,
                        'id_user' => 1,
                        'cost_category' => 'General',
                        'created_at' => '2025-11-20 07:02:10',
                        'updated_at' => '2025-11-20 07:02:10',
                        'deleted_at' => null,
                    ],
                    [
                        'id_cost_category' => 12,
                        'id_user' => 1,
                        'cost_category' => 'Production',
                        'created_at' => '2025-11-20 07:02:52',
                        'updated_at' => '2025-11-20 07:02:52',
                        'deleted_at' => null,
                    ]
        ];

        // Break payload into manageable memory chunks and insert
        $chunks = array_chunk($payload, 50);
        foreach ($chunks as $chunk) {
            DB::table('tbl_cost_categories')->insertOrIgnore($chunk);
        }

        Schema::enableForeignKeyConstraints();
    }
}
