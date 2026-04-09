<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TblDepartementSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tbl_departement')->truncate();

        $data = [
            [
                'id_departement' => 1,
                'departement' => 'IT',
                'created_at' => '2025-05-02 12:07:08',
                'updated_at' => '2025-05-05 13:59:00',
                'deleted_at' => null
            ],
            [
                'id_departement' => 2,
                'departement' => 'FINANCE',
                'created_at' => '2025-05-02 12:07:08',
                'updated_at' => '2025-11-19 18:46:22',
                'deleted_at' => null
            ],
            [
                'id_departement' => 3,
                'departement' => 'PA',
                'created_at' => '2025-05-03 13:38:52',
                'updated_at' => '2025-11-19 22:20:13',
                'deleted_at' => null
            ],
            [
                'id_departement' => 4,
                'departement' => 'ACCOUNTING',
                'created_at' => '2025-11-19 18:46:48',
                'updated_at' => '2025-11-19 18:46:48',
                'deleted_at' => null
            ],
            [
                'id_departement' => 5,
                'departement' => 'LEGAL',
                'created_at' => '2025-11-19 18:47:16',
                'updated_at' => '2025-11-19 18:47:16',
                'deleted_at' => null
            ],
            [
                'id_departement' => 6,
                'departement' => 'PRODUCTION',
                'created_at' => '2025-11-19 18:47:23',
                'updated_at' => '2025-11-19 18:47:23',
                'deleted_at' => null
            ],
            [
                'id_departement' => 7,
                'departement' => 'HRD',
                'created_at' => '2025-11-19 18:47:35',
                'updated_at' => '2025-11-19 18:47:35',
                'deleted_at' => null
            ],
            [
                'id_departement' => 8,
                'departement' => 'PURCHASING',
                'created_at' => '2025-11-19 18:48:14',
                'updated_at' => '2025-11-19 18:48:14',
                'deleted_at' => null
            ],
            [
                'id_departement' => 9,
                'departement' => 'LOGISTIC',
                'created_at' => '2025-11-19 18:48:53',
                'updated_at' => '2025-11-19 18:48:53',
                'deleted_at' => null
            ],
            [
                'id_departement' => 10,
                'departement' => 'MANAGEMENT',
                'created_at' => '2025-11-19 19:00:37',
                'updated_at' => '2025-11-19 19:00:37',
                'deleted_at' => null
            ],
            [
                'id_departement' => 11,
                'departement' => 'WAREHOUSE BATANG',
                'created_at' => '2025-11-19 20:05:33',
                'updated_at' => '2025-12-09 14:56:53',
                'deleted_at' => null
            ],
            [
                'id_departement' => 12,
                'departement' => 'FINANCE MANAGER',
                'created_at' => '2025-11-19 22:14:49',
                'updated_at' => '2025-11-19 22:36:19',
                'deleted_at' => null
            ],
            [
                'id_departement' => 13,
                'departement' => 'MARKETING',
                'created_at' => '2025-11-19 22:22:59',
                'updated_at' => '2025-11-19 22:22:59',
                'deleted_at' => null
            ],
            [
                'id_departement' => 14,
                'departement' => 'LAB',
                'created_at' => '2025-11-19 22:31:25',
                'updated_at' => '2025-11-19 22:31:25',
                'deleted_at' => null
            ],
            [
                'id_departement' => 17,
                'departement' => 'GA',
                'created_at' => '2025-12-07 11:36:00',
                'updated_at' => '2025-12-07 11:36:00',
                'deleted_at' => null
            ],
            [
                'id_departement' => 18,
                'departement' => 'WAREHOUSE MEDAN',
                'created_at' => '2025-12-09 14:57:08',
                'updated_at' => '2025-12-09 14:57:08',
                'deleted_at' => null
            ],
            [
                'id_departement' => 19,
                'departement' => 'TA',
                'created_at' => '2026-02-11 19:22:55',
                'updated_at' => '2026-02-11 19:22:55',
                'deleted_at' => null
            ]
        ];

        // Insert in chunks to avoid packet-size limits
        foreach (array_chunk($data, 500) as $chunk) {
            DB::table('tbl_departement')->insert($chunk);
        }
    }
}
