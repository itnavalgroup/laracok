<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $doc_types = [
            ['id_doc_type' => 1, 'doc_type' => 'Payment', 'created_at' => '2025-10-14 19:46:17', 'updated_at' => '2025-11-12 10:58:32'],
            ['id_doc_type' => 2, 'doc_type' => 'Advance', 'created_at' => '2025-10-14 19:46:17', 'updated_at' => '2025-11-12 10:58:32'],
            ['id_doc_type' => 3, 'doc_type' => 'Reimbursement', 'created_at' => '2025-10-14 19:46:17', 'updated_at' => '2025-11-12 10:58:32'],
        ];

        DB::table('tbl_doc_types')->upsert(
            $doc_types,
            ['id_doc_type'],
            ['doc_type', 'created_at', 'updated_at']
        );
    }
}
