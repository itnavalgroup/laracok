<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VerificationTypeSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['id_verification_type' => 6, 'verification_type' => 'Diperiksa Oleh (Departement)', 'created_at' => '2025-09-18 08:42:36', 'updated_at' => '2025-09-18 08:42:36',],
            ['id_verification_type' => 7, 'verification_type' => 'Disetujui Oleh (Departement)', 'created_at' => '2025-09-18 08:42:55', 'updated_at' => '2025-09-18 08:42:55',],
            ['id_verification_type' => 8, 'verification_type' => 'Diperiksa Oleh (Finance 1)', 'created_at' => '2025-09-18 08:43:23', 'updated_at' => '2025-09-18 08:43:23',],
            ['id_verification_type' => 9, 'verification_type' => 'Diperiksa Oleh (Finance 2)', 'created_at' => '2025-09-18 08:43:43', 'updated_at' => '2025-09-18 08:43:43',],
            ['id_verification_type' => 10, 'verification_type' => 'Diperiksa Oleh (Finance 3)', 'created_at' => '2025-09-18 08:44:07', 'updated_at' => '2025-09-18 08:44:07',],
            ['id_verification_type' => 11, 'verification_type' => 'Disetujui Oleh (Finance)', 'created_at' => '2025-09-18 08:44:54', 'updated_at' => '2025-09-18 08:45:21',],
        ];

        foreach (array_chunk($data, 100) as $chunk) {
            DB::table('tbl_verification_type')->upsert($chunk, ['id_verification_type'], ['id_verification_type', 'verification_type', 'created_at', 'updated_at']);
        }
    }
}
