<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TblPositionSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::unprepared(<<<'SQL'
INSERT IGNORE INTO `tbl_position` (`id_position`, `position`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'CEO', '2025-05-02 12:05:50', '2025-05-02 12:05:50', NULL),
(2, 'Kepala Gudang', '2025-05-02 12:05:50', '2025-11-19 19:12:47', NULL),
(3, 'Staff', '2025-05-02 12:06:08', '2025-05-03 13:54:22', NULL),
(6, 'Manager', '2025-11-19 19:13:33', '2025-11-19 19:13:33', NULL),
(7, 'CFO', '2025-11-19 19:13:46', '2025-11-19 19:13:46', NULL),
(8, 'Supervisor', '2025-11-19 19:14:18', '2025-11-19 19:14:18', NULL);
SQL
        );
        Schema::enableForeignKeyConstraints();
    }
}
