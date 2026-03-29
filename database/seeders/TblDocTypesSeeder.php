<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TblDocTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        $payload = [
                    [
                        'id_doc_type' => 1,
                        'doc_type' => 'Payment',
                        'created_at' => '2025-10-14 19:46:17',
                        'updated_at' => '2025-11-12 10:58:32',
                        'deleted_at' => null,
                    ],
                    [
                        'id_doc_type' => 2,
                        'doc_type' => 'Advance',
                        'created_at' => '2025-10-14 19:46:17',
                        'updated_at' => '2025-11-12 10:58:32',
                        'deleted_at' => null,
                    ],
                    [
                        'id_doc_type' => 3,
                        'doc_type' => 'Settlement',
                        'created_at' => '2026-02-26 11:08:48',
                        'updated_at' => '2026-02-26 11:08:48',
                        'deleted_at' => null,
                    ],
                    [
                        'id_doc_type' => 4,
                        'doc_type' => 'ikb',
                        'created_at' => '2026-02-26 11:09:28',
                        'updated_at' => '2026-02-26 11:09:28',
                        'deleted_at' => null,
                    ]
        ];

        // Break payload into manageable memory chunks and insert
        $chunks = array_chunk($payload, 50);
        foreach ($chunks as $chunk) {
            DB::table('tbl_doc_types')->insertOrIgnore($chunk);
        }

        Schema::enableForeignKeyConstraints();
    }
}
