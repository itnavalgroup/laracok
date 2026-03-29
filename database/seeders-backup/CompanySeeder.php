<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = [
            [
                'id_company' => 1,
                'company_name' => 'PT Sumber Banyu Biru',
                'company' => 'SBB',
                'logo' => '1746512637_a6711f0f28420f340fba.png',
                'created_at' => '2025-05-02 19:01:17',
                'updated_at' => '2025-05-06 00:03:42',
            ],
            [
                'id_company' => 5,
                'company_name' => 'PT Naval Group',
                'company' => 'NVL',
                'logo' => '1746416094_67c48c6b8c22d5dd71d3.png',
                'created_at' => '2025-05-04 20:34:54',
                'updated_at' => '2025-05-06 00:03:24',
            ],
            [
                'id_company' => 6,
                'company_name' => 'PT Krishna Sukses Abadi',
                'company' => 'KSA',
                'logo' => '1746416165_f7be3f8c47aff5891ce0.png',
                'created_at' => '2025-05-04 20:36:05',
                'updated_at' => '2025-05-04 20:36:05',
            ],
            [
                'id_company' => 8,
                'company_name' => 'PT Rakyat Aceh Makmur',
                'company' => 'RAM-MAKMUR',
                'logo' => '1765165615_c0a4c454c5866d63499b.jpg',
                'created_at' => '2025-12-07 20:46:55',
                'updated_at' => '2025-12-07 21:44:48',
            ],
            [
                'id_company' => 9,
                'company_name' => 'PT Rakyat Aceh Mandiri',
                'company' => 'RAM-MANDIRI',
                'logo' => '1765165691_b1166eec1d44032ea9e2.jpeg',
                'created_at' => '2025-12-07 20:48:11',
                'updated_at' => '2025-12-07 21:45:03',
            ],
            [
                'id_company' => 10,
                'company_name' => 'PT Hamper Nusantara Indonesia',
                'company' => 'HNI',
                'logo' => '1768882496_fb838c4dbe0fe891ad4b.png',
                'created_at' => '2026-01-19 21:14:56',
                'updated_at' => '2026-01-19 21:15:09',
            ],
        ];

        DB::table('tbl_company')->upsert(
            $companies,
            ['id_company'], // Unique key to match
            ['company_name', 'company', 'logo', 'created_at', 'updated_at'] // Columns to update
        );
    }
}
