<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TblNorekUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        $payload = [
                    [
                        'id_norek_user' => 22,
                        'nama_bank' => 'OCBC NISP',
                        'nama_penerima' => 'NURAINI TRIHASTUTI',
                        'norek' => '020810382190',
                        'id_user' => 38,
                        'created_at' => '2025-12-29 03:48:13',
                        'updated_at' => '2025-12-29 03:48:13',
                        'deleted_at' => null,
                    ],
                    [
                        'id_norek_user' => 23,
                        'nama_bank' => 'OCBC',
                        'nama_penerima' => 'KHUSNAWATI',
                        'norek' => '020810393650',
                        'id_user' => 41,
                        'created_at' => '2026-01-07 06:11:54',
                        'updated_at' => '2026-01-07 06:11:54',
                        'deleted_at' => null,
                    ]
        ];

        // Break payload into manageable memory chunks and insert
        $chunks = array_chunk($payload, 50);
        foreach ($chunks as $chunk) {
            DB::table('tbl_norek_user')->insertOrIgnore($chunk);
        }

        Schema::enableForeignKeyConstraints();
    }
}
