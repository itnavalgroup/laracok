<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TblBranchSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tbl_branch')->truncate();

        $data = [
            [
                'id_branch' => 1,
                'branch' => 'Jakarta',
                'branch_address' => 'Altira Business Park, Jl. Yos Sudarso Kav 85, Sunter Jaya, Kec. Tj. Priok, Jkt Utara, Daerah Khusus Ibukota Jakarta 14360',
                'created_at' => '2025-05-02 12:03:02',
                'updated_at' => '2026-03-08 17:44:09',
                'deleted_at' => null
            ],
            [
                'id_branch' => 2,
                'branch' => 'Medan',
                'branch_address' => '',
                'created_at' => '2025-05-02 12:03:41',
                'updated_at' => '2025-05-02 12:03:41',
                'deleted_at' => null
            ],
            [
                'id_branch' => 3,
                'branch' => 'Batang',
                'branch_address' => '',
                'created_at' => '2025-05-02 12:03:41',
                'updated_at' => '2025-05-02 12:03:41',
                'deleted_at' => null
            ],
            [
                'id_branch' => 4,
                'branch' => 'Aceh',
                'branch_address' => '',
                'created_at' => '2025-05-03 07:34:40',
                'updated_at' => '2025-05-03 07:35:24',
                'deleted_at' => null
            ],
            [
                'id_branch' => 5,
                'branch' => 'Palu ',
                'branch_address' => 'SULAWESI TENGAH KOTA PALU ',
                'created_at' => '2026-04-05 20:43:15',
                'updated_at' => '2026-04-05 20:43:15',
                'deleted_at' => null
            ]
        ];

        // Insert in chunks to avoid packet-size limits
        foreach (array_chunk($data, 500) as $chunk) {
            DB::table('tbl_branch')->insert($chunk);
        }
    }
}
