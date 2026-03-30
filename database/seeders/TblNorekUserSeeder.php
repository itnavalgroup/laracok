<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TblNorekUserSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::unprepared(<<<'SQL'
INSERT IGNORE INTO `tbl_norek_user` (`id_norek_user`, `id_user`, `nama_bank`, `nama_penerima`, `norek`, `created_at`, `updated_at`, `deleted_at`) VALUES
(22, 38, 'OCBC NISP', 'NURAINI TRIHASTUTI', '020810382190', '2025-12-28 20:48:13', '2025-12-28 20:48:13', NULL),
(23, 41, 'OCBC', 'KHUSNAWATI', '020810393650', '2026-01-06 23:11:54', '2026-01-06 23:11:54', NULL);
SQL
        );
        Schema::enableForeignKeyConstraints();
    }
}
