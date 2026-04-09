<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TblTaxTypesSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::unprepared(<<<'SQL'
INSERT IGNORE INTO `tbl_tax_types` (`id_tax_type`, `tax_type`, `tax_type_description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(9, 'PPh', 'Pajak Penghasilan', '2025-09-01 18:53:03', '2025-11-20 00:09:57', NULL),
(10, 'PPN', 'Pajak Pertambahan Nilai', '2025-09-01 18:53:18', '2025-10-15 04:00:19', NULL);
SQL
        );
        Schema::enableForeignKeyConstraints();
    }
}
