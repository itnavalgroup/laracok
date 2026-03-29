<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TblBranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        $payload = [
                    [
                        'id_branch' => 1,
                        'branch' => 'Jakarta',
                        'branch_address' => 'Altira Business Park, Jl. Yos Sudarso Kav 85, Sunter Jaya, Kec. Tj. Priok, Jkt Utara, Daerah Khusus Ibukota Jakarta 14360',
                        'created_at' => '2025-05-02 19:03:02',
                        'updated_at' => '2026-03-09 00:44:09',
                        'deleted_at' => null,
                    ],
                    [
                        'id_branch' => 2,
                        'branch' => 'Medan',
                        'branch_address' => '',
                        'created_at' => '2025-05-02 19:03:41',
                        'updated_at' => '2025-05-02 19:03:41',
                        'deleted_at' => null,
                    ],
                    [
                        'id_branch' => 3,
                        'branch' => 'Batang',
                        'branch_address' => '',
                        'created_at' => '2025-05-02 19:03:41',
                        'updated_at' => '2025-05-02 19:03:41',
                        'deleted_at' => null,
                    ],
                    [
                        'id_branch' => 4,
                        'branch' => 'Aceh',
                        'branch_address' => '',
                        'created_at' => '2025-05-03 14:34:40',
                        'updated_at' => '2025-05-03 14:35:24',
                        'deleted_at' => null,
                    ]
        ];

        // Break payload into manageable memory chunks and insert
        $chunks = array_chunk($payload, 50);
        foreach ($chunks as $chunk) {
            DB::table('tbl_branch')->insertOrIgnore($chunk);
        }

        Schema::enableForeignKeyConstraints();
    }
}
