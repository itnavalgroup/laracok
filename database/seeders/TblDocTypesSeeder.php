<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TblDocTypesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tbl_doc_types')->truncate();

        $data = [
            [
                'id_doc_type' => 1,
                'doc_type' => 'Payment',
                'created_at' => '2025-10-14 12:46:17',
                'updated_at' => '2025-11-12 03:58:32',
                'deleted_at' => null
            ],
            [
                'id_doc_type' => 2,
                'doc_type' => 'Advance',
                'created_at' => '2025-10-14 12:46:17',
                'updated_at' => '2025-11-12 03:58:32',
                'deleted_at' => null
            ],
            [
                'id_doc_type' => 3,
                'doc_type' => 'Settlement',
                'created_at' => '2026-02-26 04:08:48',
                'updated_at' => '2026-02-26 04:08:48',
                'deleted_at' => null
            ],
            [
                'id_doc_type' => 4,
                'doc_type' => 'ikb',
                'created_at' => '2026-02-26 04:09:28',
                'updated_at' => '2026-02-26 04:09:28',
                'deleted_at' => null
            ]
        ];

        // Insert in chunks to avoid packet-size limits
        foreach (array_chunk($data, 500) as $chunk) {
            DB::table('tbl_doc_types')->insert($chunk);
        }
    }
}
