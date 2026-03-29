<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LoanSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['id_loan' => 2, 'id_user' => 1, 'loan_name' => 'Bank', 'created_at' => '2025-10-22 03:48:23', 'updated_at' => '2025-10-22 03:51:26', ],
            ['id_loan' => 3, 'id_user' => 1, 'loan_name' => 'EXIM', 'created_at' => '2025-10-22 03:51:46', 'updated_at' => '2025-10-22 03:51:46', ],
            ['id_loan' => 4, 'id_user' => 1, 'loan_name' => 'Affiliation', 'created_at' => '2025-10-22 03:52:03', 'updated_at' => '2025-12-01 04:00:12', ],
        ];

        foreach (array_chunk($data, 100) as $chunk) {
            DB::table('tbl_loans')->upsert($chunk, ['id_loan'], ['id_loan', 'id_user', 'loan_name', 'created_at', 'updated_at']);
        }
    }
}
