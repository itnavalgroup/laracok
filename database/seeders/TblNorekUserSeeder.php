<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TblNorekUserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tbl_norek_user')->truncate();

        $data = [
            [
                'id_norek_user' => 22,
                'id_user' => 38,
                'nama_bank' => 'OCBC NISP',
                'nama_penerima' => 'NURAINI TRIHASTUTI',
                'norek' => '020810382190',
                'created_at' => '2025-12-28 20:48:13',
                'updated_at' => '2025-12-28 20:48:13',
                'deleted_at' => null
            ],
            [
                'id_norek_user' => 23,
                'id_user' => 41,
                'nama_bank' => 'OCBC',
                'nama_penerima' => 'KHUSNAWATI',
                'norek' => '020810393650',
                'created_at' => '2026-01-06 23:11:54',
                'updated_at' => '2026-01-06 23:11:54',
                'deleted_at' => null
            ]
        ];

        // Insert in chunks to avoid packet-size limits
        foreach (array_chunk($data, 500) as $chunk) {
            DB::table('tbl_norek_user')->insert($chunk);
        }
    }
}
