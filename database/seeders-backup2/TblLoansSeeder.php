<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TblLoansSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::unprepared(<<<'SQL'
INSERT IGNORE INTO `tbl_loans` (`id_loan`, `id_user`, `loan`, `created_at`, `updated_at`) VALUES
(2, 1, 'Bank', '2025-10-21 20:48:23', '2025-10-21 20:51:26'),
(3, 1, 'EXIM', '2025-10-21 20:51:46', '2025-10-21 20:51:46'),
(4, 1, 'Affiliation', '2025-10-21 20:52:03', '2025-11-30 21:00:12');
SQL
        );
        Schema::enableForeignKeyConstraints();
    }
}
