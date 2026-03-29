<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TblIkbDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::unprepared(<<<SQL
INSERT IGNORE INTO `tbl_ikb_details` (`id_ikb_detail`, `id_ikb`, `id_item_category`, `id_item`, `id_uom`, `id_packaging`, `qty`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 17, 29, 3, 3, 20000.0000, '2026-03-12 01:47:34', '2026-03-12 03:34:17', NULL),
(2, 1, 17, 29, 3, 3, 2000.0000, '2026-03-12 02:06:43', '2026-03-12 02:06:52', '2026-03-11 19:06:52'),
(3, 1, 17, 29, 3, 3, 2000.0000, '2026-03-12 02:07:13', '2026-03-12 02:08:39', '2026-03-11 19:08:39'),
(4, 1, 17, 30, 3, 2, 6000.0000, '2026-03-12 04:46:11', '2026-03-12 04:46:11', NULL),
(5, 2, 17, 31, 3, 3, 20000.0000, '2026-03-12 05:52:41', '2026-03-12 05:52:41', NULL),
(6, 3, 17, 31, 1, 2, 40000.0000, '2026-03-12 06:29:52', '2026-03-12 06:29:52', NULL),
(7, 4, 17, 29, 1, 2, 49.0000, '2026-03-12 06:49:27', '2026-03-12 06:49:27', NULL),
(8, 5, 5, 5, 3, 2, 6891.0000, '2026-03-13 06:18:44', '2026-03-13 06:18:44', NULL),
(9, 2, 17, 31, 1, 2, 10000.2500, '2026-03-13 07:33:18', '2026-03-13 07:38:00', NULL);

SQL);

        Schema::enableForeignKeyConstraints();
    }
}
