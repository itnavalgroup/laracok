<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $branches = [
            [
                'id_branch' => 1,
                'branch' => 'Jakarta',
                'branch_address' => 'Altira Business Park, Jl. Yos Sudarso Kav 85, Sunter Jaya, Kec. Tj. Priok, Jkt Utara, Daerah Khusus Ibukota Jakarta 14360 gfdsfdsf',
                'created_at' => '2025-05-02 19:03:02',
                'updated_at' => '2025-10-13 19:49:37',
            ],
            [
                'id_branch' => 2,
                'branch' => 'Medan',
                'branch_address' => '',
                'created_at' => '2025-05-02 19:03:41',
                'updated_at' => '2025-05-02 19:03:41',
            ],
            [
                'id_branch' => 3,
                'branch' => 'Batang',
                'branch_address' => '',
                'created_at' => '2025-05-02 19:03:41',
                'updated_at' => '2025-05-02 19:03:41',
            ],
            [
                'id_branch' => 4,
                'branch' => 'Aceh',
                'branch_address' => '',
                'created_at' => '2025-05-03 14:34:40',
                'updated_at' => '2025-05-03 14:35:24',
            ],
        ];

        DB::table('tbl_branch')->upsert(
            $branches,
            ['id_branch'],
            ['branch', 'branch_address', 'created_at', 'updated_at']
        );
    }
}
