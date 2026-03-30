<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TblContractSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::unprepared(<<<'SQL'
INSERT IGNORE INTO `tbl_contract` (`id_contract`, `id_user`, `id_company`, `id_departement`, `id_attachment`, `contract_number`, `description`, `file_name`, `start_date`, `end_date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 5, 1, NULL, 'CTR.NVL.IT.2603.001', 'Test', NULL, '2026-03-25', '2026-03-31', '2026-03-27 00:11:17', '2026-03-27 00:36:03', '2026-03-27 00:36:03');
SQL
        );
        Schema::enableForeignKeyConstraints();
    }
}
