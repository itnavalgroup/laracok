<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TblLoansSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tbl_loans')->truncate();

        $data = [
            [
                'id_loan' => 2,
                'id_user' => 1,
                'loan' => 'Bank',
                'created_at' => '2025-10-21 20:48:23',
                'updated_at' => '2025-10-21 20:51:26'
            ],
            [
                'id_loan' => 3,
                'id_user' => 1,
                'loan' => 'EXIM',
                'created_at' => '2025-10-21 20:51:46',
                'updated_at' => '2025-10-21 20:51:46'
            ],
            [
                'id_loan' => 4,
                'id_user' => 1,
                'loan' => 'Affiliation',
                'created_at' => '2025-10-21 20:52:03',
                'updated_at' => '2025-11-30 21:00:12'
            ]
        ];

        // Insert in chunks to avoid packet-size limits
        foreach (array_chunk($data, 500) as $chunk) {
            DB::table('tbl_loans')->insert($chunk);
        }
    }
}
