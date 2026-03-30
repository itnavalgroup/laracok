<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TblCostTypesSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::unprepared(<<<'SQL'
INSERT IGNORE INTO `tbl_cost_types` (`id_cost_type`, `id_user`, `id_cost_category`, `cost_type`, `cost_document`, `created_at`, `updated_at`, `deleted_at`) VALUES
(14, 1, 12, 'Routine Production', '', '2025-11-20 00:03:34', '2025-11-20 00:08:02', NULL),
(15, 1, 12, 'Non Routine Production', '', '2025-11-20 00:03:50', '2025-11-20 00:07:51', NULL),
(16, 1, 10, 'Non Routine General', '', '2025-11-20 00:08:19', '2025-11-20 00:08:19', NULL),
(17, 1, 10, 'Routine General', '', '2025-11-20 00:08:35', '2025-11-20 00:08:35', NULL);
SQL
        );
        Schema::enableForeignKeyConstraints();
    }
}
