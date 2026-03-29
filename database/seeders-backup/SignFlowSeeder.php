<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SignFlowSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['id_sign_flow' => 1, 'id_doc_type' => 1, 'step_order' => 1, 'required' => 1, 'level' => 2, 'description' => 'Sign by maker', 'created_at' => '2025-10-16 03:17:18', 'updated_at' => '2025-10-16 06:17:53',],
            ['id_sign_flow' => 2, 'id_doc_type' => 1, 'step_order' => 2, 'required' => 1, 'level' => 3, 'description' => 'Sign By Departement Head Or Superior User

', 'created_at' => '2025-10-16 03:39:58', 'updated_at' => '2025-10-16 03:39:58',],
            ['id_sign_flow' => 3, 'id_doc_type' => 1, 'step_order' => 3, 'required' => 1, 'level' => 4, 'description' => 'Sign By Director', 'created_at' => '2025-10-16 03:42:04', 'updated_at' => '2025-10-16 03:42:04',],
            ['id_sign_flow' => 4, 'id_doc_type' => 1, 'step_order' => 4, 'required' => 1, 'level' => 5, 'description' => 'Sign By Accounting', 'created_at' => '2025-10-16 03:42:52', 'updated_at' => '2025-10-16 03:42:52',],
            ['id_sign_flow' => 5, 'id_doc_type' => 1, 'step_order' => 5, 'required' => 1, 'level' => 6, 'description' => 'Sign By Finance Staff', 'created_at' => '2025-10-16 03:43:27', 'updated_at' => '2025-10-16 03:43:27',],
            ['id_sign_flow' => 6, 'id_doc_type' => 1, 'step_order' => 6, 'required' => 1, 'level' => 7, 'description' => 'Sign By Finance Supervisor', 'created_at' => '2025-10-16 03:44:16', 'updated_at' => '2025-10-16 03:44:16',],
            ['id_sign_flow' => 7, 'id_doc_type' => 3, 'step_order' => 1, 'required' => 1, 'level' => 2, 'description' => 'Sign By Maker', 'created_at' => '2025-10-16 04:01:53', 'updated_at' => '2025-10-16 04:01:53',],
            ['id_sign_flow' => 8, 'id_doc_type' => 3, 'step_order' => 2, 'required' => 1, 'level' => 3, 'description' => 'Sign By Departement Head Or Superior User', 'created_at' => '2025-10-16 04:17:40', 'updated_at' => '2025-10-16 04:17:40',],
            ['id_sign_flow' => 9, 'id_doc_type' => 3, 'step_order' => 3, 'required' => 1, 'level' => 4, 'description' => 'Sign By Director', 'created_at' => '2025-10-16 04:18:11', 'updated_at' => '2025-10-16 04:18:11',],
            ['id_sign_flow' => 10, 'id_doc_type' => 3, 'step_order' => 5, 'required' => 1, 'level' => 6, 'description' => 'Sign By Finance Staff', 'created_at' => '2025-10-16 04:32:34', 'updated_at' => '2025-10-16 09:39:14',],
            ['id_sign_flow' => 11, 'id_doc_type' => 2, 'step_order' => 1, 'required' => 1, 'level' => 2, 'description' => 'Sign By Maker', 'created_at' => '2025-10-16 09:28:00', 'updated_at' => '2025-10-16 09:28:00',],
            ['id_sign_flow' => 12, 'id_doc_type' => 1, 'step_order' => 7, 'required' => 1, 'level' => 8, 'description' => 'Sign By CFO', 'created_at' => '2025-10-16 09:29:44', 'updated_at' => '2025-10-16 09:29:44',],
            ['id_sign_flow' => 14, 'id_doc_type' => 3, 'step_order' => 6, 'required' => 1, 'level' => 7, 'description' => 'Sign By Finance Supervisor', 'created_at' => '2025-10-16 09:32:35', 'updated_at' => '2025-10-16 09:38:58',],
            ['id_sign_flow' => 15, 'id_doc_type' => 3, 'step_order' => 7, 'required' => 1, 'level' => 8, 'description' => 'Sign By CFO', 'created_at' => '2025-10-16 09:33:13', 'updated_at' => '2025-10-16 09:38:47',],
            ['id_sign_flow' => 16, 'id_doc_type' => 2, 'step_order' => 2, 'required' => 1, 'level' => 3, 'description' => 'Sign By Departement Head Or Superior User', 'created_at' => '2025-10-16 09:34:55', 'updated_at' => '2025-10-16 09:34:55',],
            ['id_sign_flow' => 17, 'id_doc_type' => 2, 'step_order' => 3, 'required' => 1, 'level' => 4, 'description' => 'Sign By Director', 'created_at' => '2025-10-16 09:35:27', 'updated_at' => '2025-10-16 09:35:27',],
            ['id_sign_flow' => 18, 'id_doc_type' => 3, 'step_order' => 4, 'required' => 1, 'level' => 5, 'description' => 'Sign By Accounting', 'created_at' => '2025-10-16 09:40:38', 'updated_at' => '2025-10-16 09:40:38',],
            ['id_sign_flow' => 19, 'id_doc_type' => 2, 'step_order' => 4, 'required' => 1, 'level' => 6, 'description' => 'Sign By Finance Staff', 'created_at' => '2025-10-16 09:51:42', 'updated_at' => '2025-10-16 09:51:42',],
            ['id_sign_flow' => 20, 'id_doc_type' => 2, 'step_order' => 5, 'required' => 1, 'level' => 7, 'description' => 'Sign By Finance Supervisor', 'created_at' => '2025-10-16 09:52:28', 'updated_at' => '2025-10-16 09:52:28',],
            ['id_sign_flow' => 21, 'id_doc_type' => 2, 'step_order' => 6, 'required' => 1, 'level' => 8, 'description' => 'Sign By CFO', 'created_at' => '2025-10-16 09:53:23', 'updated_at' => '2025-10-16 09:53:23',],
        ];

        foreach (array_chunk($data, 100) as $chunk) {
            DB::table('tbl_sign_flow')->upsert($chunk, ['id_sign_flow'], ['id_sign_flow', 'id_doc_type', 'step_order', 'required', 'level', 'description', 'created_at', 'updated_at']);
        }
    }
}
