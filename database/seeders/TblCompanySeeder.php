<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TblCompanySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tbl_company')->truncate();

        $data = [
            [
                'id_company' => 1,
                'company_name' => 'PT Sumber Banyu Biru',
                'company' => 'SBB',
                'logo' => '1746512637_a6711f0f28420f340fba.png',
                'created_at' => '2025-05-02 12:01:17',
                'updated_at' => '2025-05-05 17:03:42',
                'deleted_at' => null
            ],
            [
                'id_company' => 5,
                'company_name' => 'PT Naval Group',
                'company' => 'NVL',
                'logo' => '1746416094_67c48c6b8c22d5dd71d3.png',
                'created_at' => '2025-05-04 13:34:54',
                'updated_at' => '2025-05-05 17:03:24',
                'deleted_at' => null
            ],
            [
                'id_company' => 6,
                'company_name' => 'PT Krishna Sukses Abadi',
                'company' => 'KSA',
                'logo' => '1746416165_f7be3f8c47aff5891ce0.png',
                'created_at' => '2025-05-04 13:36:05',
                'updated_at' => '2025-05-04 13:36:05',
                'deleted_at' => null
            ],
            [
                'id_company' => 8,
                'company_name' => 'PT Rakyat Aceh Makmur',
                'company' => 'RAM-MAKMUR',
                'logo' => '1765165615_c0a4c454c5866d63499b.jpg',
                'created_at' => '2025-12-07 13:46:55',
                'updated_at' => '2025-12-07 14:44:48',
                'deleted_at' => null
            ],
            [
                'id_company' => 9,
                'company_name' => 'PT Rakyat Aceh Mandiri',
                'company' => 'RAM-MANDIRI',
                'logo' => '1765165691_b1166eec1d44032ea9e2.jpeg',
                'created_at' => '2025-12-07 13:48:11',
                'updated_at' => '2025-12-07 14:45:03',
                'deleted_at' => null
            ],
            [
                'id_company' => 10,
                'company_name' => 'PT Hamper Nusantara Indonesia',
                'company' => 'HNI',
                'logo' => '1768882496_fb838c4dbe0fe891ad4b.png',
                'created_at' => '2026-01-19 14:14:56',
                'updated_at' => '2026-01-19 14:15:09',
                'deleted_at' => null
            ]
        ];

        // Insert in chunks to avoid packet-size limits
        foreach (array_chunk($data, 500) as $chunk) {
            DB::table('tbl_company')->insert($chunk);
        }
    }
}
