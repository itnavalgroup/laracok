<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TblBranchSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::unprepared(<<<'SQL'
INSERT IGNORE INTO `tbl_branch` (`id_branch`, `branch`, `branch_address`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Jakarta', 'Altira Business Park, Jl. Yos Sudarso Kav 85, Sunter Jaya, Kec. Tj. Priok, Jkt Utara, Daerah Khusus Ibukota Jakarta 14360', '2025-05-02 12:03:02', '2026-03-08 17:44:09', NULL),
(2, 'Medan', '', '2025-05-02 12:03:41', '2025-05-02 12:03:41', NULL),
(3, 'Batang', '', '2025-05-02 12:03:41', '2025-05-02 12:03:41', NULL),
(4, 'Aceh', '', '2025-05-03 07:34:40', '2025-05-03 07:35:24', NULL);
SQL
        );
        Schema::enableForeignKeyConstraints();
    }
}
