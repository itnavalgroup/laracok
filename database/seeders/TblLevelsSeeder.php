<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TblLevelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        $payload = [
                    [
                        'id_level' => 1,
                        'level' => 1,
                        'level_name' => 'admin',
                        'created_at' => '2025-10-10 09:51:38',
                        'updated_at' => '2025-10-10 09:51:38',
                        'deleted_at' => null,
                    ],
                    [
                        'id_level' => 2,
                        'level' => 2,
                        'level_name' => 'user',
                        'created_at' => '2025-10-10 09:51:38',
                        'updated_at' => '2025-10-10 09:51:38',
                        'deleted_at' => null,
                    ],
                    [
                        'id_level' => 3,
                        'level' => 3,
                        'level_name' => 'departement head',
                        'created_at' => '2025-10-10 09:51:38',
                        'updated_at' => '2025-10-10 09:51:38',
                        'deleted_at' => null,
                    ],
                    [
                        'id_level' => 4,
                        'level' => 4,
                        'level_name' => 'director',
                        'created_at' => '2025-10-10 09:51:38',
                        'updated_at' => '2025-10-10 09:51:38',
                        'deleted_at' => null,
                    ],
                    [
                        'id_level' => 5,
                        'level' => 5,
                        'level_name' => 'accounting',
                        'created_at' => '2025-10-10 09:51:38',
                        'updated_at' => '2025-10-10 09:51:38',
                        'deleted_at' => null,
                    ],
                    [
                        'id_level' => 6,
                        'level' => 6,
                        'level_name' => 'finance staff',
                        'created_at' => '2025-10-10 09:51:38',
                        'updated_at' => '2025-10-10 09:51:38',
                        'deleted_at' => null,
                    ],
                    [
                        'id_level' => 7,
                        'level' => 7,
                        'level_name' => 'finance supervisor',
                        'created_at' => '2025-10-10 09:51:38',
                        'updated_at' => '2025-10-10 09:51:38',
                        'deleted_at' => null,
                    ],
                    [
                        'id_level' => 8,
                        'level' => 8,
                        'level_name' => 'chief finance officer',
                        'created_at' => '2025-10-10 09:51:38',
                        'updated_at' => '2025-10-10 09:51:38',
                        'deleted_at' => null,
                    ]
        ];

        // Break payload into manageable memory chunks and insert
        $chunks = array_chunk($payload, 50);
        foreach ($chunks as $chunk) {
            DB::table('tbl_levels')->insertOrIgnore($chunk);
        }

        Schema::enableForeignKeyConstraints();
    }
}
