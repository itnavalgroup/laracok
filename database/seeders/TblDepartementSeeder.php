<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TblDepartementSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::unprepared(<<<'SQL'
INSERT IGNORE INTO `tbl_departement` (`id_departement`, `departement`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'IT', '2025-05-02 12:07:08', '2025-05-05 13:59:00', NULL),
(2, 'FINANCE', '2025-05-02 12:07:08', '2025-11-19 18:46:22', NULL),
(3, 'PA', '2025-05-03 13:38:52', '2025-11-19 22:20:13', NULL),
(4, 'ACCOUNTING', '2025-11-19 18:46:48', '2025-11-19 18:46:48', NULL),
(5, 'LEGAL', '2025-11-19 18:47:16', '2025-11-19 18:47:16', NULL),
(6, 'PRODUCTION', '2025-11-19 18:47:23', '2025-11-19 18:47:23', NULL),
(7, 'HRD', '2025-11-19 18:47:35', '2025-11-19 18:47:35', NULL),
(8, 'PURCHASING', '2025-11-19 18:48:14', '2025-11-19 18:48:14', NULL),
(9, 'LOGISTIC', '2025-11-19 18:48:53', '2025-11-19 18:48:53', NULL),
(10, 'MANAGEMENT', '2025-11-19 19:00:37', '2025-11-19 19:00:37', NULL),
(11, 'WAREHOUSE BATANG', '2025-11-19 20:05:33', '2025-12-09 14:56:53', NULL),
(12, 'FINANCE MANAGER', '2025-11-19 22:14:49', '2025-11-19 22:36:19', NULL),
(13, 'MARKETING', '2025-11-19 22:22:59', '2025-11-19 22:22:59', NULL),
(14, 'LAB', '2025-11-19 22:31:25', '2025-11-19 22:31:25', NULL),
(17, 'GA', '2025-12-07 11:36:00', '2025-12-07 11:36:00', NULL),
(18, 'WAREHOUSE MEDAN', '2025-12-09 14:57:08', '2025-12-09 14:57:08', NULL),
(19, 'TA', '2026-02-11 19:22:55', '2026-02-11 19:22:55', NULL);
SQL
        );
        Schema::enableForeignKeyConstraints();
    }
}
