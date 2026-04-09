<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TblPackagingsSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::unprepared(<<<'SQL'
INSERT IGNORE INTO `tbl_packagings` (`id_packaging`, `id_user`, `id_departement`, `packaging`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 'Test', '2026-02-25 07:32:01', '2026-02-25 07:32:07', '2026-02-25 00:32:07'),
(2, 1, 1, 'Karung', '2026-02-25 21:28:46', '2026-02-25 21:28:46', NULL),
(3, 1, 1, 'IBC', '2026-02-25 21:28:58', '2026-02-25 21:28:58', NULL),
(4, 1, 1, 'UNKNOWN', '2026-03-25 20:43:19', '2026-03-25 20:43:19', NULL);
SQL
        );
        Schema::enableForeignKeyConstraints();
    }
}
