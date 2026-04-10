<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TblCostCategoriesSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::unprepared(<<<'SQL'
INSERT IGNORE INTO `tbl_cost_categories` (`id_cost_category`, `id_user`, `cost_category`, `created_at`, `updated_at`, `deleted_at`) VALUES
(10, 1, 'General', '2025-11-20 00:02:10', '2025-11-20 00:02:10', NULL),
(12, 1, 'Production', '2025-11-20 00:02:52', '2025-11-20 00:02:52', NULL);
SQL
        );
        Schema::enableForeignKeyConstraints();
    }
}
