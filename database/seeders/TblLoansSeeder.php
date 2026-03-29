<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TblLoansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        $payload = [
                    [
                        'id_loan' => 2,
                        'id_user' => 1,
                        'loan' => 'Bank',
                        'created_at' => '2025-10-22 03:48:23',
                        'updated_at' => '2025-10-22 03:51:26',
                    ],
                    [
                        'id_loan' => 3,
                        'id_user' => 1,
                        'loan' => 'EXIM',
                        'created_at' => '2025-10-22 03:51:46',
                        'updated_at' => '2025-10-22 03:51:46',
                    ],
                    [
                        'id_loan' => 4,
                        'id_user' => 1,
                        'loan' => 'Affiliation',
                        'created_at' => '2025-10-22 03:52:03',
                        'updated_at' => '2025-12-01 04:00:12',
                    ]
        ];

        // Break payload into manageable memory chunks and insert
        $chunks = array_chunk($payload, 50);
        foreach ($chunks as $chunk) {
            DB::table('tbl_loans')->insertOrIgnore($chunk);
        }

        Schema::enableForeignKeyConstraints();
    }
}
