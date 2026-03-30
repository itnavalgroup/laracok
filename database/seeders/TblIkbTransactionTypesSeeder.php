<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TblIkbTransactionTypesSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::unprepared(<<<'SQL'
INSERT IGNORE INTO `tbl_ikb_transaction_types` (`id_ikb_transaction_type`, `transaction_type`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Penjualan', 1, '2026-03-12 05:03:28', '2026-03-12 05:03:28', NULL),
(2, 'Retur', 1, '2026-03-12 05:03:28', '2026-03-12 05:03:28', NULL),
(3, 'Tukar Guling', 1, '2026-03-12 05:03:28', '2026-03-12 05:03:28', NULL),
(4, 'Internal Use', 1, '2026-03-12 05:03:28', '2026-03-12 05:03:28', NULL),
(5, 'Sample', 1, '2026-03-12 05:03:28', '2026-03-12 05:03:28', NULL),
(6, 'Produksi', 1, '2026-03-12 05:03:28', '2026-03-12 05:03:28', NULL);
SQL
        );
        Schema::enableForeignKeyConstraints();
    }
}
