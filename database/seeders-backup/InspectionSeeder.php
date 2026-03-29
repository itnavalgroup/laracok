<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InspectionSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['id_inspection' => 16, 'id_item_transaction' => 42, 'inspection_number' => 'PPD.SBB.IT.2509.00009', 'id_user' => 1, 'note' => 'Test 2', 'inspection_date' => '2025-09-19 00:00:00', 'col_7' => 'dasdasdasd', 'col_8' => 'dsafsadasdasdds', 'col_9' => 'csvasvsadasd', 'col_10' => 'fasdasdsad', 'col_11' => 'cavsavsa', 'col_12' => 'dsadasfsafsa', 'col_13' => 10, 'col_14' => '1', 'col_15' => 1, 'attachment' => 'inspection_PPD.SBB.IT.2509.00009.png', 'created_at' => '2025-09-10 06:45:48', 'updated_at' => '2025-09-19 03:20:58',],
            ['id_inspection' => 17, 'id_item_transaction' => 34, 'inspection_number' => 'PPD.SBB.IT.2509.00001', 'id_user' => 1, 'note' => 'dsadasd', 'inspection_date' => '2025-09-11 00:00:00', 'col_7' => 'dsadsad', 'col_8' => 'dsadsad', 'col_9' => 'dsadsad', 'col_10' => 'dsdsd', 'col_11' => 'dsadsad', 'col_12' => 'dsadshkjk', 'col_13' => 5, 'col_14' => '8', 'col_15' => 8, 'attachment' => 'inspection_PPD.SBB.IT.2509.00001.png', 'created_at' => '2025-09-11 01:34:29', 'updated_at' => '2025-09-15 06:07:23',],
        ];

        foreach (array_chunk($data, 100) as $chunk) {
            DB::table('tbl_inspection')->upsert($chunk, ['id_inspection'], ['id_inspection', 'id_item_transaction', 'inspection_number', 'id_user', 'note', 'inspection_date', 'col_7', 'col_8', 'col_9', 'col_10', 'col_11', 'col_12', 'col_13', 'col_14', 'col_15', 'attachment', 'created_at', 'updated_at']);
        }
    }
}
