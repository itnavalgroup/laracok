<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TblDocTypesSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::unprepared(<<<'SQL'
INSERT IGNORE INTO `tbl_doc_types` (`id_doc_type`, `doc_type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Payment', '2025-10-14 12:46:17', '2025-11-12 03:58:32', NULL),
(2, 'Advance', '2025-10-14 12:46:17', '2025-11-12 03:58:32', NULL),
(3, 'Settlement', '2026-02-26 04:08:48', '2026-02-26 04:08:48', NULL),
(4, 'ikb', '2026-02-26 04:09:28', '2026-02-26 04:09:28', NULL);
SQL
        );
        Schema::enableForeignKeyConstraints();
    }
}
