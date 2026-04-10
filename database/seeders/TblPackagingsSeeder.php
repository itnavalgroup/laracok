<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TblPackagingsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tbl_packagings')->truncate();

        $data = [
            [
                'id_packaging' => 1,
                'id_user' => 1,
                'id_departement' => 1,
                'packaging' => 'Test',
                'created_at' => '2026-02-25 07:32:01',
                'updated_at' => '2026-02-25 07:32:07',
                'deleted_at' => '2026-02-25 00:32:07'
            ],
            [
                'id_packaging' => 2,
                'id_user' => 1,
                'id_departement' => 1,
                'packaging' => 'Karung',
                'created_at' => '2026-02-25 21:28:46',
                'updated_at' => '2026-02-25 21:28:46',
                'deleted_at' => null
            ],
            [
                'id_packaging' => 3,
                'id_user' => 1,
                'id_departement' => 1,
                'packaging' => 'IBC',
                'created_at' => '2026-02-25 21:28:58',
                'updated_at' => '2026-02-25 21:28:58',
                'deleted_at' => null
            ],
            [
                'id_packaging' => 4,
                'id_user' => 1,
                'id_departement' => 1,
                'packaging' => 'UNKNOWN',
                'created_at' => '2026-03-25 20:43:19',
                'updated_at' => '2026-03-25 20:43:19',
                'deleted_at' => null
            ],
            [
                'id_packaging' => 5,
                'id_user' => 39,
                'id_departement' => 9,
                'packaging' => 'DRY CONTAINER',
                'created_at' => '2026-03-29 21:53:48',
                'updated_at' => '2026-03-29 21:53:48',
                'deleted_at' => null
            ],
            [
                'id_packaging' => 6,
                'id_user' => 39,
                'id_departement' => 9,
                'packaging' => 'ISOTANK',
                'created_at' => '2026-03-29 22:05:30',
                'updated_at' => '2026-03-29 22:05:30',
                'deleted_at' => null
            ],
            [
                'id_packaging' => 7,
                'id_user' => 40,
                'id_departement' => 8,
                'packaging' => 'DRUM',
                'created_at' => '2026-03-30 02:10:14',
                'updated_at' => '2026-03-30 02:10:14',
                'deleted_at' => null
            ],
            [
                'id_packaging' => 8,
                'id_user' => 39,
                'id_departement' => 9,
                'packaging' => 'WING BOX',
                'created_at' => '2026-03-30 20:51:55',
                'updated_at' => '2026-03-30 20:51:55',
                'deleted_at' => null
            ],
            [
                'id_packaging' => 9,
                'id_user' => 1,
                'id_departement' => 1,
                'packaging' => 'Bottle',
                'created_at' => '2026-04-07 21:39:07',
                'updated_at' => '2026-04-07 21:39:07',
                'deleted_at' => null
            ]
        ];

        // Insert in chunks to avoid packet-size limits
        foreach (array_chunk($data, 500) as $chunk) {
            DB::table('tbl_packagings')->insert($chunk);
        }
    }
}
