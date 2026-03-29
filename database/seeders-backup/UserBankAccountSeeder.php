<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserBankAccountSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['id_norek_user' => 22, 'id_user' => 38, 'nama_bank' => 'OCBC NISP', 'nama_penerima' => 'NURAINI TRIHASTUTI', 'norek' => '020810382190', 'created_at' => '2025-12-29 03:48:13',],
            ['id_norek_user' => 23, 'id_user' => 41, 'nama_bank' => 'OCBC', 'nama_penerima' => 'KHUSNAWATI', 'norek' => '020810393650', 'created_at' => '2026-01-07 06:11:54',],
        ];

        foreach (array_chunk($data, 100) as $chunk) {
            DB::table('tbl_norek_user')->upsert($chunk, ['id_norek_user'], ['id_norek_user', 'id_user', 'nama_bank', 'nama_penerima', 'norek', 'created_at', 'updated_at']);
        }
    }
}
