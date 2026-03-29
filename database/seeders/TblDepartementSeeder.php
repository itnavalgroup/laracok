<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TblDepartementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        $payload = [
                    [
                        'id_departement' => 1,
                        'departement' => 'IT',
                        'created_at' => '2025-05-02 19:07:08',
                        'updated_at' => '2025-05-05 20:59:00',
                        'deleted_at' => null,
                    ],
                    [
                        'id_departement' => 2,
                        'departement' => 'FINANCE',
                        'created_at' => '2025-05-02 19:07:08',
                        'updated_at' => '2025-11-20 01:46:22',
                        'deleted_at' => null,
                    ],
                    [
                        'id_departement' => 3,
                        'departement' => 'PA',
                        'created_at' => '2025-05-03 20:38:52',
                        'updated_at' => '2025-11-20 05:20:13',
                        'deleted_at' => null,
                    ],
                    [
                        'id_departement' => 4,
                        'departement' => 'ACCOUNTING',
                        'created_at' => '2025-11-20 01:46:48',
                        'updated_at' => '2025-11-20 01:46:48',
                        'deleted_at' => null,
                    ],
                    [
                        'id_departement' => 5,
                        'departement' => 'LEGAL',
                        'created_at' => '2025-11-20 01:47:16',
                        'updated_at' => '2025-11-20 01:47:16',
                        'deleted_at' => null,
                    ],
                    [
                        'id_departement' => 6,
                        'departement' => 'PRODUCTION',
                        'created_at' => '2025-11-20 01:47:23',
                        'updated_at' => '2025-11-20 01:47:23',
                        'deleted_at' => null,
                    ],
                    [
                        'id_departement' => 7,
                        'departement' => 'HRD',
                        'created_at' => '2025-11-20 01:47:35',
                        'updated_at' => '2025-11-20 01:47:35',
                        'deleted_at' => null,
                    ],
                    [
                        'id_departement' => 8,
                        'departement' => 'PURCHASING',
                        'created_at' => '2025-11-20 01:48:14',
                        'updated_at' => '2025-11-20 01:48:14',
                        'deleted_at' => null,
                    ],
                    [
                        'id_departement' => 9,
                        'departement' => 'LOGISTIC',
                        'created_at' => '2025-11-20 01:48:53',
                        'updated_at' => '2025-11-20 01:48:53',
                        'deleted_at' => null,
                    ],
                    [
                        'id_departement' => 10,
                        'departement' => 'MANAGEMENT',
                        'created_at' => '2025-11-20 02:00:37',
                        'updated_at' => '2025-11-20 02:00:37',
                        'deleted_at' => null,
                    ],
                    [
                        'id_departement' => 11,
                        'departement' => 'WAREHOUSE BATANG',
                        'created_at' => '2025-11-20 03:05:33',
                        'updated_at' => '2025-12-09 21:56:53',
                        'deleted_at' => null,
                    ],
                    [
                        'id_departement' => 12,
                        'departement' => 'FINANCE MANAGER',
                        'created_at' => '2025-11-20 05:14:49',
                        'updated_at' => '2025-11-20 05:36:19',
                        'deleted_at' => null,
                    ],
                    [
                        'id_departement' => 13,
                        'departement' => 'MARKETING',
                        'created_at' => '2025-11-20 05:22:59',
                        'updated_at' => '2025-11-20 05:22:59',
                        'deleted_at' => null,
                    ],
                    [
                        'id_departement' => 14,
                        'departement' => 'LAB',
                        'created_at' => '2025-11-20 05:31:25',
                        'updated_at' => '2025-11-20 05:31:25',
                        'deleted_at' => null,
                    ],
                    [
                        'id_departement' => 17,
                        'departement' => 'GA',
                        'created_at' => '2025-12-07 18:36:00',
                        'updated_at' => '2025-12-07 18:36:00',
                        'deleted_at' => null,
                    ],
                    [
                        'id_departement' => 18,
                        'departement' => 'WAREHOUSE MEDAN',
                        'created_at' => '2025-12-09 21:57:08',
                        'updated_at' => '2025-12-09 21:57:08',
                        'deleted_at' => null,
                    ],
                    [
                        'id_departement' => 19,
                        'departement' => 'TA',
                        'created_at' => '2026-02-12 02:22:55',
                        'updated_at' => '2026-02-12 02:22:55',
                        'deleted_at' => null,
                    ]
        ];

        // Break payload into manageable memory chunks and insert
        $chunks = array_chunk($payload, 50);
        foreach ($chunks as $chunk) {
            DB::table('tbl_departement')->insertOrIgnore($chunk);
        }

        Schema::enableForeignKeyConstraints();
    }
}
