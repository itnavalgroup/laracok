<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TblPackagingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::unprepared(<<<SQL
INSERT IGNORE INTO `tbl_packagings` (`id_packaging`, `id_user`, `id_departement`, `packaging`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 'Test', '2026-02-25 14:32:01', '2026-02-25 14:32:07', '2026-02-25 07:32:07'),
(2, 1, 1, 'Karung', '2026-02-26 04:28:46', '2026-02-26 04:28:46', NULL),
(3, 1, 1, 'IBC', '2026-02-26 04:28:58', '2026-02-26 04:28:58', NULL);

SQL);

        Schema::enableForeignKeyConstraints();
    }
}
