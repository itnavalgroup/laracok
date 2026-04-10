<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TblContractSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tbl_contract')->truncate();

        $data = [
            [
                'id_contract' => 1,
                'id_user' => 1,
                'id_company' => 5,
                'id_departement' => 1,
                'id_attachment' => null,
                'contract_number' => 'CTR.NVL.IT.2603.001',
                'description' => 'Test',
                'file_name' => null,
                'start_date' => '2026-03-25',
                'end_date' => '2026-03-31',
                'created_at' => '2026-03-27 00:11:17',
                'updated_at' => '2026-03-27 00:36:03',
                'deleted_at' => '2026-03-27 00:36:03'
            ]
        ];

        // Insert in chunks to avoid packet-size limits
        foreach (array_chunk($data, 500) as $chunk) {
            DB::table('tbl_contract')->insert($chunk);
        }
    }
}
