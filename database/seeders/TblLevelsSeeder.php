<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TblLevelsSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::unprepared(<<<'SQL'
INSERT IGNORE INTO `tbl_levels` (`id_level`, `level`, `level_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'admin', '2025-10-10 02:51:38', '2025-10-10 02:51:38', NULL),
(2, 2, 'user', '2025-10-10 02:51:38', '2025-10-10 02:51:38', NULL),
(3, 3, 'departement head', '2025-10-10 02:51:38', '2025-10-10 02:51:38', NULL),
(4, 4, 'director', '2025-10-10 02:51:38', '2025-10-10 02:51:38', NULL),
(5, 5, 'accounting', '2025-10-10 02:51:38', '2025-10-10 02:51:38', NULL),
(6, 6, 'finance staff', '2025-10-10 02:51:38', '2025-10-10 02:51:38', NULL),
(7, 7, 'finance supervisor', '2025-10-10 02:51:38', '2025-10-10 02:51:38', NULL),
(8, 8, 'chief finance officer', '2025-10-10 02:51:38', '2025-10-10 02:51:38', NULL);
SQL
        );
        Schema::enableForeignKeyConstraints();
    }
}
