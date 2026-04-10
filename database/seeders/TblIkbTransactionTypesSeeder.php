<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TblIkbTransactionTypesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tbl_ikb_transaction_types')->truncate();

        $data = [
            [
                'id_ikb_transaction_type' => 1,
                'transaction_type' => 'Penjualan',
                'is_active' => 1,
                'created_at' => '2026-03-12 05:03:28',
                'updated_at' => '2026-03-12 05:03:28',
                'deleted_at' => null
            ],
            [
                'id_ikb_transaction_type' => 2,
                'transaction_type' => 'Retur',
                'is_active' => 1,
                'created_at' => '2026-03-12 05:03:28',
                'updated_at' => '2026-03-12 05:03:28',
                'deleted_at' => null
            ],
            [
                'id_ikb_transaction_type' => 3,
                'transaction_type' => 'Tukar Guling',
                'is_active' => 1,
                'created_at' => '2026-03-12 05:03:28',
                'updated_at' => '2026-03-12 05:03:28',
                'deleted_at' => null
            ],
            [
                'id_ikb_transaction_type' => 4,
                'transaction_type' => 'Internal Use',
                'is_active' => 1,
                'created_at' => '2026-03-12 05:03:28',
                'updated_at' => '2026-03-12 05:03:28',
                'deleted_at' => null
            ],
            [
                'id_ikb_transaction_type' => 5,
                'transaction_type' => 'Sample',
                'is_active' => 1,
                'created_at' => '2026-03-12 05:03:28',
                'updated_at' => '2026-03-12 05:03:28',
                'deleted_at' => null
            ],
            [
                'id_ikb_transaction_type' => 6,
                'transaction_type' => 'Produksi',
                'is_active' => 1,
                'created_at' => '2026-03-12 05:03:28',
                'updated_at' => '2026-03-12 05:03:28',
                'deleted_at' => null
            ]
        ];

        // Insert in chunks to avoid packet-size limits
        foreach (array_chunk($data, 500) as $chunk) {
            DB::table('tbl_ikb_transaction_types')->insert($chunk);
        }
    }
}
